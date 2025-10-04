@extends('admin.layout.master')

@section('content')


    <div class="mb-5">
        <a href="{{route('admin.category.index')}}" class="btn btn-primary">All Category</a>
    </div>

    <form action="{{route('admin.category.update',$data->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Enter Category Name" value="{{$data->name}}">
        </div>
        <input type="submit" class="btn btn-primary" value="Update Category">
    </form>


    @endsection
