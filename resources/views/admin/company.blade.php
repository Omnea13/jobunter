@extends ('layouts.admin')

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
            <table id="companyTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Company Size</th>
                        <th>Country</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>{{$company->name}}</td>
                            <td>{{ $company->company['company_size'] }}</td>
                            <td>{{ $company->company['country'] }}</td>
                            <td>{{ $company->company['phone'] }}</td>
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
            $('#companyTable').DataTable();
        });
    </script>
@endsection