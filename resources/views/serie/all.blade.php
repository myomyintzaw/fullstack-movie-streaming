@extends('layout.master')

@section('content')
<style>
    .border-muted{
        border:1px solid rgba(113,113,113,0216) !important;
    }
</style>

  <!-- movie list -->
    <div class="container-fluid mt-4">

        <div class="row">
            {{-- siber --}}
            <div class="col-3">
                <div class="bg-dark">
                    <h4 class="p-0 m-0 p-2 text-white">Filter Serie</h4>
                </div>

                <div class="card bg-transparent border border-muted">
                    <div class="card-body p-0 m-0 p-3">
                        <h5 class=" text-success p-0 m-0">Search Serie</h5>
                        <form action="" class="mt-3">
                            <input type="text" class="btn border border-warning col-auto" name="search" placeholder="enter search">
                            <input type="submit" value="search" class="btn btn-warning m-1">
                        </form>

                    </div>
                </div>

                   <div class="card bg-transparent border border-muted mt-3 mb-3">
                    <div class="card-body p-0 m-0 p-3">
                       <h5 class="text-secondary p-0 m-0">By Category</h5>
                       <div class="mt-3">
                        @foreach ($category as $c )
                             <a href="{{{url('/movie?slug='.$c->slug)}}}" class="btn btn-outline-warning m-1">{{$c->name}}</a>
                        @endforeach
                       </div>
                    </div>
                </div>

                <div class="card bg-transparent border border-muted mt-3 mb-3">
                    <div class="card-body p-0 m-0 p-3">
                       <h5 class="text-secondary p-0 m-0">By Rating</h5>
                       <div class="mt-3">
                        <div class="btn btn-outline-primary">5 > rating</div>
                        <div class="btn btn-outline-primary">5 &lt; rating</div>
                       </div>
                    </div>
                </div>

            </div>
            {{-- end siber --}}

            <div class="col-9">
                <div class="row">
                    <div class="col-12">right content</div>

                </div>
            </div>

            {{-- @foreach ($latest_movie as $d )

            <div class="col-6 col-sm-6 col-md-3 col-lg-2">
                <div class="movie-card-container position-relative d-flex justify-content-center align-items-center"
                    style="background-image: url('{{$d->image}}');">
                    <!-- rating -->
                    <div
                        class="rating position-absolute rounded-circle d-flex justify-content-center align-items-center">
                        <span class="text-white">{{$d->rating_no}}</span>
                    </div>
                    <!-- play icon -->
                    <div class="play-icon rounded-circle d-flex justify-content-center align-items-center">
                        <i class="fa-regular fa-circle-play text-yellow"></i>
                    </div>
                </div>
            </div>
             @endforeach --}}



        </div>


    </div>


@endsection
