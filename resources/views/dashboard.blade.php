@extends('layout.master')



@section('content')

 <!-- detail -->
    <div class="container-fluid px-5  mt-4" id="dashboard">

    </div>

@endsection


@section('js')


  @viteReactRefresh
  @vite('resources/js/Web/Dashboard.jsx')


@endsection
