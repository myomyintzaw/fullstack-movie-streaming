@extends('admin.layout.master')

@section('content')

    <div class="mb-5">
        <a href="{{ route('admin.movie.index') }}" class="btn btn-primary">All Movie</a>
    </div>

    <div id="root">

    </div>
@endsection

@section('js')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    var blade_movie_category = @json($category);
    console.log(blade_movie_category);
</script>


    @viteReactRefresh
    @vite('resources/js/Movie/CreateMovie.jsx')

    <script>
        $(function() {
            $('#movie_category').select2();
        });
    </script>

@endsection
