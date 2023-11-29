@extends('layouts.backend')

@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Configuration Page</h1>

    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-6">
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
                                        <input type="text" class="form-control" name="end" value="{{ $data['end_keyword'] }}" id="end">
                                        <input type="button" name="edit_end" id="edit_end" value="Edit End Keyword" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Rate Keyword</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="activity"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="rate" value="{{ $data['rate_keyword'] }}" id="rate">
                                        <input type="button" name="edit_rate" id="edit_rate" value="Edit Rate Keyword" class="btn btn-primary">
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
                    <div class="col-sm-4">
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
                                        <input type="text" class="form-control" name="item_pic" value="{{ $data['list_pic']->first()->item }}" id="item_pic">
                                        <input type="button" name="edit_pic" value="Edit PIC Keyword" class="btn btn-primary">
                                    </div>
                                </div>
                                @foreach($data['list_pic'] as $value)
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="value_pic[]" value="{{ $value->value }}" >
                                    </div>
                                </div>
                                @endforeach
                                <input type="text" class="form-control" name="new_value_pic" value="" placeholder="Add New PIC" >
                                <input type="button" name="edit_pic_value" value="Edit PIC Value" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
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
                                        <input type="text" class="form-control" name="item_category" value="{{ $data['list_category']->first()->item }}" id="item_category">
                                        <input type="button" name="edit_category" value="Edit Category Title" class="btn btn-primary">
                                    </div>
                                </div>
                                @foreach($data['list_category'] as $value)
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="value_category[]" value="{{ $value->value }}" >
                                    </div>
                                </div>
                                @endforeach
                                <input type="text" class="form-control" name="new_value_category" value="" placeholder="Add New Category" >
                                <input type="button" name="edit_category_value" value="Edit Category Value" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
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
                                        <input type="text" class="form-control" name="item_rating" value="{{ $data['list_rating']->first()->item }}" id="item_rating">
                                        <input type="button" name="edit_rating" value="Edit Rating Title" class="btn btn-primary">
                                    </div>
                                </div>
                                @foreach($data['list_rating'] as $value)
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="value_rating[]" value="{{ $value->value }}" >
                                    </div>
                                </div>
                                @endforeach
                                <input type="text" class="form-control" name="new_value_rating" value="" placeholder="Add New Rating" >
                                <input type="button" name="edit_rating_value" value="Edit Rating Value" class="btn btn-primary">
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

@endpush