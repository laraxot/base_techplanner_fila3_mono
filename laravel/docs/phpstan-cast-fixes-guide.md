# PHPStan Cast Fixes Guide - Using SafeFloatCastAction

## Overview

This guide demonstrates how to systematically fix "Cannot cast mixed to float" PHPStan errors using the `SafeFloatCastAction` that follows DRY and KISS principles.

## Quick Reference

```php
use Modules\Xot\Actions\Cast\SafeFloatCastAction;

// Basic usage
$value = SafeFloatCastAction::cast($mixedValue);

// With custom default
$value = SafeFloatCastAction::cast($mixedValue, 10.5);

// With range validation
$percentage = SafeFloatCastAction::castWithRange($mixedValue, 0.0, 100.0);
```

## Systematic Fix Examples

### 1. Geo Module - Coordinate Casting

**Before (PHPStan Error):**
```php
// ❌ Cannot cast mixed to float
$lat = (float) $data['lat'];
$lng = (float) $data['lng'];
$elevation = (float) $response['elevation'];
```

**After (Safe & Validated):**
```php
// ✅ Safe with range validation for coordinates
$lat = SafeFloatCastAction::castWithRange($data['lat'], -90.0, 90.0);
$lng = SafeFloatCastAction::castWithRange($data['lng'], -180.0, 180.0);
$elevation = SafeFloatCastAction::cast($response['elevation']);
```

### 2. Chart Module - Data Processing

**Before (PHPStan Error):**
```php
// ❌ Cannot cast mixed to float
$data[$key] = number_format((float) $item, 2, '.', '');
```

**After (Safe):**
```php
// ✅ Safe casting with proper formatting
$data[$key] = number_format(SafeFloatCastAction::cast($item), 2, '.', '');
```

### 3. Notify Module - Configuration Values

**Before (PHPStan Error):**
```php
// ❌ Cannot cast mixed to int/float
$chatId = (int) $config['chat_id'];
$timeout = (float) $config['timeout'];
```

**After (Safe):**
```php
// ✅ Safe casting with appropriate defaults
$chatId = (int) SafeFloatCastAction::cast($config['chat_id']);
$timeout = SafeFloatCastAction::cast($config['timeout'], 30.0);
```

### 4. Factory/Faker Data

**Before (PHPStan Error):**
```php
// ❌ Cannot cast mixed to float
$latitude = (float) $faker->latitude;
$longitude = (float) $faker->longitude;
```

**After (Safe):**
```php
// ✅ Safe with coordinate validation
$latitude = SafeFloatCastAction::castWithRange($faker->latitude, -90.0, 90.0);
$longitude = SafeFloatCastAction::castWithRange($faker->longitude, -180.0, 180.0);
```

## Remaining Errors to Fix

Based on the PHPStan analysis, here are the specific files that need the SafeFloatCastAction treatment:

### Geo Module
- `Geo/app/Actions/Elevation/GetElevationAction.php:60`
- `Geo/app/Actions/GetCoordinatesByAddressAction.php:167`
- `Geo/app/Console/Commands/SushiCommand.php:109-110`
- `Geo/app/Filament/Forms/Components/AddressesField.php:90`
- `Geo/app/Filament/Pages/DotswanMap.php:33`
- `Geo/database/factories/AddressFactory.php:199,201`

### Chart Module
- `Chart/app_old/Datas/AnswersChartData.php:102`

### Notify Module
- `Notify/app/Actions/SMS/SendNetfunSMSAction.php:58`
- `Notify/app/Actions/Telegram/*Action.php` (multiple files)
- `Notify/app/Actions/WhatsApp/*Action.php` (multiple files)

## Implementation Strategy

### Step 1: Import the Action
```php
use Modules\Xot\Actions\Cast\SafeFloatCastAction;
```

### Step 2: Replace Unsafe Casts
```php
// Replace this pattern:
(float) $mixedValue

// With this:
SafeFloatCastAction::cast($mixedValue)
```

### Step 3: Add Range Validation Where Appropriate
```php
// For coordinates
SafeFloatCastAction::castWithRange($lat, -90.0, 90.0)
SafeFloatCastAction::castWithRange($lng, -180.0, 180.0)

// For percentages
SafeFloatCastAction::castWithRange($percentage, 0.0, 100.0)

// For positive values
SafeFloatCastAction::castWithRange($price, 0.0, PHP_FLOAT_MAX)
```

## Benefits

1. **Type Safety**: Eliminates PHPStan "Cannot cast mixed to float" errors
2. **Robustness**: Handles edge cases (null, empty strings, invalid formats)
3. **Consistency**: Uniform behavior across the entire codebase
4. **Maintainability**: Single point of truth for float casting logic
5. **Validation**: Built-in range validation for domain-specific values

## Testing

After applying fixes, verify with:

```bash
cd /var/www/html/_bases/base_techplanner_fila3_mono/laravel
./vendor/bin/phpstan analyze Modules --level=9
```

## Performance Impact

- **Minimal Overhead**: Native PHP type checking
- **No Memory Allocation**: Stateless operation
- **Cache Friendly**: No internal state

---

*Generated: 2025-07-31 - Part of PHPStan Error Resolution Initiative*
