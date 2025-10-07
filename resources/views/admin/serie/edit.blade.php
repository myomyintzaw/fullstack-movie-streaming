@extends('admin.layout.master')

@section('content')

    <div class="mb-5">
        <a href="{{ route('admin.serie.index') }}" class="btn btn-primary">All Serie</a>
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
    @vite('resources/js/Serie/EditSerie.jsx')


@endsection
