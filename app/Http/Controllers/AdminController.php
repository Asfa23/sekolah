<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index()
    {
        echo "halo semuanya";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo "<a href='logout'>LOGOUT >></a>" ;
    }
    function about()
    {
        return view('about');
    }
}
