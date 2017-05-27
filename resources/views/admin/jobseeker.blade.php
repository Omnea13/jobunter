@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('public/plugins/datatable/jquery.dataTables.min.css') }}">
    <style>
        .mt-20 {
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="row mt-20">
        <div class="col-md-12">
            <table class="table table-striped" id="myTable" style="border-collapse:collapse;" >
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Phone</th>
                        <th>Date of birth</th>
                        <th>Gender</th>
                        <th>Avatar</th>
                        <th>Country</th>
                        <th>City</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jobseekers as $jobseeker)
                        <tr>
                            <td>{{ $jobseeker->id }}</td>
                            <td>{{ $jobseeker->name }}</td>
                            <td>{{ $jobseeker->email }}</td>
                            <td>{{ $jobseeker->type }}</td>
                            <td>{{ $jobseeker->jobseeker['phone'] }}</td>
                            <td>{{ $jobseeker->jobseeker['date_of_birth'] }}</td>
                            <td>{{ $jobseeker->jobseeker['gender'] }}</td>
                            <td>{{ $jobseeker->jobseeker['avatar'] }}</td>
                            <td>{{ $jobseeker->jobseeker['country'] }}</td>
                            <td>{{ $jobseeker->jobseeker['city'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('public/plugins/datatable/jquery.dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('#myTable').DataTable();
        });
    </script>
@endsection