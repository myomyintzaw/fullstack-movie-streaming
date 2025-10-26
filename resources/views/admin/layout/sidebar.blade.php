 <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                {{-- <i class="ni ni-atom text-warning"></i> --}}
                                <i class="fa-solid fa-chart-pie text-warning"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>


                           <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.category.index') }}">
                                <i class="fa-solid fa-list-check text-warning"></i>
                                <span class="nav-link-text">Category</span>
                            </a>
                        </li>

                           <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.movie.index') }}">
                                {{-- <i class="ni ni-atom text-warning"></i> --}}
                                <i class="fa-solid fa-clapperboard text-warning"></i>
                                <span class="nav-link-text">Movie</span>
                            </a>
                        </li>


                          <li class="nav-item">
                            <a class="nav-link active" href="{{route('admin.serie.index')}}">
                                {{-- <i class="ni ni-atom text-warning"></i> --}}
                                <i class="fa-solid fa-tv text-warning"></i>
                                <span class="nav-link-text">Serie</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('admin.ads.index')}}">
                               <i class="fa-brands fa-buysellads text-warning"></i>
                                <span class="nav-link-text">ADS Management</span>
                            </a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link active" href="{{route('admin.sub.index')}}">
                                <i class="ni ni-diamond text-warning"></i>
                                <span class="nav-link-text"> Packages</span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link active" href="{{url('admin/sub-buy')}}">
                                <i class="fa-solid fa-boxes-packing text-warning"></i>
                                <span class="nav-link-text"> Packages Buy</span>
                            </a>
                        </li>

                        {{-- <li class="nav-item ">
                            <a class="nav-link active" href="#homeData" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-dashboards">
                                <i class="ni ni-diamond text-warning"></i>
                                <span class="nav-link-text ">Movies</span>
                            </a>
                            <div class="collapse" id="homeData">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="">
                                            <i class="ni ni-diamond text-primary sidenav-mini-icon"></i>
                                            <span class="sidenav-normal">Movie category</span>
                                        </a>
                                         <a class="nav-link" href="{{ route('admin.movie.index') }}">
                                            <i class="ni ni-diamond text-primary sidenav-mini-icon"></i>
                                            <span class="sidenav-normal">Movie</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}

                    </ul>
