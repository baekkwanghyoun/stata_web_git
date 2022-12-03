<?php

namespace TCG\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Facades\Voyager;

class VoyagerUserController extends VoyagerBaseController
{
    public function profile(Request $request)
    {
        $route = '';
        $dataType = Voyager::model('DataType')->where('model_name', Auth::guard(app('VoyagerGuard'))->getProvider()->getModel())->first();
        if (!$dataType && app('VoyagerGuard') == 'web') {
            $route = route('voyager.users.edit', Auth::user()->getKey());
        } elseif ($dataType) {
            $route = route('voyager.'.$dataType->slug.'.edit', Auth::user()->getKey());
        }

        return Voyager::view('voyager::profile', compact('route'));
    }


    /* override 받음 */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:10',
            'email' => 'required|email|unique:users',
            'password' => ['required',

                Password::min(9)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                //->uncompromised(),
            ],
            'new_confirm_password' => [
                'same:new_password'
            ],
        ],
            [
                'name.required' => '이름을 입력하셔야 합니다.',
                'email.required' => '이메일을 입력하셔야 합니다.',
                'email.unique' => '이미 등록된 이메일입니다.',
                'password.required' => '비밀번호를 입력하셔야 합니다.',
                'password.min' => '비밀번호는 9자 이상이어야 합니다.',
                'password.validation.password.symbols' => '비밀번호는 대문자, 소문자가 포함되어야 합니다.',
            ]
        );

        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();
        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

        event(new BreadDataAdded($dataType, $data));

        if (!$request->has('_tagging')) {
            if (auth()->user()->can('browse', $data)) {
                $redirect = redirect()->route("voyager.{$dataType->slug}.index");
            } else {
                $redirect = redirect()->back();
            }

            return $redirect->with([
                'message'    => __('voyager::generic.successfully_added_new')." {$dataType->getTranslatedAttribute('display_name_singular')}",
                'alert-type' => 'success',
            ]);
        } else {
            return response()->json(['success' => true, 'data' => $data]);
        }
    }
    // POST BR(E)AD
    public function update(Request $request, $id)
    {

        if(request('password')) {
            $request->validate([
                'password' => ['required',
                    Password::min(9)
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                    //->uncompromised(),
                ],
                'new_confirm_password' => [
                    'same:new_password'
                ],
            ],
                [
                    'password.required' => '비밀번호를 입력하셔야 합니다.',
                    'password.min' => '비밀번호는 9자 이상이어야 합니다.',
                    'password.validation.password.symbols' => '비밀번호는 대문자, 소문자가 포함되어야 합니다.',
                ]
            );
        }
        else {
            $request->validate([
                'name' => 'required|max:10',
                'email' => 'required|email',
            ],
                [
                    'name.required' => '이름을 입력하셔야 합니다.',
                    'email.required' => '이메일을 입력하셔야 합니다.',
                ]
            );
        }

        if (Auth::user()->getKey() == $id) {
            $request->merge([
                'role_id'                              => Auth::user()->role_id,
                'user_belongstomany_role_relationship' => Auth::user()->roles->pluck('id')->toArray(),
            ]);
        }

        return parent::update($request, $id);
    }
}
