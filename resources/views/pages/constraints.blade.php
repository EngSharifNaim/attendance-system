@extends('layouts.app')
@section('content')
    <div class="content">

        <!-- Content area -->
        <div class="content">

            <!-- Card image placement -->

            <div class="row">
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Employee Work Time Categories</h5>
                            @if(isset($DepartmentMsg))
                                <tr>
                                    <td>
                                        <div class="alert alert-success" role="alert">{{$DepartmentMsg}}</div>
                                    </td>
                                </tr>
                            @endif
                            @foreach($departments as $department)
                            <form class="form" action="{{url('/editDepartment')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col col-md-3">
                                        <input type="text" name="id" value="{{$department->id}}" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe" hidden>
                                        <input class="form-control form-control-sm" name="name" value="{{$department->name}}" type="text">
                                    </div>
                                    <div class="col col-md-3">
                                        <input class="form-control form-control-sm" name="timein" value="{{$department->timein}}" type="text">
                                    </div>
                                    <div class="col col-md-2">
                                        <input class="form-control form-control-sm" name="timeout" value="{{$department->timeout}}" type="text">
                                    </div>
                                    <div class="col col-md-2">
                                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                                    </div>
                                    <div class="col col-md-2">
                                        <button type="button" onclick="window.location='deleteDepartment/{{$department->id}}'" class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </form>
                                @endforeach
                            <hr>
                            <form class="form" action="{{url('/addDepartment')}}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col col-md-3">

                                        <input class="form-control form-control-sm" name="name" placeholder="Name..." type="text">
                                    </div>
                                    <div class="col col-md-3">
                                        <input class="form-control form-control-sm" name="timein" placeholder="Time In ..." type="text">
                                    </div>
                                    <div class="col col-md-2">
                                        <input class="form-control form-control-sm" name="timeout" placeholder="Time Out ..." type="text">
                                    </div>
                                    <div class="col col-md-2">
                                        <button type="submit" class="btn btn-success btn-sm">Add New</button>
                                    </div>
                                    <div class="col col-md-2">

                                    </div>
                                </div>
                            </form>

                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <span class="font-size-sm text-uppercase font-weight-semibold">Nov 12, 11:25 am</span>
                            <span class="font-size-sm text-uppercase text-success font-weight-semibold">Due in 12 days</span>
                        </div>
                    </div>
                    <!-- Below card header -->
                    <!-- /below card header -->

                </div>

                <div class="col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Employee Work Time Categories</h5>
                            @if(isset($editConstraint))
                                <tr>
                                    <td>
                                        <div class="alert alert-success" role="alert">{{$editConstraintMsg}}</div>
                                    </td>
                                </tr>
                            @endif
                            @foreach($constraints as $constraint)
                                <form class="form" action="{{url('/editConstraint')}}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col col-md-3">
                                            <input type="text" name="id" value="{{$constraint->id}}" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe" hidden>
                                            <input class="form-control form-control-sm" name="name" value="{{$constraint->name}}" type="text" disabled>
                                        </div>
                                        <div class="col col-md-3">
                                            <input class="form-control form-control-sm" name="timein" value="{{$constraint->timein}}" type="text">
                                        </div>
                                        <div class="col col-md-2">

                                        </div>
                                        <div class="col col-md-2">
                                            <button type="submit" class="btn btn-success btn-sm">Save</button>
                                        </div>
                                        <div class="col col-md-2">
                                            <button type="button" onclick="window.location='deleteDepartment/{{$department->id}}'" class="btn btn-danger btn-sm">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                            <hr>

                        </div>

                        <div class="card-footer d-flex justify-content-between">
                            <span class="font-size-sm text-uppercase font-weight-semibold">Nov 12, 11:25 am</span>
                            <span class="font-size-sm text-uppercase text-success font-weight-semibold">Due in 12 days</span>
                        </div>
                    </div>
                    <!-- Below card header -->
                    <!-- /below card header -->

                </div>

            </div>

        </div>
        <!-- /content area -->

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
