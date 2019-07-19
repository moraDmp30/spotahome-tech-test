<?php

return [
    'source' => 'https://feeds.spotahome.com/mitula-UK-en.xml',
    'default-sort-field' => 'id',
    'default-sort-direction' => 'asc',
    'fields' => [
        [
            'id' => 'id',
            'text' => 'ID',
            'sortable' => true,
        ],
        [
            'id' => 'title',
            'text' => 'Title',
            'sortable' => true,
        ],
        [
            'id' => 'link',
            'text' => 'Link',
            'sortable' => true,
            'is-link' => true,
        ],
        [
            'id' => 'city',
            'text' => 'City',
            'sortable' => true,
        ],
        // [
        //     'id' => 'image',
        //     'text' => 'Image',
        //     'sortable' => false,
        // ],
    ],
    'directions' => [
        'asc' => 'asc',
        'desc' => 'desc',
    ],
];
