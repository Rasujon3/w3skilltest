<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return redirect()->route('user-index');
    }

    public function loginPage()
    {
        return "Hello, w3 engineers.";
    }
}
