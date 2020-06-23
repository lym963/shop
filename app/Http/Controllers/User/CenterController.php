<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    public function center()
    {
        return view("user.center");
    }
}
