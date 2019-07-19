<?php

namespace Spotahome\Repositories\Property;

use Illuminate\Support\Arr;

class XmlPropertyRepository implements PropertyRepository
{
    /**
     * {@inheritdoc}
     */
    public function getProperties($params) : array
    {
        $sortField = Arr::get($params, 'sort_field', 'id');
        $sortDirection = Arr::get($params, 'sort_direction', 'asc');
        $xml = simplexml_load_file(config('spotahome.source'));
        $properties = [];

        foreach ($xml as $propertyXml) {
            $properties[] = [
                'id' => $propertyXml->id->__toString(),
                'title' => $propertyXml->title->__toString(),
                'link' => $propertyXml->url->__toString(),
                'city' => $propertyXml->city->__toString(),
                // 'image' => $propertyXml->main_image->__toString(),
            ];
        }

        $propertyCollection = collect($properties);
        if ($sortDirection == 'desc') {
            return array_values($propertyCollection->sortByDesc($sortField, SORT_NATURAL | SORT_FLAG_CASE)->toArray());
        }

        return array_values($propertyCollection->sortBy($sortField, SORT_NATURAL | SORT_FLAG_CASE)->toArray());
    }
}
