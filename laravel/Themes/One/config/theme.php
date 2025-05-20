<?php
<<<<<<< HEAD
declare(strict_types=1);
return [
    /*
    |--------------------------------------------------------------------------
    | Informazioni di Base
    |--------------------------------------------------------------------------
    */
    'name' => 'One',
    'description' => 'Tema moderno e responsive per Laravel',
    'version' => '1.0.0',
    'author' => 'Theme Developer Team',

    /*
    |--------------------------------------------------------------------------
    | Colori
    |--------------------------------------------------------------------------
    */
    'colors' => [
        'primary' => [
            'rgb' => '59, 130, 246',
            'hex' => '#3B82F6'
        ],
        'secondary' => [
            'rgb' => '107, 114, 128',
            'hex' => '#6B7280'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Font
    |--------------------------------------------------------------------------
    */
    'fonts' => [
        'main' => 'Inter',
        'secondary' => 'Roboto'
    ],

    /*
    |--------------------------------------------------------------------------
    | Breakpoints
    |--------------------------------------------------------------------------
    */
    'breakpoints' => [
        'sm' => '640px',
        'md' => '768px',
        'lg' => '1024px',
        'xl' => '1280px',
        '2xl' => '1536px',
    ],

    /*
    |--------------------------------------------------------------------------
    | Componenti
    |--------------------------------------------------------------------------
    */
    'components' => [
        'header' => [
            'sticky' => true,
            'transparent' => false,
            'height' => '64px'
        ],
        'footer' => [
            'columns' => 4,
            'background' => '#f3f4f6'
        ],
        'sidebar' => [
            'width' => '256px',
            'collapsible' => true
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    */
    'layout' => [
        'container' => [
            'max-width' => '1280px',
            'padding' => '1rem'
        ],
        'spacing' => [
            'section' => '4rem',
            'component' => '2rem'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Animazioni
    |--------------------------------------------------------------------------
    */
    'animations' => [
        'duration' => [
            'fast' => '150ms',
            'normal' => '300ms',
            'slow' => '500ms'
        ],
        'timing' => [
            'default' => 'cubic-bezier(0.4, 0, 0.2, 1)',
            'in' => 'cubic-bezier(0.4, 0, 1, 1)',
            'out' => 'cubic-bezier(0, 0, 0.2, 1)',
            'in-out' => 'cubic-bezier(0.4, 0, 0.2, 1)'
        ]
    ],
=======

return [
    /*
    |--------------------------------------------------------------------------
    | Configurazione del Tema One
    |--------------------------------------------------------------------------
    |
    | Questo file contiene la configurazione del tema One.
    |
    */

    'name' => 'One',
    'description' => 'Tema predefinito per SaluteOra',
    'version' => '1.0.0',
>>>>>>> 1b374b6 (.)

    /*
    |--------------------------------------------------------------------------
    | Percorsi
    |--------------------------------------------------------------------------
    |
    | Questi percorsi sono utilizzati per caricare le viste e gli assets del tema.
    |
    */

    'paths' => [
        'views' => 'resources/views',
        'assets' => 'assets',
<<<<<<< HEAD
        'content' => 'content/pages',
=======
>>>>>>> 1b374b6 (.)
    ],

    /*
    |--------------------------------------------------------------------------
    | Blocchi
    |--------------------------------------------------------------------------
    |
<<<<<<< HEAD
    | Blocchi di contenuto disponibili nel tema.
=======
    | Questi blocchi sono disponibili nel tema.
>>>>>>> 1b374b6 (.)
    |
    */

    'blocks' => [
        'hero',
        'feature_sections',
        'team',
        'stats',
        'cta',
<<<<<<< HEAD
        'testimonials',
        'pricing',
        'faq',
        'contact',
        'newsletter'
=======
>>>>>>> 1b374b6 (.)
    ],

    /*
    |--------------------------------------------------------------------------
<<<<<<< HEAD
    | Integrazione CMS
    |--------------------------------------------------------------------------
    |
    | Configurazione per l'integrazione con sistemi CMS.
=======
    | Integrazione con il Modulo CMS
    |--------------------------------------------------------------------------
    |
    | Questa sezione contiene la configurazione per l'integrazione con il modulo CMS.
>>>>>>> 1b374b6 (.)
    |
    */

    'cms' => [
<<<<<<< HEAD
        'enabled' => true,
        'content_path' => 'content/pages',
        'cache' => [
            'enabled' => true,
            'duration' => 3600
        ]
=======
        'content_path' => 'laravel/config/local/saluteora/database/content/pages',
>>>>>>> 1b374b6 (.)
    ],

    /*
    |--------------------------------------------------------------------------
    | Integrazione con Laravel Folio
    |--------------------------------------------------------------------------
    |
<<<<<<< HEAD
    | Configurazione per l'integrazione con Laravel Folio.
=======
    | Questa sezione contiene la configurazione per l'integrazione con Laravel Folio.
>>>>>>> 1b374b6 (.)
    |
    */

    'folio' => [
<<<<<<< HEAD
        'enabled' => true,
=======
>>>>>>> 1b374b6 (.)
        'pages_path' => 'resources/views/pages',
    ],
];
