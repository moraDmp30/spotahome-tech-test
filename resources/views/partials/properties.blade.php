@if (empty($properties))
    <tr>
        <td colspan="{{ count(config('spotahome.fields')) }}">There are no properties for the given criteria.</td>
    </tr>
@else
    @foreach ($properties as $property)
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