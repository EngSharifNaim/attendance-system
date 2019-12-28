@extends('layouts.app')
@section('content')
    <div class="content">

        <!-- Default styling -->

        @foreach($errors->all() as $error)
            <i class="alert alert-danger">{{$error}}</i>

        @endforeach
        <form action="{{route('createEmployee')}}" method="post">
            @csrf
            <div class="input-group mb-3">
                <div class="form-group-feedback form-group-feedback-left">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="name" class="form-control form-control-lg"  placeholder="Employee Name ..">

                        </div>
                        <div class="col-md-4">
                            <input type="text" name="login_id" class="form-control form-control-lg"  placeholder="Employee Name ..">

                        </div>
                        <div class="col-md-4">
                            <input type="text" name="email" class="form-control form-control-lg"  placeholder="Employee Name ..">

                        </div>
                    </div>
                    <div class="form-control-feedback form-control-feedback-lg">
                        <i class="icon-search4 text-muted"></i>
                    </div>
                </div>

                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary btn-lg legitRipple">Save</button>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Employee List</h5>
                <div class="header-elements">
                    <a href="#" class="btn btn-danger">Delete All</a>
                    <a href="{{URL::to('getImport')}}" class="btn btn-success">Emport</a>
                    <div class="btn-group">
                        <button class="btn btn-info">Export</button>
                        <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle DropDown</span>
                        </button>
                        <ul class="dropdown-menu" role="menu" id="export-menu">
                            <li id="export-to-excel"><a href="{{ url('exportXL/xlsx') }}">Export to Excel</a></li>
                            <li id="export-to-csv"><a href="{{ url('exportXL/csv') }}">Export to CSV</a></li>
                            <li class="divider"></li>
                            <li id="other"><a href="#">Other</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-text"><p>{{'Total Hours : ' . $employees->count()}}</p></div>
            </div>
            <div class="card-title" style="align-content: center">
                @if(isset($msg))
                    <span class="alert alert-success">{{$msg}}</span>
                @endif
            </div>


            <div class="table-responsive">
                <div id="items">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Login_ID</th>
                        <th>Name</th>
                        <th>Time In</th>
                        <th>Email</th>

                        <th>From</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody style="font-size: 12px; font-family: sans-serif, Arial, Verdana, "Trebuchet MS"">
                    @foreach($employees as $employee)
                        <tr>
                            <td>
                                <input type="hidden" id="delId">
                                {{$employee->id}}</td>
                            <td>{{$employee->login_id}}</td>
                            <td>{{$employee->name}}</td>
                            <td>
                                @if($employee->department_id<>0)
                                {{$employee->Department->timein }}
                                    @endif
                            </td>
                            <td>{{$employee->email}}</td>

{{--                            <td>{{$employee->created_at->diffForHumans()}}</td>--}}
                            <td>
                                <ul class="list-inline list-inline-condensed mb-3 mb-sm-0">
                                    <li class="list-inline-item">
                                        <a href="#">
                                            <span class="badge bg-green-300">Edit</span></a></li>
                                    <li class="list-inline-item" class="deleteIcon">
                                        <a href="#" class="pull-right" id="deleteIcon" data-id="{{$employee->id}}" data-toggle="modal" data-target="#deleteMsg">
                                            <span class="badge bg-danger">Delete</span>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>

                    {{--                    {{ $employees->links() }}--}}
                </table>
                </div>
                <div class="modal" tabindex="-1"id="deleteMsg"  role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="title">Delete Warning</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {{--                        popUp delete--}}
                            <div class="modal-body">
                                <input type="hidden" id="delId">
                                <p>Are you sure of delete...</p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" id="deleteYs" data-dismiss="modal">Yes</button>
                                <button type="button" class="btn btn-primary" id="deleteNo" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
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
<script
    src="https://code.jquery.com/jquery-3.4.0.js"
    integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function () {
        $(document).on('click','.ourItem',function (event) {
            //         var text = $.trim($(this).text());
            $('#id').val($(this).find('#itemId').val());
            //         $('#addItem').val(text);
            //         $('#title').text('Edit Item');
            //         $('#id').val(id);
            //         $('#deleteButton').show();
            //         $('#saveButton').show();
            //         $('#addButton').hide();
            //         console.log(id);
        });

        $(document).on('click','#addnew',function (event) {
            $('#addItem').val('');
            $('#title').text('Add new Item');
            $('#deleteButton').hide();
            $('#saveButton').hide();
            $('#addButton').show();
        });

        $('#addButton').click(function (event) {
            var text = $('#addItem').val();
            if (text=='')
            {
                alert('Pleaze Inert Item Naim');
            }else
            {
                $.post('list', {'text': text, '_token': $('input[name=_token]').val()}, function (data) {
                    console.log(data);
                    $('#items').load(location.href + ' #items');

                });
            }

        });
        $(document).on('click','#saveItem',function (event) {

            var text = $('#addItem').val();
            if (text=='')
            {
                alert('Pleaze Insert Item Naim');
            }else
            {
                $.post('list', {'text': text, '_token': $('input[name=_token]').val()}, function (data) {
                    console.log(data);
                    $('#items').load(location.href + ' #items');

                });
            }

            $('#addItem').val('');

        });
        $('#deleteButton').click(function (event) {
            var id = $('#id').val();
            $.post('delete', {'id': id,'_token':$('input[name=_token]').val()}, function (data) {
                console.log(data);
                $('#items').load(' #items');
            });
        })
        $(document).on('click','#deleteYs',function (event) {

            var id = $('#delId').val();
            $.post('deleteEmployee', {'id': id,'_token':$('input[name=_token]').val()}, function (data) {
                console.log(data);
                $('#items').load(location.href + ' #items');
            });
        })
        $(document).on('click','#deleteIcon',function (event) {
            var dataID = this.dataset.id;
            $('#delId').val(dataID);
        })

        $('#saveButton').click(function (event) {
            var id = $('#id').val();
            var value=$('#addItem').val();
            $.post('update', {'id': id,'value': value,'_token':$('input[name=_token]').val()}, function (data) {
                console.log(data);
                $('#items').load(location.href + ' #items');
            });
        })

        $(document).on('click','#saveEdit',function (event) {
            var dataID = this.dataset.id;
            var id = $('#itemId-'+dataID).val();
            var value=$('#editItem-'+dataID).val();
            $.post('update', {'id': id,'value': value,'_token':$('input[name=_token]').val()}, function (data) {
                console.log(data);
                $('#items').load(location.href + ' #items');
            });
            $('#editForm-'+dataID).hide();
            $('#echoForm-'+dataID).show();
            $('#items').load(location.href + ' #items');


        })
        $(document).on('click','#editIcon',function (event) {
            var dataID = this.dataset.id;
            $('#editForm-'+dataID).show();
            $('#echoForm-'+dataID).hide();

        })

        $(document).on('click','#itemArea',function (event) {
            var dataID = this.dataset.data-id;
            $('#editForm-'+dataID).show();
            $('#echoForm-'+dataID).hide();

        })

        $( function() {
            $( "#searchItem" ).autocomplete({
                source: '{{ url('search') }}',
                select: function (event,ui) {
                    event.preventDefault();
                    $('#searchItem').val(ui.item.label);

                    alert(ui.item.value)
                }

            });
        } );


    })
</script>
