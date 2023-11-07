@extends('layouts.backend')

@section('content')

<div class="row">
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Default Map</h5>
                <h6 class="card-subtitle text-muted">Displays the default road map view.</h6>
            </div>
            <div class="card-body">
                <div class="content" id="default_map" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Hybrid Map</h5>
                <h6 class="card-subtitle text-muted">Displays a mixture of normal and satellite views.</h6>
            </div>
            <div class="card-body">
                <div class="content" id="hybrid_map" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')

<script>
    function initMaps() {
        var defaultMap = {
            zoom: 10,
            center: {
                lat: -6.3808415,
                lng: 106.8460498
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        new google.maps.Map(document.getElementById("default_map"), defaultMap);
        var hybridMap = {
            zoom: 10,
            center: {
                lat: -6.3808415,
                lng: 106.8460498
            },
            mapTypeId: google.maps.MapTypeId.HYBRID
        };
        new google.maps.Map(document.getElementById("hybrid_map"), hybridMap);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-T5iZxS6RrX98gO-iaus0n2UtdMo-2TQ&callback=initMaps" async defer></script>
@endpush