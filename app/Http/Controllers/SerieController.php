<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Serie;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function all()
    {
       $data = Serie::orderBy('id', 'desc');

        //search by title
        if($search=request()->search){
            $data->where('name','like',"%$search%");
        }


        //search by category
        if($search_category=request()->category){
            $findCategory=Category::where('slug',$search_category)->first();
            if(!$findCategory){
                return redirect('/serie')->with('error','data not found');
            }

            $data->whereHas('category',function($q) use ($findCategory){
                $q->where('category_series.category_id',$findCategory->id);
            });
        }

        //by rating
        if($rating=request()->rating){
            if($rating=='belowfive'){
                $data->where('rating',"<",5);
            }
              if($rating=='abovefive'){
                $data->where('rating',">",5);
            }
        }

        $data = $data->paginate(12);
        return view('serie.all', compact('data'));

    }

    public function detail() {}
}
