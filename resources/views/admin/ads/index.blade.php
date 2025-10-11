@extends('admin.layout.master')

@section('content')

    {{-- <a href="" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Add New Category </a> --}}

    <div class="mb-5">
        <a href="{{route('admin.ads.create')}}" class="btn btn-primary">Create Ads</a>
    </div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>On/Off</th>
            <th>Ads Type</th>
            <th>Ads Script</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td>@if($d->on_off=='on')
                <span class="badge badge-success">On</span>
                @else
                <span class="badge badge-danger">Off</span>
                @endif
            </td>
            <td>{{$d->ads_type}}</td>
            <td>{{$d->ads_script}}</td>
            <td>
                <a href="{{route('admin.ads.edit',$d->id)}}" class="btn btn-sm btn-primary">Edit</a>
                <form onsubmit="return confirm('sure for delete?')" action="{{route('admin.ads.destroy',$d->id)}}" class="d-inline" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                </form>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>


    @endsection
