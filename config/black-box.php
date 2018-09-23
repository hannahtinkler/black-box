<?php

return [
    'auth' => [
        'domain_restriction' => env('DOMAIN_RESTRICTION'),
        'team_restriction' => explode(',', env('TEAM_RESTRICTION')),
    ],
];
