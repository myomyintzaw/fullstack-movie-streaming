@extends('admin.layout.master')

@section('content')

    <div class="mb-5">
        <a href="{{ route('admin.movie.index') }}" class="btn btn-primary">All Movie</a>
    </div>

    <div id="root">

    </div>
@endsection

@section('js')

<script>
    var blade_movie_category = @json($category);
    console.log(blade_movie_category);
    var blade_movie = @json($data);
    console.log(blade_movie);
</script>


    @viteReactRefresh
    @vite('resources/js/Movie/EditMovie.jsx')


@endsection
