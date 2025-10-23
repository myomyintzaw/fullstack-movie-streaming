@extends('admin.layout.master')

@section('content')

    {{-- <a href="" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Add New Category </a> --}}

    <div class="mb-5">
        <a href="{{route('admin.sub.create')}}" class="btn btn-primary">Create</a>
    </div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Total Day</th>
            <th>Price</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td>
                {{$d->name}}
            </td>
            <td><span class="badge badge-dark text-white ">{{$d->total_day}}</span></td>
            <td>{{$d->price}} mmk</td>
            <td>
                <a href="{{route('admin.sub.edit',$d->id)}}" class="btn btn-sm btn-primary">Edit</a>

                <form onsubmit="return confirm('sure for delete?')" action="{{route('admin.sub.destroy',$d->id)}}" class="d-inline" method="POST">
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
