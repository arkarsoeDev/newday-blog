<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return "this is page index";
    }

    public function posts()
    {
        return "this is page posts";
    }

    public function dashboard()
    {
        return view('dashboard.index');
    }
}