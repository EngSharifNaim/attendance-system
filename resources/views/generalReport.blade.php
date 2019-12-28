@extends('layouts.app')
@section('content')
    <div class="content">
        <form action="{{route('generalRepotfilter')}}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="form-group-feedback form-group-feedback-left">
                    <div class="row">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
										<span class="input-group-prepend">
										</span>
                                <input type="date" name="start_date" class="form-control daterange-single" value="01-01-2019">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
										<span class="input-group-prepend">
										</span>
                                <input type="date" name="end_date" class="form-control daterange-single" value="{{now()}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-control-feedback form-control-feedback-lg">
                        <i class="icon-search4 text-muted"></i>
                    </div>
                </div>

                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary btn-lg legitRipple">Search</button>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-header header-elements-inline">
                <div class="header-elements">

                </div>
            </div>

            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                    <li class="nav-item"><a href="#highlighted-justified-tab1" class="nav-link legitRipple active show" data-toggle="tab">
                                                        Attended Now
                            <div class="legitRipple-ripple" style="left: 46.9649%; top: 52.381%; transform: translate3d(-50%, -50%, 0px); width: 207.077%; opacity: 0;"></div><div class="legitRipple-ripple" style="left: 61.6613%; top: 50%; transform: translate3d(-50%, -50%, 0px); width: 207.077%; opacity: 0;"></div></a></li>
                    <li class="nav-item">
                        <a href="#highlighted-justified-tab2" class="nav-link legitRipple" data-toggle="tab">
                            Total Attend Time
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#highlighted-justified-tab3" class="nav-link legitRipple" data-toggle="tab">
                            Main time table
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#highlighted-justified-tab4" class="nav-link legitRipple" data-toggle="tab">
                            Report2
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#highlighted-justified-tab5" class="nav-link legitRipple" data-toggle="tab">
                            Report3
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#highlighted-justified-tab6" class="nav-link legitRipple" data-toggle="tab">
                            Report4
                        </a>
                    </li>

                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="highlighted-justified-tab1">
                        @include('employee')
                    </div>

                    <div class="tab-pane fade" id="highlighted-justified-tab2">
                        @include('reports.inOutreport')
                    </div>
                    <div class="tab-pane fade" id="highlighted-justified-tab3">
                        @include('reports.mainTimetable');
                    </div>
                    <div class="tab-pane fade" id="highlighted-justified-tab4">
                        Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
                    </div>
                    <div class="tab-pane fade" id="highlighted-justified-tab5">
                        Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
                    </div>
                    <div class="tab-pane fade" id="highlighted-justified-tab6">
                        Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
                    </div>
                </div>
            </div>
        </div>
        <!-- /default styling -->


        <!-- Table header styling -->
        <!-- /table header styling -->


        <!-- Table footer styling -->

        <!-- /table footer styling -->


        <!-- Contextual classes -->
        <!-- /contextual classes -->


        <!-- Custom row colors -->
        <!-- /custom row colors -->


        <!-- Custom table color -->
        <!-- /custom table color -->


        <!-- Colored table options -->
        <!-- /colored table options -->


        <!-- Color combination -->
        <!-- /color combination -->


        <!-- Inside colored panel -->
        <!-- /inside colored panel -->

    </div>
@endsection
