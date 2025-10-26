@extends('admin.layout.master')

@section('content')

    <div class="mb-5">
    </div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Payment Images</th>
            <th>User Name</th>
            <th>Package Name</th>
            <th>Package Total Day</th>
            <th>Package Price</th>
            <th>Status</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $d)
        <tr>
            <td>
                <img data-toggle="modal" data-target="#id{{$d->id}}" src="{{asset('/images/'.$d->payment_image)}}" style="width: 200px" alt="">
            </td>
            <td>
                {{$d->user->name}}
            </td>
            <td><span class="badge badge-dark text-white ">{{$d->package_name}}</span></td>
            <td>{{$d->package_total_day}} day</td>
            <td>{{$d->package_price}} mmk</td>
            <td>
                @if($d->status=='pending')
                <span class="badge badge-warning">Pending</span>
                @elseif($d->status=='success')
                <span class="badge badge-success">Accepted</span>
                @else
                {{-- @if($d->status=='error') --}}
                <span class="badge badge-danger">Rejected</span>
                @endif
            </td>
            <td class="d-flex">
                <button class="btn btn-primary" data-toggle="modal" data-target="#id{{$d->id}}">Payment info</button>

                <form action="{{url('/admin/change-status')}}" class="d-inline d-flex">
                    <input type="hidden" name="buy_package_id" value="{{$d->id}}">
                    <select name="status" id="" class="form-control form-control-sm">
                        <option value="pending">Pending</option>
                        <option value="success">Accepted</option>
                        <option value="error">Rejected</option>
                    </select>
                    <input type="submit" value="Change" class="btn btn-info btn-sm ml-2">
                </form>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>

{{ $data->links() }}

  @endsection


  @section('js')
  @foreach ($data as $d)
    <!-- Modal -->
  <div class="modal fade" id="id{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">


      <div class="modal-body">
       <table class="table table-striped">
        <tr>
            <th>Payment Name</th>
            <th>Payment No</th>
            <th>Price</th>
        </tr>
        <tr>
            <td>{{$d->payment_name}}</td>
            <td>{{$d->payment_no}}</td>
            <td>{{$d->package_price}} mmk</td>
        </tr>

       </table>
        {{-- ...{{asset('/images/'.$d->payment_image)}} --}}
      </div>

    </div>
  </div>
</div>

  @endforeach
  @endsection
