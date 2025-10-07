@extends('admin.layout.master')

@section('content')

    <div class="mb-5">
        <a href="{{ route('admin.movie.create') }}" class="btn btn-primary">Create Movie</a>
    </div>

    <table class="mt-3 table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Rating</th>
                <th>View Count</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr>
            <td><img src="{{$d->image}}" width="60px"></td>
            <td>{{$d->name}}</td>
            <td>
                @foreach ($d->category as $c)
                    <span class="badge badge-warning">{{$c->name}}</span>
                @endforeach
            </td>
            <td>{{$d->rating}}</td>
            <td><span class="badge badge-success">{{$d->view_count}}</span></td>
            <td>
                <a href="{{route('admin.movie.edit',$d->id)}}" class="btn btn-sm btn-info">Edit</a>
                <form onsubmit="return confirm('sure for delete?')" class="d-inline" action="{{route('admin.movie.destroy',$d->id)}}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
{{$data->links()}}


@endsection

@section('js')


@endsection
