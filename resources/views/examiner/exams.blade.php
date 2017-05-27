@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('public/plugins/datatable/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/slim/slim.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/expandable-table/css/bootstrap-table-expandable.css') }}">
    <style>
        .lh-80 {
            line-height: 80px!important;
        }
        .mt-20 {
            margin-top: 20px;
        }
        .mt-50 {
            margin-top: 50px;
        }
        .pl-0 {
        	padding-left: 0;
        }
        .badge-success {
        	background: #080;
        	color: #fff;
        }
        .remove_field {
			position: absolute;
			right: 10px;
    		top: 7px;
        }
        .remove_input {
        	position: relative!important;
        }
        i.btn {
            padding: 5px!important;
            line-height: 10px!important;
            font-size: 10px!important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
            	<button class="btn btn-info btn-block" data-toggle="modal" data-target="#add-new-category"> Add New Category</button>
            </div>
            <div class="col-md-6">
            	<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-exam-modal"> Add New Question</button>
            </div>
        </div>
		
		<div class="col-md-12 mt-20">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                @foreach($categories as $category)
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $category->id }}">
                                    {{ $category->name }}
                                </a>
                                <span class="badge">{{ count($category->exams) }}</span>
                                <span class="pull-right">
                                    <i class="btn btn-info glyphicon glyphicon-edit edit-category" href="javascript:;" data-edit="{{ $category->id }}"></i> 
                                    <i class="btn btn-danger glyphicon glyphicon-trash delete-category" href="javascript:;" data-delete="{{ $category->id }}"></i>
                                </span>
                            </h4>
                        </div>
                        <div id="collapse{{ $category->id }}" class="panel-collapse collapse" role="tabpanel">
                            <div class="panel-body">
                                <table class="table table-hover table-striped exam-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Question Image</th>
                                            <th class="text-center">Question Level</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($category->exams as $exam)
                                            <tr>
                                                <td class="text-center">
                                                    <img src="{{ asset('public/img/questions') }}/{{ $exam->question }}" alt="{{ $category->name }}">
                                                </td>
                                                <td class="text-center lh-80">{{ $exam->level }}</td>
                                                <td class="text-center lh-80">
                                                    <a href="{{ url('examiner/edit-exam') }}/{{ $exam->id }}" data-edit="{{ $exam->id }}"><i class="btn btn-info glyphicon glyphicon-edit edit-exam"></i></a> 
                                                    <i class="btn btn-danger glyphicon glyphicon-trash delete-exam" href="javascript:;" data-delete="{{ $exam->id }}"></i>
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
		</div>
    </div>
	
    <div class="modal fade mt-50" id="add-new-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
                <form method="POST" id="add-category">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Add New Category</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label for="category-name">Category Name:<span class="mandatory">*</span></label>
                                    <input autofocus id="category-name" type="text" name="name" class="form-control" placeholder="Category Name">
                                </div>
                                <div class="form-group">
                                    <label for="category-image">Category Image:</label>
                                    <div class="slim"
                                        data-label="Drop Category Image"
                                        data-size="435,245"
                                        data-ratio="2:1">
                                        <input type="file" name="category">
                                    </div>
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

    <div class="modal fade" id="edit-category-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="edit-category-form">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Edit Category</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Name <span class="mandatory">*</span></label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="edit-category-image">Category Image:</label>
                                    <div class="slim"
                                        data-label="Drop Category Image"
                                        data-size="435,245"
                                        data-ratio="2:1">
                                        <input type="file" name="category">
                                    </div>
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

    <div class="modal fade mt-50" id="add-exam-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
           <div class="modal-content">
                <form method="POST" id="add-exam">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Add New Question</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <div class="col-md-12">
                                    	<label>Question Image<span class="mandatory">*</span></label>
	                                    <div class="slim"
		                                    data-label="Drop Question Image"
		                                    data-size="730,80"
		                                    data-ratio="9:1">
		                                    <input type="file" name="question">
		                                </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                	<div class="col-md-6 pl-0">
                                		<label for="category">Question Category</label>
	                                	<select name="category" id="category" class="form-control">
	                                		<option selected disabled>Select Question Category</option>
											@foreach($categories as $category)
												<option value="{{ $category->id }}">{{ $category->name }}</option>
											@endforeach
	                                	</select>
                                	</div>
                                	<div class="col-md-6">
                                		<label for="level">Question Level</label>
                                		<select name="level" id="level" class="form-control">
                                			<option selected disabled>Select Question Level</option>
                                			<option value="beginner">Beginner</option>
                                			<option value="intermediate">Intermediate</option>
                                			<option value="advanced">Advanced</option>
                                		</select>
                                	</div>
                                </div>
                                <div class="input_fields_wrap">
                                	<div class="form-group">
	                                	<label for="choices" style="display: block;">Question Choices
                                			<span class="add_field_button badge badge-success pull-right">
                                				<i class="fa fa-plus"></i> Add Input
                                			</span>
	                                	</label>
	                                	<input type="text" name="choices[]" class="form-control" placeholder="Question Choice 1">
	                                </div>
                                </div>

                                <div class="form-group">
                                	<label for="answer">Correct Answer</label>
                                	<input type="text" name="answer" id="answer" class="form-control" placeholder="Question Correct Answer">
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
	<script src="{{ asset('public/plugins/expandable-table/js/bootstrap-table-expandable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('public/plugins/slim/slim.kickstart.min.js') }}"></script>

    <script>
        $(document).ready(function(){
            $('.exam-table').DataTable();

            var max_fields      = 10; //maximum input boxes allowed
		    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
		    var add_button      = $(".add_field_button"); //Add button ID
		    
		    var x = 1; //initlal text box count
		    $(add_button).click(function(e){ //on add input button click
		        e.preventDefault();
		        if(x < max_fields){ //max input box allowed
		            x++; //text box increment
		            $(wrapper).append('<div class="form-group remove_input"><input type="text" class="form-control" placeholder="Question Choice '+x+'" name="choices[]"/><a href="#" class="remove_field text-danger"><i class="fa fa-trash fa-lg"></i></a></div>'); //add input box
		        }
		    });
		    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		        e.preventDefault(); $(this).parent('div').remove(); x--;
		    });
        });

        $("form#add-category").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'addNewCategory',
                data: new FormData(this),
                processData: false,
                contentType: false,
                type: "POST",
                success: function(response) {
                    window.location.reload();
                },
                error: function(response) {
                    var errors = response.responseJSON;
                    $.each(errors, function(name, error) {
                        $("form#add-category input[name='"+name+"']").parents('.form-group').addClass('has-error').append("<p class='text-danger'>"+error+"</p>");
                    });
                },
                beforeSend: function() {
                }
            });
        });

        $(".edit-category").on("click", function() {
            var id = $(this).data('edit');
            $.ajax({
                url: 'editCategory',
                data: {id: id},
                type: "GET",
                success: function(response) {
                    $("form#edit-category-form input[name='id']").val(response.id);
                    $("form#edit-category-form input[name='name']").val(response.name);
                    $("#edit-category-modal").modal('show');
                },
                error: function(response) {

                },
                beforeSend: function() {
                }
            });
        });

        $("form#edit-category-form").on('submit', function(event) {
            event.preventDefault();
            
            $.ajax({
                url: 'updateCategory',
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    window.location.reload();
                },
                error: function(response) {
                    
                },
                beforeSend: function() {
                }
            });
        });

        $(".delete-category").on("click", function() {
            var id = $(this).data('delete');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Category!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    url: 'deleteCategory',
                    data: {id: id, _token: '{{ csrf_token() }}', _method: 'DELETE'},
                    type: "DELETE",
                    success: function(response) {
                        swal("Deleted!", "Category has been deleted.", "success");
                        window.location.reload();
                    },
                    error: function(response) {
                        
                    },
                    beforeSend: function() {
                    }
                });    
            });
        });

        $("form#add-exam").on('submit', function(event){
        	event.preventDefault();

        	$.ajax({
        		url: '{{ URL("examiner/addExam") }}',
        		data: new FormData(this),
        		processData: false,
        		contentType: false,
        		type: 'POST',
        		success: function(response) {
                    window.location.reload();
        		},
        		error: function(response) {

        		},
        		beforeSend: function () {

        		}
        	});
        });

        $(".delete-exam").on("click", function() {
            var id = $(this).data('delete');
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this Exam!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    url: 'deleteExam',
                    data: {id: id, _token: '{{ csrf_token() }}', _method: 'DELETE'},
                    type: "DELETE",
                    success: function(response) {
                        swal("Deleted!", "Exam has been deleted.", "success");
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