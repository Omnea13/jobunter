@extends('layouts.admin')

@section('styles')
	<link rel="stylesheet" href="{{ asset('public/plugins/datatable/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/sweetalert/sweetalert.css') }}">
    <style>
        .mt-20 {
            margin-top: 20px;
        }
        .mt-50 {
            margin-top: 50px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-examiner-modal"> Add New Examiner</button>
        </div>
        <div class="col-md-12 mt-20">
            <table id="examiners-table" class="table table-striped">
                <thead>
                    <tr role="row">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($examiners as $examiner)
                        <tr role="row">
                            <td>{{ $examiner->name }}</td>
                            <td>{{ $examiner->email }}</td>
                            <td>
                                <i class="btn btn-info glyphicon glyphicon-edit edit-examiner" href="javascript:;" data-edit="{{ $examiner->id }}"></i> 
                                <i class="btn btn-danger glyphicon glyphicon-trash delete-examiner" href="javascript:;" data-delete="{{ $examiner->id }}"></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

	<div class="modal fade mt-50" id="add-examiner-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	    <div class="modal-dialog" role="document">
	       <div class="modal-content">
	    	    <form method="POST" id="add-examiner">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Add New Examiner</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                	<input type="hidden" name="type" value="examiner">
                                    <label>Examiner Name <span class="mandatory">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="Examiner name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Examiner E-mail <span class="mandatory">*</span></label>
                                    <input type="email" name="email" placeholder="Examiner email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Examiner password <span class="mandatory">*</span></label>
                                    <input type="password" name="password" placeholder="Examiner password" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
	       </div>
	    </div>
	</div>

    <div class="modal fade" id="edit-examiner-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="edit-examiner-form">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Edit Examiner</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Examiner Name <span class="mandatory">*</span></label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Examiner E-mail <span class="mandatory">*</span></label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('public/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/plugins/sweetalert/sweetalert.min.js') }}"></script>

	<script>
		$(document).ready(function(){
		    $('#examiners-table').DataTable();
		});

        $("form#add-examiner").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'addNewUser',
                data: $(this).serialize(),
                type: "POST",
                success: function(response) {
                    window.location = response.url;
                },
                error: function(response) {
                    var errors = response.responseJSON;
                    $.each(errors, function(name, error) {
                        $("form#add-examiner input[name='"+name+"']").parents('.form-group').addClass('has-error').append("<p class='text-danger'>"+error+"</p>");
                    });
                },
                beforeSend: function() {
                }
            });
        });

        $(".edit-examiner").on("click", function() {
            var id = $(this).data('edit');
            $.ajax({
                url: 'editUser',
                data: {id: id},
                type: "GET",
                success: function(response) {
                	$("form#edit-examiner-form input[name='id']").val(response.id);
                    $("form#edit-examiner-form input[name='name']").val(response.name);
                    $("form#edit-examiner-form input[name='email']").val(response.email);
                    $("#edit-examiner-modal").modal('show');
                },
                error: function(response) {

                },
                beforeSend: function() {
                }
            });
        });

        $("form#edit-examiner-form").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'updateUser',
                data: $(this).serialize(),
                type: "PUT",
                success: function(response) {
                    window.location = response.url;
                },
                error: function(response) {
                    
                },
                beforeSend: function() {
                }
            });
        });

        $(".delete-examiner").on("click", function() {
            var id = $(this).data('delete');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this examiner!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    url: 'deleteUser',
                    data: {id: id, _token: '{{ csrf_token() }}', _method: 'DELETE'},
                    type: "DELETE",
                    success: function(response) {
                		swal("Deleted!", "examiner has been deleted.", "success");
                        window.location.reload();
                    },
                    error: function(response) {
                        
                    },
                    beforeSend: function() {
                    }
                });    
            });
        });
	</script>
@endsection