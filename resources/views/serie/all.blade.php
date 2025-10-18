@extends('layout.master')

@section('content')
<style>
    .border-muted{
        border:1px solid rgba(113,113,113,0216) !important;
    }
</style>

  <!-- serie list -->
    <div class="container-fluid mt-4">

        <div class="row">
            {{-- siber --}}
            <div class="col-3">
                <div class="bg-dark">
                    <h5 class="p-0 m-0 p-2 text-white">Filter Serie</h5>
                </div>

                @if(request()->is_search)
                <div class="card bg-transparent border border-muted">
                    <div class="card-body p-0 m-0 p-3">
                      <a href="{{url('/serie')}}">Clear Filter</a>
                    </div>
                </div>
                @endif

                <div class="card bg-transparent border border-muted">
                    <div class="card-body p-0 m-0 p-3">
                        <h5 class=" text-success p-0 m-0">Search Serie</h5>
                        <form action="" class="mt-3">
                            <input type="hidden" name="is_search" value="y">
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
                             <a href="{{{url('/serie?is_search=y&category='.$c->slug)}}}" class="btn btn-outline-warning m-1">{{$c->name}}</a>
                        @endforeach
                       </div>
                    </div>
                </div>

                <div class="card bg-transparent border border-muted mt-3 mb-3">
                    <div class="card-body p-0 m-0 p-3">
                       <h5 class="text-secondary p-0 m-0">By Rating</h5>
                       <div class="mt-3">
                        <a href="{{url('/serie?is_search=y&rating=belowfive')}}" class="btn btn-outline-primary">5 &gt; rating</a>  <!-- 5 > rating -->
                        <a href="{{url('/serie?is_search=y&rating=abovefive')}}" class="btn btn-outline-primary">5 &lt; rating</a>
                       </div>
                    </div>
                </div>

            </div>
            {{-- end siber --}}

            {{-- right content --}}
            <div class="col-9">
            <div class="row">

            @foreach ($data as $d )
            <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                <a href="{{url('/serie/'.$d->slug)}}">
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
                </a>
            </div>
             @endforeach

             {{-- paginate  --}}
             <div class="col-12">
                <div class="mt-3">
                {{$data->links()}}
                </div>
             </div>




                </div>
            </div>
              {{--end right content --}}




        </div>
    </div>


@endsection
