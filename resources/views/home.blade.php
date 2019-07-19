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
                                <button type="submit" class="btn btn-primary float-right">Download as JSON</button>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="properties-table" class="table table-bordered table-striped" data-url="{{ route('get-properties') }}">
                            <thead>
                                <tr>
                                    @foreach (config('spotahome.fields') as $field)
                                        @if (Arr::get($field, 'sortable', false))
                                            <th class="sortable-link {{ $defaultField == Arr::get($field, 'id', '') ? ($defaultDirection == config('spotahome.directions.asc') ? 'sortable-link-asc' : 'sortable-link-desc') : '' }}" data-field="{{ Arr::get($field, 'id', '') }}">{{ Arr::get($field, 'text', '') }}</th>
                                        @else
                                            <th>{{ Arr::get($field, 'text', '') }}
                                        @endif  
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="{{ count(config('spotahome.fields')) }}">Fetching data...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
