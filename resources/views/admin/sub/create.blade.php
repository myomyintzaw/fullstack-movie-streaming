@extends('admin.layout.master')

@section('content')

    {{-- <a href="" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Add New Category </a> --}}

    <div class="mb-5">
        <a href="{{route('admin.sub.index')}}" class="btn btn-primary">All Subscribtion</a>
    </div>

    <form action="{{route('admin.sub.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Enter Name</label>
            <input type="text" name="name" class="form-control">
        </div>
         <div class="form-group">
            <label for="">Enter Total Day</label>
            <input type="text" name="total_day" class="form-control">
        </div>
         <div class="form-group">
            <label for="">Enter Price</label>
            <input type="text" name="price" class="form-control">
        </div>


        <input type="submit" class="btn btn-primary" value="create">
    </form>


    @endsection
