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
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#add-category-modal"> Add New Category</button>
        </div>
        <div class="col-md-12 mt-20">
            <table id="categories-table" class="table table-striped">
                <thead>
                <tr role="row">
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr role="row">
                        <td>{{ $category->name }}</td>
                        <td>
                            <i class="btn btn-info glyphicon glyphicon-edit edit-category" href="javascript:;" data-edit="{{ $category->id }}"></i>
                            <i class="btn btn-danger glyphicon glyphicon-trash delete-category" href="javascript:;" data-delete="{{ $category->id }}"></i>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade mt-50" id="add-category-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                    <input type="hidden" name="type" value="category">
                                    <label>Category Name <span class="mandatory">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="category name">
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="edit-category-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="margin-top: 70px;">
                <form method="POST" id="edit-category-form">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title text-center">Edit category</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12 prl-20">
                                <div class="form-group">
                                    <label>Category Name <span class="mandatory">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder="category name">
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
            $('#categories-table').DataTable();
        });

        $("form#add-category").on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'addNewCategory',
                data: $(this).serialize(),
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

        $(".delete-category").on("click", function() {
            var id = $(this).data('delete');
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this category!",
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
    </script>
@endsection