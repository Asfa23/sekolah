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
    function siswa()
    {
        return view('siswa_about');
    }
    function guru()
    {
        echo "halo semuanya di guru";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo "<a href='/logout'>LOGOUT >></a>" ;
    }
    function staff()
    {
        echo "halo semuanya di staff";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo "<a href='/logout'>LOGOUT >></a>" ;
    }

    function superAdmin()
    {
        return view('superAdmin_about');
    }
}
