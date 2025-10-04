<?php

return [
    'graphA' => [
        // class of your domain object
        'class' => App\Models\OrdersTable::class,

        // name of the graph (default is "default")
        'graph' => 'graphA',

        // property of your object holding the actual state (default is "state")
        'property_path' => 'status',

        'metadata' => [
            'title' => 'Graph A',
        ],

        // list of all possible states
        'states' => [
           'pending',
           'paid',
           'shipped',
            'delivered',
           'cancelled'
        ],

        // list of all possible transitions
        'transitions' => [
            'pay' => [
                'from' => ['pending'],
                'to' => 'paid',
            ],
            'cancel' => [
                'from' =>  ['pending', 'paid'],
                'to' => 'cancelled',
            ],
            'ship' => [
                'from' => ['paid'],
                'to' => 'shipped',
            ],
            'deliver' => [
                'from' => ['shipped'],
                'to' =>  'delivered',
            ]
        ],

        // list of all callbacks
        'callbacks' => [
            // will be called when testing a transition
            'guard' => [
                'guard_on_submitting' => [
                    // call the callback on a specific transition
                    'on' => 'submit_changes',
                    // will call the method of this class
                    'do' => ['MyClass', 'handle'],
                    // arguments for the callback
                    'args' => ['object'],
                ],
                'guard_on_approving' => [
                    // call the callback on a specific transition
                    'on' => 'approve',
                    // will check the ability on the gate or the class policy
                    'can' => 'approve',
                ],
            ],

            // will be called before applying a transition
            'before' => [],

            // will be called after applying a transition
            'after' => [],
        ],
    ],
];
