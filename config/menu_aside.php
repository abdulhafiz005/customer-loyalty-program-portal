<?php
// Aside menu
return [
    'items' => [
        [
            'title'     => 'Dashboard',
            'root'      => true,
            'icon'      => 'media/svg/icons/Layout/Layout-4-blocks.svg',
            'page'      => '/dashboard',
            'new-tab'   => false
        ],
        [
            'title'     => 'New Purchase',
            'root'      => true,
            'icon'      => 'media/svg/icons/Layout/Layout-arrange.svg',
            'page'      => '/purchase',
            'new-tab'   => false
        ],
        [
            'title'     => 'Interceptions',
            'root'      => true,
            'icon'      => 'media/svg/icons/General/Settings-1.svg',
            'page'      => '/interception',
            'new-tab'   => false
        ],
        [
            'title'     => 'User Management',
            'root'      => true,
            'icon'      => 'media/svg/icons/Shopping/Box2.svg',
            'new-tab'   => false,
            'submenu' => [
                [
                    'title' => 'List',
                    'page' => '/user-management-list'
                ],
                [
                    'title' => 'Add New',
                    'page' => '/user-management-add'
                ],
                [
                    'title' => 'Update Permission',
                    'page' => '/user-management-permission'
                ]
            ],

        ],
        [
            'title'     => 'Loyalty Program',
            'root'      => true,
            'icon'      => 'media/svg/icons/Files/Folder.svg',
            'page'      => 'loyalty-program-user-awarded',
            'new-tab'   => false
        ],
        [
            'title'     => 'Mechanics',
            'root'      => true,
            'icon'      => 'media/svg/icons/Shopping/Box2.svg',
            'new-tab'   => false,
            'submenu' => [
                [
                    'title' => 'Add Mechanic',
                    'page' => '/mechanic-add'
                ],
                [
                    'title' => 'Mechanics List',
                    'page' => '/mechanic-list'
                ]
            ],

        ],
        [
            'title' => 'History',
            'page' => '/mechanic-history-list',
            'root'      => true,
            'icon'      => 'media/svg/icons/Shopping/Box2.svg',
            'new-tab'   => false,
        ],
        [
            'title'     => 'Logout',
            'root'      => true,
            'icon'      => 'media/svg/icons/Files/Folder.svg',
            'page'      => 'auth/logout',
            'new-tab'   => false,
        ],
    ]
];

