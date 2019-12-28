@extends('layouts.app')

<!-- Page content -->
@section('content')

    <div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Data file</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <p class="mb-4">Select a file with formate *.XLSX</p>

        <form action="{{url('importXL')}}" method="post" enctype="multipart/form-data">
            @csrf

            <fieldset class="mb-3">

                <div class="form-group row">
                    <label class="col-form-label col-lg-2">select Data file</label>
                    <div class="col-lg-10">
                        {{--                        <div class="uniform-uploader">--}}
                        <input type="file" name="import_file" class="form-control">
                        {{--                            <span class="filename" style="user-select: none;">No file selected</span>--}}
                        {{--                            <span class="action btn btn-light legitRipple" style="user-select: none;">Choose File</span>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </fieldset>
            <div class="form-group pt-2">
                <div class="form-check">
                    <label class="form-check-label">
                       <input name="daleteData" type="checkbox">
                        Delete existing data
                    </label>
                </div>
            </div>


            <div class="text-right">
                <button type="submit" class="btn btn-primary legitRipple">Submit <i class="icon-paperplane ml-2"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection
