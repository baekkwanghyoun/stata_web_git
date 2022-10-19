<?php

namespace App\Http\Controllers;

use App\Models\Howto;
use Illuminate\Http\Request;

class HowtosController extends Controller
{
    public function index()
    {
        $v = Howto::latest()->get();
        return json_encode($v);
    }

}
