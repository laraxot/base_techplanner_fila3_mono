<?php

declare(strict_types=1);

return [
    'fields' => [
        'email' => [
            'label' => 'Email',
            'placeholder' => 'Enter your email',
            'tooltip' => 'Use a valid email address',
            'icon' => 'heroicon-o-mail',
            'description' => 'email',
            'helper_text' => '',
        ],
        'password' => [
            'label' => 'Password',
            'placeholder' => 'Enter your password',
            'tooltip' => 'Password must contain at least 8 characters',
            'icon' => 'heroicon-o-lock-closed',
            'description' => 'password',
            'helper_text' => '',
        ],
        'remember' => [
            'label' => 'Remember me',
            'tooltip' => 'Keep me signed in on this device',
            'description' => 'remember',
            'helper_text' => '',
            'placeholder' => 'remember',
        ],
    ],
    'actions' => [
        'authenticate' => [
            'label' => 'Authenticate',
            'tooltip' => 'Sign in to the system',
            'icon' => 'heroicon-o-login',
            'color' => 'primary',
        ],
        'login' => [
            'label' => 'Sign in',
            'tooltip' => 'Sign in with your credentials',
            'icon' => 'heroicon-o-key',
            'color' => 'success',
        ],
        'request' => [
            'label' => 'request',
        ],
    ],
];
