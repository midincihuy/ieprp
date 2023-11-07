@extends('layouts.backend')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        <div class="col-md-6 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><strong>Ticket</strong> Report</h5>
                </div>
                <div class="card-body h-100">
                    <form method="POST" action="">
                        {{ csrf_field() }}
                    <div class="mb-3">
                        <label class="form-label">Start Periode</label>
                        <input class="form-control form-control-lg" type="date" name="start_periode" placeholder="Start Periode" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">End Periode</label>
                        <input class="form-control form-control-lg" type="date" name="start_periode" placeholder="End Periode" />
                    </div>
                    <input type="submit" name="submit" value="Export">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop