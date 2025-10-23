@extends('admin.layout.master')

@section('content')


    <div class="mb-5">
        <a href="{{route('admin.sub.index')}}" class="btn btn-primary">All Subscribtion</a>
    </div>

    <form action="{{route('admin.sub.update',$data->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Enter Name</label>
            <input type="text" name="name" class="form-control"  value="{{$data->name}}">
        </div>
        <div class="form-group">
            <label for="">Enter Ads Script</label>
            <input type="text" name="total_day" class="form-control"  value="{{$data->total_day}}">
        </div>
        <div class="form-group">
            <label for="">Enter Ads Script</label>
            <input type="text" name="price" class="form-control"  value="{{$data->price}}">
        </div>

        <input type="submit" class="btn btn-primary" value="Update Subscribtion">
    </form>


    @endsection
