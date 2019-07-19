@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Properties</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('download-properties') }}" id="properties-form">
                                <input type="hidden" value="{{ $defaultField }}" name="sort_field" />
                                <input type="hidden" value="{{ $defaultDirection }}" name="sort_direction" />
                                <input type="hidden" value="{{ $defaultPage }}" name="page" />
                                <button type="button" id="download-properties" class="btn btn-primary float-right">Download as JSON</button>
                            </form>
                        </div>
                    </div>
                    <div id="properties-container" data-url="{{ route('get-properties') }}">
                        <div class="alert alert-info">
                            Fetching data...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
