<?php

namespace Spotahome\Repositories\Property;

use Cache;
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
        $page = Arr::get($params, 'page', 1);

        return Cache::remember('properties-'.$sortField.'-'.$sortDirection.'-'.$page, 60, function () use ($sortField, $sortDirection, $page) {
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
                $propertyCollection = $propertyCollection->sortByDesc($sortField, SORT_NATURAL | SORT_FLAG_CASE);
            } else {
                $propertyCollection = $propertyCollection->sortBy($sortField, SORT_NATURAL | SORT_FLAG_CASE);
            }

            if ($page == -1) {
                return [
                    'items' => array_values($propertyCollection->toArray()),
                    'total' => $propertyCollection->count(),
                    'page' => 1,
                ];
            }

            return [
                'items' => array_values($propertyCollection->slice(($page - 1) * config('spotahome.page-size'))->take(config('spotahome.page-size'))->toArray()),
                'total' => $propertyCollection->count(),
                'page' => $page,
            ];
        });
    }
}
