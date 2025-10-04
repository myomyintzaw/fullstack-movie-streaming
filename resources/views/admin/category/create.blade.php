@extends('admin.layout.master')

@section('content')

    {{-- <a href="" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Add New Category </a> --}}

    <div class="mb-5">
        <a href="{{route('admin.category.index')}}" class="btn btn-primary">All Category</a>
    </div>

    <form action="{{route('admin.category.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Category Name">
        </div>
        <input type="submit" class="btn btn-primary" value="Add Category">
    </form>


    @endsection
