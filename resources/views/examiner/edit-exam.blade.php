@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{ asset('public/plugins/slim/slim.min.css') }}">
    <style>
        .height-80 {
            height: 80px;
        }
        .mt-20 {
            margin-top: 20px;
        }
        .mt-50 {
            margin-top: 50px;
        }
        .prl-0 {
            padding-right: 0;
            padding-left: 0;
        }
        .pl-0 {
            padding-left: 0;
        }
        .pr-0 {
            padding-right: 0;
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
	<div class="col-md-12">
        <form method="POST" id="edit-exam-form">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="modal-header">
                <h4 class="modal-title text-center">Edit Exam</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 prl-20">
                        <div class="form-group clearfix">
                            <div class="col-md-12 prl-0">
                                <input type="hidden" name="id" value="{{ $exam->id }}">
                                <label>Question Image<span class="mandatory">*</span></label>
                                <div class="slim height-80"
                                    data-label="Drop Question Image"
                                    data-size="730,80"
                                    data-ratio="9:1">
                                    <img src="{{ asset('public/img/questions') }}/{{ $exam->question }}" alt="{{ $exam->category->name }}">
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
                                        <option value="{{ $category->id }}" @if($category->id == $exam->category_id) {{ 'selected' }} @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 pr-0">
                                <label for="level">Question Level</label>
                                <select name="level" id="level" class="form-control">
                                    <option selected disabled>Select Question Level</option>
                                    <option value="beginner" @if($exam->level == 'beginner') {{ 'selected' }} @endif>Beginner</option>
                                    <option value="intermediate" @if($exam->level == 'intermediate') {{ 'selected' }} @endif>Intermediate</option>
                                    <option value="advanced" @if($exam->level == 'advanced') {{ 'selected' }} @endif>Advanced</option>
                                </select>
                            </div>
                        </div>
                        <div class="input_fields_wrap">
                            <div class="form-group">
                                <?php
                                    $inputs = json_decode($exam->choices);
                                ?>
                                <label for="choices" style="display: block;">Question Choices
                                    <span class="add_field_button badge badge-success pull-right">
                                        <i class="fa fa-plus"></i> Add Input
                                    </span>
                                </label>
                                @foreach($inputs as $key => $value)
                                    <div class="form-group remove_input">
                                        <input type="text" name="choices[]" value="{{ $value }}" class="form-control" placeholder="Question Choice {{ $key+1 }}">
                                        <a href="#" class="remove_field text-danger"><i class="fa fa-trash fa-lg"></i></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="answer">Correct Answer</label>
                            <input type="text" value="{{ $exam->answer }}" name="answer" id="answer" class="form-control" placeholder="Question Correct Answer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ URL('examiner/exams') }}" class="btn btn-default"><i class="fa fa-arrow-back"></i> Back</a>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>   
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('public/plugins/slim/slim.kickstart.min.js') }}"></script>
    <script>
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

        $("form#edit-exam-form").on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: '{{ URL('examiner/edit-exam') }}',
                data: new FormData(this),
                type: 'POST',
                processData: false,
                contentType: false,
                success: function(response) {
                    window.location = '{{ URL('examiner/exams') }}';
                },
                error: function(response) {

                },
                beforeSend: function() {

                }
            });
        });
    </script>
@endsection