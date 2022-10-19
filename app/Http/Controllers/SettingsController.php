<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function getCode($group)
    {
        $v = Setting::select(['display_name', 'value'])->where('group', $group)->orderBy('order')->get();
        
        return json_encode($v);
    }

    public function index()
    {

    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(Setting $setting)
    {
    }

    public function edit(Setting $setting)
    {
    }

    public function update(Request $request, Setting $setting)
    {
    }

    public function destroy(Setting $setting)
    {
    }
}
