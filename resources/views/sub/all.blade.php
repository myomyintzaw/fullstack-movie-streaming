@extends('layout.master')

@section('content')
    <div class="mt-5 container">
        <div class="row">

            @foreach ($data as $d)
                <div class="col-4 mt-4">
                    <div class="card bg-dark p-3 text-center">
                        <h4 class="text-white">{{ $d->total_day }} days ({{ $d->price }} mmk)</h4>
                        <div>
                            <b class="text-muted">{{ $d->name }}</b>
                        </div>
                        <p class="mt-3">
                            No ads for all videos for {{ $d->total_day }} days
                        </p>
                        <div class="text-center">
                            <a href="{{url('/buy-package/'.$d->slug)}}" class="btn btn-warning btn-block">Buy Now</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
