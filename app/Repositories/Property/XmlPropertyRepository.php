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
            // Let's take first picture as main image
            $image = [];
            $pictures = $propertyXml->pictures;
            if (!empty($pictures)) {
                $picture = $pictures->children()[0];
                if (!is_null($picture) && !empty($picture->picture_url->__toString()) && !empty($picture->picture_title->__toString())) {
                    $image = [
                        'src' => $picture->picture_url->__toString(),
                        'alt' => $picture->picture_title->__toString(),
                    ];
                }
            }
            $properties[] = [
                'id' => $propertyXml->id->__toString(),
                'title' => $propertyXml->title->__toString(),
                'link' => $propertyXml->url->__toString(),
                'city' => $propertyXml->city->__toString(),
                'image' => $image,
            ];
        }

        $propertyCollection = collect($properties);
        if ($sortDirection == 'desc') {
            return array_values($propertyCollection->sortByDesc($sortField, SORT_NATURAL | SORT_FLAG_CASE)->toArray());
        }

        return array_values($propertyCollection->sortBy($sortField, SORT_NATURAL | SORT_FLAG_CASE)->toArray());
    }
}
