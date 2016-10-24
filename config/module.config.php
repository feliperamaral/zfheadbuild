<?php

namespace HeadBuild\View\Helper;

return [
    'headbuild' => [
        'public_path' => getcwd() . '/public',
        'manifest_file' => 'build/rev-manifest.json'
    ],
    'view_helpers' => [
        'aliases' => [
            'headLink' => HeadLink::class,
            'headScript' => HeadScript::class,
        ],
        'factories' => [
            HeadLink::class => Service\HeadFactory::class,
            HeadScript::class => Service\HeadFactory::class,
        ]
    ]
];
