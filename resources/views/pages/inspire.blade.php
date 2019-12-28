<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{url('global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/bootstrap_limitless.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/layout.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{url('global_assets/js/main/jquery.min.js')}}"></script>
    <script src="{{url('global_assets/js/main/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <script src="{{url('global_assets/js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{url('assets/js/app.js')}}"></script>
    <!-- /theme JS files -->
</head>
<body>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Date</th>
            <th>Clock In</th>
            <th>Clock Out</th>
            <th>Work Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($col as $col)
        <tr>
            <td>{{$col->ac_no}}</td>
            <td>{{$col->name}}</td>
            <td>{{$col->date}}</td>
            <td>{{$col->clock_in}}</td>
            <td>{{$col->clock_out}}</td>
            <td>{{$col->work_time}}</td>
        </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
