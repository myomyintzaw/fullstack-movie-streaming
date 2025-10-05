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
</script>


    @viteReactRefresh
    @vite('resources/js/Serie/CreateSerie.jsx')

    <script>
        $(function() {
            $('#movie_category').select2();
        });
    </script>

@endsection
