@extends('layout.master')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="card bg-dark">
                <div class="card-header bg-yellow">
                    <h4 class="p-0 m-0 text-center">Account Login</h4>
                </div>
                <div class="card-body bg-transparent">
                    <form action="{{url('/login')}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="" class="text-white">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                         <div class="form-group">
                            <label for="" class="text-white">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <input type="submit" value="Login" class="btn bg-yellow">

                    </form>


                </div>


            </div>
        </div>
    </div>
</div>
@endsection
