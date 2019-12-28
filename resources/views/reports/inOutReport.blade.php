@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">ٍShort Report</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>
        <div class="card-header" style="padding: 0px;">
            <form action="{{Route('filterEmployeeReport')}}" method="post">
                @csrf
                <div class="input-group" style="padding-left: 10px">
                    <div class="form-group-feedback form-group-feedback-left">
                        <div class="row">
                            <div class="col col-md-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="beginYear" class="form-control" placeholder="----">
                                        <span class="form-text text-muted">Begin from</span>
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" name="beginMonth" class="form-control" placeholder="--">
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" name="beginDay" class="form-control" placeholder="--">
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="endYear" class="form-control" placeholder="----">
                                        <span class="form-text text-muted">End to</span>
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" name="endMonth" class="form-control" placeholder="--">
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" name="endDay" class="form-control" placeholder="--">
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="exYear" class="form-control" placeholder="----">
                                        <span class="form-text text-muted">Exact Date</span>
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" name="exMonth" class="form-control" placeholder="--">
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" name="exDay" class="form-control" placeholder="--">
                                    </div>
                                </div>
                            </div>

                            <div class="col col-md-3">
                                <div class="input-group-append">
                                    <button type="submit" name="search" value="search" class="btn btn-primary btn-lg legitRipple">Search</button>
                                </div></div>
                        </div>
                        <div class="form-control-feedback form-control-feedback-lg">
                            <i class="icon-search4 text-muted"></i>
                        </div>
                    </div>

            </form>

        </div>
        <div class="card-body">

        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Dept</th>
                    <th>Name</th>
                    <th>Login ID</th>
                    <th>Email</th>
                    <th>Work Days</th>
                    <th>Total Time</th>
                    <th>Late sum</th>
                    <th>Pre. Out</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->id}}</td>

                        <td>
                            @if($employee->Department)
                                {{$employee->Department->name}}
                            @endif

                        </td>

                        <td>
                            <a href="#" data-toggle="modal" data-target="#modal_full{{$employee->id}}">
                                {{$employee->name}}
                            </a>
                        </td>
                        <td>{{$employee->login_id}}</td>
                        <td>{{$employee->email}}</td>
                        <td>
                            @if(isset($beginDate) || isset($endDate) || isset($exDate))
                                {{$employee->workDays($employee->id,$beginDate,$endDate,$exDate) . ' Days'}}
                            @else
                                {{$employee->workDays($employee->id) . ' Days'}}
                            @endif
                        </td>
                        <td>
                            @if(isset($beginDate) || isset($endDate) || isset($exDate))
                                {{$employee->getDurations($employee->id,$beginDate,$endDate,$exDate)}}
                            @else
                                {{$employee->getDurations($employee->id)}}

                            @endif
                        </td>
                        <td>
                            @if(isset($beginDate) || isset($endDate) || isset($exDate))
                                {{$employee->getLates($employee->id,$beginDate,$endDate,$exDate)}}
                            @else
                                {{$employee->getLates($employee->id)}}
                            @endif
                        </td>
                        <td>
                            @if(isset($beginDate) || isset($endDate) || isset($exDate))
                                {{$employee->getPreOut($employee->id,$beginDate,$endDate,$exDate)}}
                            @else
                                {{$employee->getPreOut($employee->id)}}
                            @endif

                        </td>


                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @foreach($employees as $employee)
            <div id="modal_full{{$employee->id}}" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-full">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title" style="font-size: 16px">
                                @if($employee->name)
                                    {{$employee->name}}
                                @endif
                            </p>
                            <p class="modal-title" style="font-size: 12px; color: #dc3545">
                                @if($employee->Department)
                                    {{$employee->Department->name}}</p>
                            @endif

                            {{'Total Work time :' . $employee->getDurations($employee->id)}}
                            <br>
                            {{'Total Late time :' . $employee->getLates($employee->id)}}

                        </div>
                        <div class="modal-header">
                            <p class="modal-title" style="font-size: 12px;color: #1d643b">From : {{Now()}}</p>
                        </div>
                        <div class="modal-header">
                            <p class="modal-title" style="font-size: 12px;color: #1d643b">To : {{Now()}}</p>
                        </div>

                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee</th>
                                        <th>Date</th>
                                        <th>Login Time</th>
                                        {{--                                <th>Logout Date</th>--}}
                                        <th>Logout Time</th>
                                        <th>Work Time</th>
                                        <th>Late</th>
                                        <th>Pre. Out</th>                            </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employee->getTimeline($employee->id) as $employee)
                                        @if($employee->User)
                                            <tr>
                                            @if($employee->late > '00:25:00')
                                                <tr style="background-color: #F7C5C5">
                                                    @endif

                                                    <td>{{$employee->User->login_id}}</td>
                                                    <td>{{$employee->User->name}}</td>
                                                    <td>{{date('Y-m-d',strtotime($employee->log_date))}}</td>
                                                    <td>{{date('H:i:s',strtotime($employee->login_at))}}</td>
                                                    {{--                                        <td>{{date('d-m-Y',strtotime($employee->logout_at))}}</td>--}}
{{--                                                    <td>{{date('H:i:s',strtotime($employee->logout_at))}}</td>--}}
                                                    {{--                                        <td>{{$employee->timeToInt($employee->makeTime($employee->duration * 60 * 60))}}</td>--}}
                                                    <td>{{$employee->makeTime($employee->duration)}}</td>
                                                    <td>{{$employee->makeTime($employee->late)}}</td>
                                                    <td>{{$employee->makeTime($employee->preout)}}</td>
                                                </tr>
                                    @endif
                                    @endforeach

                                </table>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-link legitRipple" data-dismiss="modal">Close<div class="legitRipple-ripple" style="left: 58.0686%; top: 50%; transform: translate3d(-50%, -50%, 0px); width: 225.28%; opacity: 0;"></div><div class="legitRipple-ripple" style="left: 28.0537%; top: 71.0526%; transform: translate3d(-50%, -50%, 0px); width: 225.28%; opacity: 0;"></div><div class="legitRipple-ripple" style="left: 53.9757%; top: 50%; transform: translate3d(-50%, -50%, 0px); width: 225.28%; opacity: 0;"></div></button>
                            <button type="button" class="btn bg-primary legitRipple" onclick="myFunction(
                    @if($employee->User)
                            {{$employee->User->id}}
                            @endif
                            )">Print report</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
