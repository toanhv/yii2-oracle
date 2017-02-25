<?php

return [
    'adminEmail' => 'admin@example.com',
    'items-menu' => [
        ['label' => 'Admin', 'url' => ['/user/index'], 'icon' => 'icon-list', 'parent' => 0, 'items' => []],
        ['label' => 'Tra cứu MO', 'url' => ['/mo/index'], 'icon' => 'icon-list', 'parent' => 0, 'items' => []],
        ['label' => 'Tra cứu MT', 'url' => ['/mt/index'], 'icon' => 'icon-list', 'parent' => 0, 'items' => []],
        ['label' => 'Cộng/trừ tiền', 'url' => ['/exchange/index'], 'icon' => 'icon-list', 'parent' => 0, 'items' => []],
        ['label' => 'Report', 'url' => [''], 'icon' => 'icon-list', 'parent' => 0, 'items' => [
                ['label' => 'Ngày', 'url' => ['/report/index'], 'icon' => 'icon-list', 'parent' => 0, 'items' => []],
                ['label' => 'Tháng', 'url' => ['/report/monthly'], 'icon' => 'icon-list', 'parent' => 0, 'items' => []],
            ]],
    ],
    'packages' => [
        1 => 'gói Ngày',
        2 => 'gói Tuần',
        3 => 'gói Tháng'
    ],
    'ws-encoder' => [
        'url' => 'http://localhost:9899/MappingEncoderWS?wsdl',
        'username' => 'abc',
        'password' => 'abc',
    ],
    'report-type' => [
        1 => 'Giờ',
        2 => 'Ngày',
        3 => 'Tuần',
        4 => 'Tháng',
        5 => 'Quý',
        6 => 'Năm'
    ],
    'report-connection-type' => [
        0 => 'MySQL',
        1 => 'Oracle',
    ],
    'report-func' => [
        'String' => 'String',
        'Integer' => 'Integer',
        'Double' => 'Double',
        'Date' => 'Date',
        'DateTime' => 'DateTime'
    ],
    'antiSQLInjection' => ['update ', 'insert ', 'drop ', 'create ', 'delete ', 'truncate '],
];
