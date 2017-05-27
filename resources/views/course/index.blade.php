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
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-course-modal"> Add New Course</button>
        </div>
        <div class="col-md-12 mt-20">
            <table id="courses-table" class="table table-striped">
                <thead>
                <tr role="row">
                    <th>Name</th>
                    <th>Description</th>
                    <th>Link</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr role="row">
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->description }}</td>
                        <td>{{ $course->link }}</td>
                        <td><img src="{{  asset('public/img/courses') }}/{{ $course->image }}" alt="{{ $course->name }}" class="img-responsive img-center" /></td>
                        <td>{{ $course->category['name'] }}</td>
                        <td>
                            <i class="btn btn-info glyphicon glyphicon-edit edit-course" href="javascript:;" data-edit="{{ $course->id }}"></i>
                            <i class="btn btn-danger glyphicon glyphicon-trash delete-course" href="javascript:;" data-delete="{{ $course->id }}"></i>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade mt-50" id="add-course-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" id="add-course">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Add New Course</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <input type="hidden" name="type" value="course">
                                    <label>Course Name <span class="mandatory">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="course name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Course Description <span class="mandatory">*</span></label>
                                    <input type="text" name="description" placeholder="course description" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group clearfix">
                                <div class="col-md-12 prl-20">
                                    <div class="slim"
                                         data-label="Drop Your Course Image"
                                         data-size="150,150"
                                         data-ratio="1:1">
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Course link <span class="mandatory">*</span></label>
                                    <input type="text" name="link" placeholder="course link" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Course Category</label>
                                    <select type="text" name="category" class="form-control" placeholder="course category">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
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


    <div class="modal fade" id="edit-course-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="margin-top: 50px;">
                <form method="POST" id="edit-course-form">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Edit course</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Course Name <span class="mandatory">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="course name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Course Description <span class="mandatory">*</span></label>
                                    <input type="text" name="description" class="form-control" placeholder="course description">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Course Link</label>
                                    <input type="text" name="link" class="form-control" placeholder="course link">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group clearfix">
                            <div class="col-md-12 prl-20">
                                <div class="slim"
                                     data-label="Drop Your Course Image"
                                     data-size="240,240"
                                     data-ratio="1:1">
                                    <img src="" id="edit-course-image">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Course Category</label>
                                    <select type="text" name="category" class="form-control" placeholder="course category">
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
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
            $('#courses-table').DataTable();
        });

        $("form#add-course").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'addNewCourse',
                data: $(this).serialize(),
                type: "POST",
                success: function(response) {
                    window.location.reload();
                },
                error: function(response) {
                    var errors = response.responseJSON;
                    $.each(errors, function(name, error) {
                        $("form#add-course input[name='"+name+"']").parents('.form-group').addClass('has-error').append("<p class='text-danger'>"+error+"</p>");
                        $("form#add-course input[name='"+description+"']").parents('.form-group').addClass('has-error').append("<p class='text-danger'>"+error+"</p>");
                        $("form#add-course input[name='"+link+"']").parents('.form-group').addClass('has-error').append("<p class='text-danger'>"+error+"</p>");
                        $("form#add-course input[name='"+image+"']").parents('.form-group').addClass('has-error').append("<p class='text-danger'>"+error+"</p>");
                    });
                },
                beforeSend: function() {
                }
            });
        });

        $(".edit-course").on("click", function() {
            var id = $(this).data('edit');
            $.ajax({
                url: 'editCourse',
                data: {id: id},
                type: "GET",
                success: function(response) {
                    $("form#edit-course-form input[name='id']").val(response.id);
                    $("form#edit-course-form input[name='name']").val(response.name);
                    $("form#edit-course-form input[name='description']").val(response.description);
                    $("form#edit-course-form input[name='link']").val(response.link);
                    $("#edit-course-image").attr('src', "{{ asset('public/img/courses') }}/"+response.image);
                    $("#edit-course-modal").modal('show');
                },
                error: function(response) {

                },
                beforeSend: function() {
                }
            });
        });

        $("form#edit-course-form").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'updateCourse',
                data: new FormData(this),
                processData: false,
                contentType: false,
                type: "POST",
                success: function(response) {
                    window.location.reload();
                },
                error: function(response) {

                },
                beforeSend: function() {
                }
            });
        });

        $(".delete-course").on("click", function() {
            var id = $(this).data('delete');
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this course!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                        url: 'deleteCourse',
                        data: {id: id, _token: '{{ csrf_token() }}', _method: 'DELETE'},
                        type: "DELETE",
                        success: function(response) {
                            swal("Deleted!", "Course has been deleted.", "success");
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