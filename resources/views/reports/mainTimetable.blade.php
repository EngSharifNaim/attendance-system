@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Contextual</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>
        <div class="card-header" style="padding: 0px;">
            <form action="{{Route('mainReport')}}">
                @csrf
                <div class="input-group" style="padding-left: 10px">
                    <div class="form-group-feedback form-group-feedback-left">
                        <div class="row">
                            <div class="col col-md-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="beginYear" class="form-control" value="{{old('beginYear')}}" placeholder="----">
                                        <span class="form-text text-muted">Begin from</span>
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" name="beginMonth" class="form-control" value="{{old('beginMonth')}}" placeholder="--">
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" name="beginDay" class="form-control" value="{{old('beginDay')}}" placeholder="--">
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="endYear" class="form-control" value="{{old('endYear')}}" placeholder="----">
                                        <span class="form-text text-muted">End to</span>
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" name="endMonth" class="form-control" value="{{old('endMonth')}}" placeholder="--">
                                    </div>

                                    <div class="col-md-3">
                                        <input type="text" name="endDay" class="form-control" value="{{old('endDay')}}" placeholder="--">
                                    </div>
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class="form-group">
                                    <select class="form-control" name="employee" id="sel1">
                                        <option value="0">Select Employee</option>
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                                        @endforeach
                                    </select>
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
                    <th>Employee</th>
                    <th>Time in</th>
                    <th>Date</th>
                    <th>Login Time</th>
                    <th>Logout Time</th>
                    <th>Duration</th>
                    <th>Late</th>
                    <th>Pre. Out</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($logs as $log)
                    @if($log->User)
                        @if($log->late > 900 && $log->preout > 900)
                            <tr style="background-color: #e57373; height: 10px">
                        @endif
                        @if($log->late > 900 && $log->preout <= 900)
                            <tr style="background-color: #f4b0af; height: 10px">
                        @endif
                        @if($log->late <= 900 && $log->preout > 900)
                            <tr style="background-color: #ffc4b1; height: 10px">
                        @endif
                        @if($log->late <= 900 && $log->preout <= 900)
                            <tr style="background-color: #5cd08d; height: 10px">
                                @endif


                                <td>{{$log->User->login_id}}</td>
                                <td>{{$log->User->name}}</td>
                                <td>{{$log->User->Department->timein}}</td>
                                <td>{{$log->log_date}}</td>
                                <td>{{date('H:i:s',strtotime($log->login_at))}}</td>
                                <td>{{date('H:i:s',strtotime($log->logout))}}</td>
                                <td>{{$log->makeTime($log->duration)}}</td>
                                <td>{{$log->makeTime($log->late)}}</td>
                                <td>{{$log->makeTime($log->preout)}}</td>

                                @if($log->late > 900 && $log->preout > 900)
                                    <td style="font-size: 10px">حضور متأخر + انصراف مبكر</td>
                                @endif
                                @if($log->late > 900 && $log->preout <= 900)
                                    <td style="font-size: 10px">حضور متأخر </td>
                                @endif
                                @if($log->late <= 900 && $log->preout > 900)
                                    <td style="font-size: 10px">إنصراف مبكر </td>
                                @endif
                                @if($log->late <= 900 && $log->preout <= 900)
                                    <td style="font-size: 10px">حضور كامل </td>
                                @endif
                            </tr>
                        @endif
                        @endforeach

                        {{ $logs->links() }}
                </tbody>
            </table>
        </div>
    </div>
@endsection
