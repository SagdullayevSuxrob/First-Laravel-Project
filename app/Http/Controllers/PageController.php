<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function main()
    {
        // session()->put('city', 'Tashkent');
        // Session::put('key', 'default');
        // dd(session()->all());
        return view('main');
    }

    public function about()
    {
        return view('about');
    }

    public function services()
    {
        return view('services');
    }

    public function projects()
    {
        return view('projects');
    }

    /* public function blog()
    {
        return view('posts.index');
    } */

    public function contact()
    {
        return view('contact');
    }
}
