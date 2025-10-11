@extends('admin.layout.master')

@section('content')


    <div class="mb-5">
        <a href="{{route('admin.ads.index')}}" class="btn btn-primary">All Ads</a>
    </div>

    <form action="{{route('admin.ads.update',$data->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Enter Ads Type</label>
            <input type="text" name="ads_type" class="form-control"  value="{{$data->ads_type}}">
        </div>
        <div class="form-group">
            <label for="">Enter Ads Script</label>
            <input type="text" name="ads_script" class="form-control"  value="{{$data->ads_script}}">
        </div>
        <div class="form-group">
            <label for="">on/off</label>
            <select name="on_off" class="form-control" id="">
                <option value="on" {{$data->on_off=='on'?'selected':''}}>on</option>
                <option value="off" {{$data->on_off=='off'?'selected':''}}>off</option>
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="Update Ads">
    </form>


    @endsection
