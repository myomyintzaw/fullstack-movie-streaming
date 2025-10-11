@extends('admin.layout.master')

@section('content')

    {{-- <a href="" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Add New Category </a> --}}

    <div class="mb-5">
        <a href="{{route('admin.ads.index')}}" class="btn btn-primary">All Ads</a>
    </div>

    <form action="{{route('admin.ads.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Enter Ads Type</label>
            <input type="text" name="ads_type" class="form-control">
        </div>
         <div class="form-group">
            <label for="">Enter Ads Script</label>
            <input type="text" name="ads_script" class="form-control">
        </div>
          <div class="form-group">
            <label for="">on/off</label>
            <select name="on_off" id="" class="form-control">
                <option value="on">on</option>
                <option value="off">off</option>
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="create">
    </form>


    @endsection
