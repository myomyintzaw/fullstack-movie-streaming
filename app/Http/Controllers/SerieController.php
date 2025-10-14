<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function all()
    {

        return view('serie.all');
    }

    public function detail() {}
}
