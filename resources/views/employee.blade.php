        <!-- Default styling -->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Main Login Table</h5>
                <div class="header-elements">

                </div>
                <div class="card-text"><p>{{'Total Hours : ' . $atEmployees->count()}}</p></div>
            </div>


            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Login ID</th>
                        <th>Employee</th>
{{--                        <th>Day</th>--}}
                        <th>Login Time</th>
                        <th>Email</th>
                        <th>Login since</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($atEmployees as $atEmployee)
                        <tr>
                            <td>{{$atEmployee->User->login_id}}</td>
                            <td>{{$atEmployee->User->name}}</td>
{{--                            <td>{{date('d', strtotime($log->created_at)). '-' . date('m', strtotime($log->created_at)) . '-' . date('y', strtotime($log->created_at)) }}</td>--}}
                            <td>{{$atEmployee->created_at}}</td>
                            <td>{{$atEmployee->User->email}}</td>
                            <td>{{$atEmployee->created_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
{{--                    {{ $employees->links() }}--}}
                </table>
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

