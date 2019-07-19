<?php

return [
    'source' => 'https://feeds.spotahome.com/mitula-UK-en.xml',
    'default-sort-field' => 'id',
    'default-sort-direction' => 'asc',
    'fields' => [
        'id' => [
            'id' => 'id',
            'text' => 'ID',
            'sortable' => true,
        ],
        'title' => [
            'id' => 'title',
            'text' => 'Title',
            'sortable' => true,
        ],
        'link' => [
            'id' => 'link',
            'text' => 'Link',
            'sortable' => true,
            'is-link' => true,
        ],
        'city' => [
            'id' => 'city',
            'text' => 'City',
            'sortable' => true,
        ],
        'image' => [
            'id' => 'image',
            'text' => 'Image',
            'sortable' => false,
            'is-image' => true,
            'src-field' => 'src',
            'alt-field' => 'alt',
        ],
    ],
    'directions' => [
        'asc' => 'asc',
        'desc' => 'desc',
    ],
];
