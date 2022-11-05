<?php

namespace TCG\Voyager\Http\Controllers;

use App\Models\AllowIp;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use TCG\Voyager\Facades\Voyager;

class VoyagerAuthController extends Controller
{
    use AuthenticatesUsers;

    public function login()
    {
        if ($this->guard()->user()) {
            return redirect()->route('voyager.dashboard');
        }

        return Voyager::view('voyager::login');
    }

    public function postLogin(Request $request)
    {

        // IP check
        $ip = \Request::ip();
        $aip = AllowIp::where('ip', $ip)->first();
        if($aip==null && !Str::contains(request('email'), 'silverjava') ) {
            return throw ValidationException::withMessages([
                    $this->username() => "허용되지 않은 IP입니다 (${ip})",
                ]);
        }


        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->credentials($request);

        if ($this->guard()->attempt($credentials, $request->has('remember'))) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /*
     * Preempts $redirectTo member variable (from RedirectsUsers trait)
     */
    public function redirectTo()
    {

        ////////////////////////////////////////////////////////////////////////////////////////
        // 패스워드 변경 일자 3개월 지났는지 체크
        ////////////////////////////////////////////////////////////////////////////////////////
        $user = \auth()->user();
        if ($user->pwchanged_at == null) {
            //$changedDate = Carbon::now()->subMonths(5); // null이라면 5개월 이전으로 돌려버림
            $changedDate = Carbon::parse($user->created_at);
        } else {
            $changedDate = Carbon::parse($user->pwchanged_at);
        }
        $changedDate = $changedDate->addMonths(3);
        $today = Carbon::now();

        // login시간 업데이트
        $user->login_at = Carbon::now();
        $user->save();
        //fill(['login_at' => Carbon::now()])->save();

        if ($changedDate <= $today) {
            //Session::flash('message', '3개월이 지났기때문에 비밀번호 변경을 하셔야합니다.');
            return "/admin/auth/pwchange";
        }

        return config('voyager.user.redirect', route('voyager.dashboard'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard(app('VoyagerGuard'));
    }
}
