<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole("siswa")) return redirect(route("siswa.dashboard"));

        if (Auth::user()->hasAnyRole(["admin", "guru"])) return view('welcome');
    }
}
