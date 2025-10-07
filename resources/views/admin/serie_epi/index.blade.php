@extends('admin.layout.master')

@section('content')
    {{-- <a href="" class="btn btn-primary"> <i class="fas fa-plus-circle"></i> Add New Category </a> --}}

    <div class="mb-5">
        <form action="{{ route('admin.serie-epi.store') . '?serie_id=' . $data->id }}" method="POST">
            @csrf
            <input type="text" value="{{ $episode_no }}" name="epi_no" class="btn-outline-dark text-center w-25" readonly>
            <input type="text" placeholder="Movie direct source" name="direct_link" class="btn btn-outline-dark w-50">
            <input type="submit" value="Create Episode" class="btn btn-dark">
        </form>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Data</th>
                <th>Embed Link</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->episode as $d)
                <tr>
                    <td>
                        <form action="{{ route('admin.serie-epi.update', $d->id) . '?serie_id=' . $data->serie_id }}"
                            method="POST">
                            @method('PUT')
                            <input type="text" value="{{ $d->episode_no }}" class=" btn btn-outline-dark">
                            <input type="text" placeholder="Movie direct source" class="btn btn-outline-dark w-50">
                            <input type="submit" value="Create Episode" class="btn btn-dark">
                        </form>
                    </td>
                    <td>{{ $d->embed_link }}</td>
                    <td>
                        <form onsubmit="return confirm('sure for delete?')"
                            action="{{ route('admin.category.destroy', $d->id) }}" class="d-inline" method="POST">
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
