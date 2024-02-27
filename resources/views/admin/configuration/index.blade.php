@extends('layouts.backend')

@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Configuration Page</h1>

    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">End Keyword</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="check-circle"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="end_keyword_id" value="{{ $data['end_keyword_id'] }}">
                                        <input type="text" class="form-control" name="end_keyword" value="{{ $data['end_keyword'] }}" id="end_keyword">
                                        <input type="button" name="edit_end" id="edit_end" value="Edit End Keyword" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">PIC List</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="user"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="pic_keyword_id" value="{{ $data['pic_keyword_id'] }}">
                                        <input type="text" class="form-control" name="pic_keyword" value="{{ $data['pic_keyword'] }}" id="pic_keyword">
                                        <input type="button" name="edit_pic" id="edit_pic" value="Edit PIC Keyword" class="btn btn-primary">
                                    </div>
                                </div>
                                <form action="" id="edit_pic_value_form">
                                    @foreach($data['list_pic'] as $value)
                                    
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="value_pic_{{ $value->id }}" value="{{ $value->value }}" >
                                        </div>
                                    </div>
                                    @endforeach
                                    <input type="text" class="form-control" name="value_pic_new" value="" placeholder="Add New PIC" >
                                    <input type="button" name="edit_pic_value" id="edit_pic_value" value="Edit PIC Value" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">CATEGORY List</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="folder"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="category_keyword_id" value="{{ $data['category_keyword_id'] }}">
                                        {{-- <input type="text" class="form-control" name="category_keyword" value="{{ $data['category_keyword'] }}" id="category_keyword"> --}}
                                        <textarea name="category_keyword" id="category_keyword" class="form-control">{{ $data['category_keyword'] }}</textarea>
                                        <input type="button" name="edit_category" id="edit_category" value="Edit Category Keyword" class="btn btn-primary">
                                    </div>
                                </div>
                                <form action="" id="edit_category_value_form">
                                @foreach($data['list_category'] as $value)
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="value_CATEGORY_{{ $value->id }}" value="{{ $value->value }}" >
                                    </div>
                                </div>
                                @endforeach
                                <input type="text" class="form-control" name="value_CATEGORY_new" value="" placeholder="Add New Category" >
                                <input type="button" name="edit_category_value" id="edit_category_value" value="Edit Category Value" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">RATING List</h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="activity"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="rating_keyword_id" value="{{ $data['rating_keyword_id'] }}">

                                        {{-- <input type="text" class="form-control" name="rating_keyword" value="{{ $data['rating_keyword'] }}" id="rating_keyword"> --}}
                                        <textarea name="rating_keyword" id="rating_keyword" class="form-control">{{ $data['rating_keyword'] }}</textarea>
                                        <input type="button" name="edit_rating" id="edit_rating" value="Edit Rating Keyword" class="btn btn-primary">
                                    </div>
                                </div>
                                <form action="" id="edit_rating_value_form">
                                @foreach($data['list_rating'] as $value)
                                <div class="row">
                                    <div class="col">

                                        <input type="text" class="form-control" name="value_RATING_{{ $value->id }}" value="{{ $value->value }}" >
                                    </div>
                                </div>
                                @endforeach
                                <input type="text" class="form-control" name="value_RATING_new" value="" placeholder="Add New Rating" >
                                <input type="button" name="edit_rating_value" id="edit_rating_value" value="Edit Rating Value" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script type="text/javascript">

$(document).ready(function(){
    $("#edit_end").on("click", function(){
        var value = $("input[name='end_keyword']").val();
        var id = $("input[name='end_keyword_id']").val();
        $.ajax({
                'url' : '/api/saveConfig',
                'type' : 'POST',
                'dataType' : 'json',
                'data' : {
                    "value" : value,
                    "id" : id
                },
                'success' : function(res){
                    alert(res.msg);
                }
            });
    });
    $("#edit_pic").on("click", function(){
        var value = $("input[name='pic_keyword']").val();
        var id = $("input[name='pic_keyword_id']").val();
        $.ajax({
                'url' : '/api/saveConfig',
                'type' : 'POST',
                'dataType' : 'json',
                'data' : {
                    "value" : value,
                    "id" : id
                },
                'success' : function(res){
                    alert(res.msg);
                }
            });
    });
    $("#edit_category").on("click", function(){
        var value = $("textarea[name='category_keyword']").val();
        var id = $("input[name='category_keyword_id']").val();
        $.ajax({
                'url' : '/api/saveConfig',
                'type' : 'POST',
                'dataType' : 'json',
                'data' : {
                    "value" : value,
                    "id" : id
                },
                'success' : function(res){
                    alert(res.msg);
                }
            });
    });
    $("#edit_rating").on("click", function(){
        var value = $("textarea[name='rating_keyword']").val();
        var id = $("input[name='rating_keyword_id']").val();
        $.ajax({
                'url' : '/api/saveConfig',
                'type' : 'POST',
                'dataType' : 'json',
                'data' : {
                    "value" : value,
                    "id" : id
                },
                'success' : function(res){
                    alert(res.msg);
                }
            });
    });


    $("#edit_pic_value").click(function(){
        event.preventDefault();
        var $form = $("#edit_pic_value_form");
        // console.log($form.text());
        var $inputs = $form.find("input, select, button, textarea, checkbox");
        var serializedData = $form.serialize();
        console.log(serializedData);
        $.ajax({
                'url' : '/api/saveConfigValue',
                'type' : 'POST',
                'dataType' : 'json',
                'data' : {
                    serializedData
                },
                'success' : function(res){
                    alert(res.msg);
                }
            });
    });
    
    $("#edit_category_value").click(function(){
        event.preventDefault();
        var $form = $("#edit_category_value_form");
        // console.log($form.text());
        var $inputs = $form.find("input, select, button, textarea, checkbox");
        var serializedData = $form.serialize();
        console.log(serializedData);
        $.ajax({
                'url' : '/api/saveConfigValue',
                'type' : 'POST',
                'dataType' : 'json',
                'data' : {
                    serializedData
                },
                'success' : function(res){
                    alert(res.msg);
                }
            });
    });
    
    $("#edit_rating_value").click(function(){
        event.preventDefault();
        var $form = $("#edit_rating_value_form");
        // console.log($form.text());
        var $inputs = $form.find("input, select, button, textarea, checkbox");
        var serializedData = $form.serialize();
        console.log(serializedData);
        $.ajax({
                'url' : '/api/saveConfigValue',
                'type' : 'POST',
                'dataType' : 'json',
                'data' : {
                    serializedData
                },
                'success' : function(res){
                    alert(res.msg);
                }
            });
    });
});
</script>
@endpush