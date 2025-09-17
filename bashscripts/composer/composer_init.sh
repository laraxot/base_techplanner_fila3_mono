#!/bin/sh
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
php -r "unlink('composer.lock');"
rm composer.lock
rm package-lock.json
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 4f97354 (.)
=======
=======

>>>>>>> 71ff9e32 (.)
=======
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> ec52a6b4 (.)
#mv composer.json composer_$(date +"%Y-%m-%d").json
#php composer.phar init

=======
<<<<<<< HEAD

=======
>>>>>>> f52d0712 (.)

>>>>>>> develop
>>>>>>> ec52a6b4 (.)
############## PRODUCTION DEPENDENCIES ####################
php -d memory_limit=-1 composer.phar require -W illuminate/contracts

# Core Framework
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
>>>>>>> ec52a6b4 (.)
>>>>>>> e9356a3a (.)
=======
#mv composer.json composer_$(date +"%Y-%m-%d").json
#php composer.phar init

>>>>>>> 42ab2308 (.)
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
#mv composer.json composer_$(date +"%Y-%m-%d").json
#php composer.phar init

>>>>>>> ea169dcc (.)
<<<<<<< HEAD
=======
#mv composer.json composer_$(date +"%Y-%m-%d").json
#php composer.phar init

>>>>>>> e0c964a3 (first)
=======
>>>>>>> 4f97354 (.)
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs filament/filament
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs coolsam/modules
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs nwidart/laravel-modules
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs doctrine/dbal
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs livewire/livewire
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs livewire/volt
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 4f97354 (.)
=======

### SPATIE PACKAGES
=======
<<<<<<< HEAD
>>>>>>> ec52a6b4 (.)
<<<<<<< HEAD
### SPATIE
=======

### SPATIE PACKAGES
>>>>>>> e9356a3a (.)
=======
### SPATIE
>>>>>>> 42ab2308 (.)
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
### SPATIE
>>>>>>> ea169dcc (.)
<<<<<<< HEAD
=======
### SPATIE
>>>>>>> e0c964a3 (first)
=======
>>>>>>> 4f97354 (.)
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs filament/spatie-laravel-tags-plugin
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs filament/spatie-laravel-media-library-plugin
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs filament/spatie-laravel-translatable-plugin
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/laravel-cookie-consent
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/laravel-data
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/laravel-event-sourcing
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/laravel-permission
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/laravel-queueable-action
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/laravel-model-status
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/laravel-model-states
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/laravel-query-builder
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/laravel-activitylog
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/laravel-schemaless-attributes
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/laravel-feed
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/laravel-health
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/security-advisories-health-check
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/cpu-load-health-check
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/crawler
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/url
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/color
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 4f97354 (.)
=======

### USER MODULE
=======
<<<<<<< HEAD
>>>>>>> ec52a6b4 (.)
<<<<<<< HEAD
### USER 
=======

### USER MODULE
>>>>>>> e9356a3a (.)
=======
### USER 
>>>>>>> 42ab2308 (.)
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
### USER 
>>>>>>> ea169dcc (.)
<<<<<<< HEAD
=======
### USER 
>>>>>>> e0c964a3 (first)
=======
>>>>>>> 4f97354 (.)
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs jenssegers/agent
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs laravel/passport
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs socialiteproviders/auth0
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs tightenco/parental
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ea169dcc (.)
=======
>>>>>>> e0c964a3 (first)
=======
=======
>>>>>>> ea169dcc (.)
>>>>>>> 4f97354 (.)
### NOTIFY
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs kreait/firebase-php
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs laravel-notification-channels/telegram
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs laravel/slack-notification-channel
### MEDIA
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs pbmedia/laravel-ffmpeg
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs intervention/image
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/image
### PROFILE 
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs tightenco/parental
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 4f97354 (.)
=======

### NOTIFY MODULE
<<<<<<< HEAD
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs kreait/firebase-php
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs laravel-notification-channels/telegram
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs laravel/slack-notification-channel

### MEDIA MODULE
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs pbmedia/laravel-ffmpeg
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs intervention/image
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/image

### PROFILE MODULE
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs tightenco/parental

### UI COMPONENTS
=======
>>>>>>> 71ff9e32 (.)
=======
<<<<<<< HEAD
<<<<<<< HEAD
### NOTIFY
>>>>>>> develop
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs kreait/firebase-php
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs laravel-notification-channels/telegram
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs laravel/slack-notification-channel

### MEDIA MODULE
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs pbmedia/laravel-ffmpeg
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs intervention/image
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/image

### PROFILE MODULE
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs tightenco/parental
<<<<<<< HEAD

### UI COMPONENTS
=======
>>>>>>> ec52a6b4 (.)
### UI
=======

### NOTIFY MODULE
=======
### NOTIFY
>>>>>>> 42ab2308 (.)
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs kreait/firebase-php
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs laravel-notification-channels/telegram
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs laravel/slack-notification-channel
### MEDIA
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs pbmedia/laravel-ffmpeg
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs intervention/image
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spatie/image
### PROFILE 
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs tightenco/parental
<<<<<<< HEAD

### UI COMPONENTS
>>>>>>> e9356a3a (.)
=======
### UI
>>>>>>> 42ab2308 (.)
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
### UI
>>>>>>> ea169dcc (.)
<<<<<<< HEAD
=======
### UI
>>>>>>> e0c964a3 (first)
=======
>>>>>>> 4f97354 (.)
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs mhmiton/laravel-modules-livewire
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs laravel/breeze
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs owenvoke/blade-fontawesome
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs laravel/folio
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs cknow/laravel-money
php artisan folio:install
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs livewire/volt
php artisan volt:install
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ea169dcc (.)
=======
>>>>>>> e0c964a3 (first)
=======
=======
>>>>>>> ea169dcc (.)
>>>>>>> 4f97354 (.)
#php -d memory_limit=-1 composer.phar require -W guava/filament-icon-picker
## IMPORT/EXPORT
#php -d memory_limit=-1 composer.phar require -W konnco/filament-import
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spipu/html2pdf
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs maatwebsite/excel
####
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 4f97354 (.)
=======
>>>>>>> ec52a6b4 (.)
=======

### IMPORT/EXPORT
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spipu/html2pdf
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs maatwebsite/excel

### UTILITIES
<<<<<<< HEAD
=======
>>>>>>> 71ff9e32 (.)
=======
<<<<<<< HEAD
<<<<<<< HEAD
#php -d memory_limit=-1 composer.phar require -W guava/filament-icon-picker
## IMPORT/EXPORT
#php -d memory_limit=-1 composer.phar require -W konnco/filament-import
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spipu/html2pdf
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs maatwebsite/excel
####
=======
>>>>>>> f52d0712 (.)

### IMPORT/EXPORT
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spipu/html2pdf
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs maatwebsite/excel

### UTILITIES
<<<<<<< HEAD
=======
>>>>>>> ec52a6b4 (.)
>>>>>>> e9356a3a (.)
=======
#php -d memory_limit=-1 composer.phar require -W guava/filament-icon-picker
## IMPORT/EXPORT
#php -d memory_limit=-1 composer.phar require -W konnco/filament-import
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spipu/html2pdf
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs maatwebsite/excel
####
>>>>>>> 42ab2308 (.)
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> ea169dcc (.)
<<<<<<< HEAD
=======
>>>>>>> e0c964a3 (first)
=======
>>>>>>> 4f97354 (.)
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs thecodingmachine/safe
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs symfony/dom-crawler
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs flowframe/laravel-trend
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs staudenmeir/laravel-adjacency-list
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs fidum/laravel-eloquent-morph-to-one
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs calebporzio/sushi
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs predis/predis

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 4f97354 (.)
=======
############################ DEV DEPENDENCIES ###############################
=======
<<<<<<< HEAD
>>>>>>> ec52a6b4 (.)
<<<<<<< HEAD
### DEV
=======
############################ DEV DEPENDENCIES ###############################
>>>>>>> e9356a3a (.)
=======
### DEV
>>>>>>> 42ab2308 (.)
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
### DEV
>>>>>>> ea169dcc (.)
<<<<<<< HEAD
=======
### DEV
>>>>>>> e0c964a3 (first)
=======
>>>>>>> 4f97354 (.)
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs barryvdh/laravel-debugbar
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs barryvdh/laravel-ide-helper
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs thecodingmachine/phpstan-safe-rule
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs larastan/larastan
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs laravel/pint
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs pestphp/pest
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs pestphp/pest-plugin-laravel
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ea169dcc (.)
=======
>>>>>>> e0c964a3 (first)
=======
=======
>>>>>>> ea169dcc (.)
>>>>>>> 4f97354 (.)

### REMOVE
php -d memory_limit=-1 composer.phar remove laravel/sanctum
rm config/sanctum.php 
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 4f97354 (.)
=======
=======
<<<<<<< HEAD
>>>>>>> ec52a6b4 (.)
=======
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs pestphp/pest-plugin-arch
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs phpstan/extension-installer
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs phpstan/phpstan-deprecation-rules
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs phpstan/phpstan-phpunit
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs spatie/laravel-ray
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs nunomaduro/collision
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs orchestra/testbench
=======
<<<<<<< HEAD
=======
>>>>>>> 71ff9e32 (.)
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> develop

### REMOVE UNUSED PACKAGES
php -d memory_limit=-1 composer.phar remove laravel/sanctum
<<<<<<< HEAD
rm config/sanctum.php
=======
rm config/sanctum.php 
=======
>>>>>>> f52d0712 (.)
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs pestphp/pest-plugin-arch
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs phpstan/extension-installer
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs phpstan/phpstan-deprecation-rules
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs phpstan/phpstan-phpunit
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs spatie/laravel-ray
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs nunomaduro/collision
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs orchestra/testbench
<<<<<<< HEAD

### REMOVE UNUSED PACKAGES
php -d memory_limit=-1 composer.phar remove laravel/sanctum
rm config/sanctum.php
=======
=======
>>>>>>> ec52a6b4 (.)
>>>>>>> 42ab2308 (.)

### REMOVE
php -d memory_limit=-1 composer.phar remove laravel/sanctum
<<<<<<< HEAD
rm config/sanctum.php
>>>>>>> e9356a3a (.)
=======
rm config/sanctum.php 
>>>>>>> 42ab2308 (.)
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> f52d0712 (.)
=======
>>>>>>> develop
>>>>>>> 71ff9e32 (.)
>>>>>>> ec52a6b4 (.)
=======
>>>>>>> ea169dcc (.)
<<<<<<< HEAD
=======
>>>>>>> e0c964a3 (first)
=======
>>>>>>> 4f97354 (.)
