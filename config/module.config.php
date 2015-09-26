<?php

return [
    'headbuild' => [
        //'public_path' => getcwd() . '/public',
        //'manifest_file' => 'build\rev-manifest.json'
    ],
    'view_helpers' => [
        'invokables' => [
            'headlink' => 'HeadBuild\View\Helper\HeadLink',
            'headscript' => 'HeadBuild\View\Helper\HeadScript',
        ]
    ]
];
