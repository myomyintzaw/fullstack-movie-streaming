@extends('layout.master')



@section('content')

 <!-- detail -->
    <div class="container-fluid px-5 mt-4 movie-detail" id="serieDetail">

    </div>

@endsection


@section('js')
<script>
    const blade_data=@json($data);
    const blade_auth=@json(auth()->user());
    const blade_related=@json($related);
</script>

  @viteReactRefresh
  @vite('resources/js/Web/Serie.jsx')


@endsection
