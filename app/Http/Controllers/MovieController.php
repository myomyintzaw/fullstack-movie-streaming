<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function all()
    {
        $data = Movie::orderBy('id', 'desc');

        //search by title
        if($search=request()->search){
            $data->where('name','like',"%$search%");
        }

        $data = $data->paginate(12);
        return view('movie.all', compact('data'));
    }

    public function detail() {}
}
