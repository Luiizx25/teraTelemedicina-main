<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AppController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        if ($now->format('H') < 12)
        {
            $gImage = 'g-manha.jpg';
            $greeting = 'bom dia.';
        }
        elseif ($now->format('H') < 19)
        {
            $gImage = 'g-tarde.jpg';
            $greeting = 'boa tarde.';
        }
        else
        {
            $gImage = 'g-noite.jpg';
            $greeting = 'boa noite.';
        }

        return view('app.home',compact('now','greeting','gImage'));
    }

    public function settings()
    {
        return view('app.settings.index');
    }

    public function dashboard()
    {
        return view('app.dashboard');
    }
}
