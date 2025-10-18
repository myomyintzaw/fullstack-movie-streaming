<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Serie;
use App\Models\SerieComment;
use App\Models\SerieLike;
use App\Models\SerieSave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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



    public function detail($slug) {

        $data = Serie::where('slug', $slug)->with('comment.user', 'category')
            ->withCount('comment', 'like', 'serieSave')
            ->first();
        if (!$data) {
            return redirect('/serie')->with('error', 'data not found');
        }


        // pull relate movie category
        $category = Category::whereHas('serie', function ($q) use ($data) {
            $q->where('category_series.series_id', $data->id);
        })->pluck('id');

        $related = Serie::whereHas('category', function ($q) use ($category) {
            $q->whereIn('category_series.category_id', $category);
        })->where('id', '!=', $data->id) // ✅ exclude the current movie
        ->inRandomOrder()->take(4)->get();

        return view('serie.detail', compact('data', 'related'));
    }




    public function storeComment(Request $request)
    {
        //check auth
        if (!Auth::check()) {
            return 'not auth';
        }

        $created_comment =SerieComment::create([
            'series_id' => $request->movie_id,
            'comment' => $request->comment,
            'user_id' => Auth::id(),
        ]);

        $data = SerieComment::where('id', $created_comment->id)->with('user')->first();

        return response()->json($data);
    }

    public function like(Request $request)
    {
        //check auth
        if (!Auth::check()) {
            return 'not auth';
        }
        //check already like
        $checkLike = SerieLike::where('user_id', Auth::id())->where('series_id', $request->movie_id)->first();
        if ($checkLike) {
            return 'already_like';
        }

        SerieLike::create([
            'series_id' => $request->movie_id,
            'user_id' => Auth::id(),
        ]);
        return 'success';
    }


    public function saveMovie(Request $request)
    {

        //check auth
        if (!Auth::check()) {
            return 'not auth';
        }
        //check already like
        $checkLike = SerieSave::where('user_id', Auth::id())->where('series_id', $request->movie_id)->first();
        if ($checkLike) {
            return 'already_save';
        }

        SerieSave::create([
            'series_id' => $request->movie_id,
            'user_id' => Auth::id(),
        ]);
        return 'success';
    }



}
