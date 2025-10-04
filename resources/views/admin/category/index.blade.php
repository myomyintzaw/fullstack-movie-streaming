@extends('admin.layout.master')

@section('content')

    {{-- <a href="" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Add New Category </a> --}}

    <div class="mb-5">
        <a href="{{route('admin.category.create')}}" class="btn btn-primary">Create Category</a>
    </div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Slug</th>
            <th>Name</th>
            <th>Movie Count</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td>{{$d->slug}}</td>
            <td>{{$d->name}}</td>
            <td><span class="badge badge-warning">{{$d->movie_count}}</span></td>
            <td>
                <a href="{{route('admin.category.edit',$d->id)}}" class="btn btn-sm btn-primary">Edit</a>
                <form onsubmit="return confirm('sure for delete?')" action="{{route('admin.category.destroy',$d->id)}}" class="d-inline" method="POST">
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
