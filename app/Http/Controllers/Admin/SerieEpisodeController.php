<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Serie;
use App\Models\SerieEpisode;
use Illuminate\Http\Request;

class SerieEpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return request()->serie_id;
        $serie_id = request()->serie_id;
        $data = Serie::where('id', $serie_id)->with('episode')->first();
        $last_episode = SerieEpisode::where('series_id', $serie_id)->orderBy('id', 'desc')->first();
        $episode_no = 1;
        if ($last_episode) {
            $episode_no = $last_episode->episode_no + 1;
        }
        // $data->next_episode_no=$episode_no;
        // return $data;
        return view('admin.serie_epi.index', compact('data', 'episode_no'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->all();

        $serie_id = $request->serie_id;
        $epi_no = $request->epi_no;
        $direct_link = $request->direct_link;
        $api = 'https://streamhgapi.com/api/upload/url?key=30781d7ii5ivwsmmrxxzq&url=' . $direct_link;
        $res = json_decode(file_get_contents($api));
        $filecode=$res->result->filecode;
        // return $res->result->filecode;
        // return file_get_contents($api);


        //    return $res->result->filecode;


        SerieEpisode::create([
            'slug' => uniqid(),
            'series_id' => $serie_id,
            'episode_no' => $epi_no,
            'embed_link' => $filecode,
        ]);
        return redirect()->back()->with('success','created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
