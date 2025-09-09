#!/bin/sh
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
php -r "unlink('composer.lock');"
rm composer.lock
rm package-lock.json
<<<<<<< HEAD

=======
<<<<<<< HEAD
<<<<<<< HEAD
#mv composer.json composer_$(date +"%Y-%m-%d").json
#php composer.phar init

=======

>>>>>>> develop
############## PRODUCTION DEPENDENCIES ####################
php -d memory_limit=-1 composer.phar require -W illuminate/contracts

# Core Framework
<<<<<<< HEAD
=======
>>>>>>> e9356a3a (.)
=======
#mv composer.json composer_$(date +"%Y-%m-%d").json
#php composer.phar init

>>>>>>> 42ab2308 (.)
>>>>>>> develop
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs filament/filament
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs coolsam/modules
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs nwidart/laravel-modules
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs doctrine/dbal
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs livewire/livewire
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs livewire/volt
<<<<<<< HEAD

### SPATIE PACKAGES
=======
<<<<<<< HEAD
<<<<<<< HEAD
### SPATIE
=======

### SPATIE PACKAGES
>>>>>>> e9356a3a (.)
=======
### SPATIE
>>>>>>> 42ab2308 (.)
>>>>>>> develop
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

### USER MODULE
=======
<<<<<<< HEAD
<<<<<<< HEAD
### USER 
=======

### USER MODULE
>>>>>>> e9356a3a (.)
=======
### USER 
>>>>>>> 42ab2308 (.)
>>>>>>> develop
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs jenssegers/agent
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs laravel/passport
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs socialiteproviders/auth0
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs tightenco/parental
<<<<<<< HEAD

### NOTIFY MODULE
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
>>>>>>> develop
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs mhmiton/laravel-modules-livewire
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs laravel/breeze
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs owenvoke/blade-fontawesome
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs laravel/folio
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs cknow/laravel-money
php artisan folio:install
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs livewire/volt
php artisan volt:install
<<<<<<< HEAD

### IMPORT/EXPORT
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spipu/html2pdf
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs maatwebsite/excel

### UTILITIES
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

### IMPORT/EXPORT
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spipu/html2pdf
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs maatwebsite/excel

### UTILITIES
>>>>>>> e9356a3a (.)
=======
#php -d memory_limit=-1 composer.phar require -W guava/filament-icon-picker
## IMPORT/EXPORT
#php -d memory_limit=-1 composer.phar require -W konnco/filament-import
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs spipu/html2pdf
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs maatwebsite/excel
####
>>>>>>> 42ab2308 (.)
>>>>>>> develop
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs thecodingmachine/safe
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs symfony/dom-crawler
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs flowframe/laravel-trend
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs staudenmeir/laravel-adjacency-list
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs fidum/laravel-eloquent-morph-to-one
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs calebporzio/sushi
php -d memory_limit=-1 composer.phar require -W --ignore-platform-reqs predis/predis

<<<<<<< HEAD
############################ DEV DEPENDENCIES ###############################
=======
<<<<<<< HEAD
<<<<<<< HEAD
### DEV
=======
############################ DEV DEPENDENCIES ###############################
>>>>>>> e9356a3a (.)
=======
### DEV
>>>>>>> 42ab2308 (.)
>>>>>>> develop
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs barryvdh/laravel-debugbar
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs barryvdh/laravel-ide-helper
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs thecodingmachine/phpstan-safe-rule
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs larastan/larastan
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs laravel/pint
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs pestphp/pest
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs pestphp/pest-plugin-laravel
<<<<<<< HEAD
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs pestphp/pest-plugin-arch
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs phpstan/extension-installer
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs phpstan/phpstan-deprecation-rules
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs phpstan/phpstan-phpunit
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs spatie/laravel-ray
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs nunomaduro/collision
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs orchestra/testbench
=======
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
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs pestphp/pest-plugin-arch
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs phpstan/extension-installer
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs phpstan/phpstan-deprecation-rules
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs phpstan/phpstan-phpunit
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs spatie/laravel-ray
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs nunomaduro/collision
php -d memory_limit=-1 composer.phar require -W --dev --ignore-platform-reqs orchestra/testbench
=======
>>>>>>> 42ab2308 (.)

### REMOVE
php -d memory_limit=-1 composer.phar remove laravel/sanctum
<<<<<<< HEAD
rm config/sanctum.php
>>>>>>> e9356a3a (.)
=======
rm config/sanctum.php 
>>>>>>> 42ab2308 (.)
>>>>>>> develop
