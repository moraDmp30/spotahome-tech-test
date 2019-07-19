<div class="table-responsive">
    <table id="properties-table" class="table table-bordered table-striped" >
        <thead>
            <tr>
                @foreach (config('spotahome.fields') as $field)
                    @if (Arr::get($field, 'sortable', false))
                        <th class="sortable-link" data-field="{{ Arr::get($field, 'id', '') }}">{{ Arr::get($field, 'text', '') }}</th>
                    @else
                        <th>{{ Arr::get($field, 'text', '') }}
                    @endif  
                @endforeach
            </tr>
        </thead>
        <tbody>
            @if (empty(Arr::get($properties, 'items', [])))
                <tr>
                    <td colspan="{{ count(config('spotahome.fields')) }}">There are no properties for the given criteria.</td>
                </tr>
            @else
                @foreach (Arr::get($properties, 'items', []) as $property)
                    <tr>
                        @foreach (config('spotahome.fields') as $field)
                            @if (Arr::get($field, 'is-link', false))
                                <td>{!! empty(Arr::get($property, 'link', '')) ? '' : '<a target="_blank" href="'.Arr::get($property, 'link', '').'">'.Arr::get($property, 'link', '').'</a>' !!}</td>
                            @elseif (Arr::get($field, 'is-image', false))
                                <td>
                                    @if (empty(Arr::get($property, Arr::get($field, 'id', ''), [])))
                                        <img src="{{ asset('/i/spotahome.jpg') }}" alt="{{ Arr::get($property, config('spotahome.fields.title.id'), '') }}" />
                                    @else
                                        <img src="{{ Arr::get($property, Arr::get($field, 'id', '').'.'.Arr::get($field, 'src-field', ''), '') }}" alt="{{ Arr::get($property, Arr::get($field, 'id', '').'.'.Arr::get($field, 'alt-field', ''), '') }}" />
                                    @endif
                                </td>
                            @else    
                                <td>{{ Arr::get($property, Arr::get($field, 'id', ''), '') }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<nav aria-label="pagination">
    <ul class="pagination">
        @for ($i = 1; $i <= ceil(Arr::get($properties, 'total', 0)/config('spotahome.page-size')); $i++)
            <li class="page-item {{ $i == Arr::get($properties, 'page', 1) ? 'active' : '' }}">
                <a class="page-link" href="javascript:;" data-page="{{ $i }}">{{ $i }}</a>
            </li>
        @endfor
    </ul>
</nav>