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
                @else     
                    <td>{{ Arr::get($property, Arr::get($field, 'id', ''), '') }}</td>
                @endif
            @endforeach
            
            {{-- <td>{{ \Illuminate\Support\Arr::get($property, 'title', '') }}</td>
            <td>{!! empty(\Illuminate\Support\Arr::get($property, 'link', '')) ? '' : '<a target="_blank" href="'.\Illuminate\Support\Arr::get($property, 'link', '').'">'.\Illuminate\Support\Arr::get($property, 'link', '').'</a>' !!}</td>
            <td>{{ \Illuminate\Support\Arr::get($property, 'city', '') }}</td>
            <td>
                @if (empty(\Illuminate\Support\Arr::get($property, 'image', '')))
                    <img src="{{ asset('/i/spotahome.jpg') }}" alt="{{ \Illuminate\Support\Arr::get($property, 'title', '') }}" />
                @else
                    <img src="{{ \Illuminate\Support\Arr::get($property, 'image', '') }}" alt="{{ \Illuminate\Support\Arr::get($property, 'title', '') }}" />
                @endif
            </td> --}}
        </tr>
    @endforeach
@endif