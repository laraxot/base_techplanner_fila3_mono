# User Module

## Overview

The User module provides comprehensive user management functionality including authentication, registration, profile management, and user type handling. This module follows the Laravel Modules architecture and integrates seamlessly with Filament for admin interfaces.

## Key Features

- **User Authentication**: Login, logout, password reset, and email verification
- **User Registration**: Multi-step registration with validation
- **Profile Management**: User profile editing and management
- **User Types**: Support for different user types (standard, admin, etc.)
- **Security**: Password policies, account locking, and security features
- **Filament Integration**: Complete admin interface using Filament

## Architecture

### Widgets

All Filament widgets in this module extend `XotBaseWidget` and follow established patterns:

- **Authentication Widgets**: Login, registration, password reset
- **Profile Widgets**: User profile editing and management
- **Chart Widgets**: User statistics and analytics

### Type Safety

The module implements comprehensive type safety measures:

- **Safe Type Casting**: All form data uses `safeStringCast()` method
- **Proper Type Declarations**: All methods have proper parameter and return types
- **PHPDoc Annotations**: Comprehensive documentation for complex types
- **PHPStan Compliance**: Full compliance with PHPStan level 9

### Security Features

- **Password Hashing**: Secure password storage using Laravel's Hash facade
- **Input Validation**: Comprehensive validation for all user inputs
- **Safe Data Handling**: All sensitive data is handled safely
- **Error Handling**: Graceful error handling with proper user feedback

## File Structure

```
Modules/User/
├── app/
│   ├── Actions/           # Business logic actions
│   ├── Filament/          # Filament components
│   │   ├── Pages/         # Filament pages
│   │   ├── Resources/     # Filament resources
│   │   └── Widgets/       # Filament widgets
│   ├── Http/              # HTTP layer
│   ├── Models/            # Eloquent models
│   └── Services/          # Service classes
├── database/              # Database migrations and seeders
├── docs/                  # Documentation
├── resources/             # Views and assets
└── routes/                # Route definitions
```

## Widgets

### Authentication Widgets

#### LoginWidget
- **Purpose**: User login interface
- **Features**: Email/password authentication, remember me, error handling
- **Security**: Rate limiting, validation, secure session handling

#### RegisterWidget
- **Purpose**: User registration interface
- **Features**: Multi-step registration, validation, email verification
- **Security**: Password strength validation, duplicate email prevention

#### PasswordResetWidget
- **Purpose**: Password reset request interface
- **Features**: Email-based password reset, token validation
- **Security**: Secure token generation, email validation

#### PasswordResetConfirmWidget
- **Purpose**: Password reset confirmation interface
- **Features**: Token validation, new password setting
- **Security**: Secure password hashing, token verification

#### PasswordExpiredWidget
- **Purpose**: Password expiration handling
- **Features**: Current password verification, new password setting
- **Security**: Secure password validation, account protection

### Profile Widgets

#### EditUserWidget
- **Purpose**: User profile editing
- **Features**: Dynamic form generation, validation, data persistence
- **Security**: User authorization, data sanitization

### Chart Widgets

#### UserTypeRegistrationsChartWidget
- **Purpose**: User registration analytics
- **Features**: Time-based charts, filtering, data visualization
- **Type Safety**: Proper handling of TrendValue objects

## Type Safety Implementation

### Safe String Casting

All widgets implement a `safeStringCast()` method for secure type conversion:

```php
private function safeStringCast(mixed $value): string
{
    if (is_string($value)) {
        return $value;
    }

    if (is_null($value)) {
        return '';
    }

    if (is_bool($value)) {
        return $value ? '1' : '0';
    }

    if (is_scalar($value)) {
        return (string) $value;
    }

    return '';
}
```

### Form Data Handling

All form data is safely handled:

```php
protected function validateForm(): array
{
    $data = $this->form->getState();
    
    return [
        'first_name' => $this->safeStringCast($data['first_name'] ?? ''),
        'last_name' => $this->safeStringCast($data['last_name'] ?? ''),
        'email' => $this->safeStringCast($data['email'] ?? ''),
        'password' => Hash::make($this->safeStringCast($data['password'] ?? '')),
    ];
}
```

## Configuration

### Widget Configuration

All widgets use proper view configuration:

```php
/**
 * @var string
 */
protected static string $view = 'pub_theme::filament.widgets.edit-user';
```

### PHPStan Configuration

The module is configured for PHPStan level 9 compliance with specific ignore patterns for Filament's view-string type system.

## Testing

### Unit Tests

Test the safe string casting functionality:

```php
public function test_safe_string_cast_handles_various_types(): void
{
    $widget = new TestWidget();
    
    $this->assertEquals('test', $widget->safeStringCast('test'));
    $this->assertEquals('', $widget->safeStringCast(null));
    $this->assertEquals('1', $widget->safeStringCast(true));
    $this->assertEquals('0', $widget->safeStringCast(false));
    $this->assertEquals('123', $widget->safeStringCast(123));
    $this->assertEquals('', $widget->safeStringCast([]));
}
```

### Integration Tests

- Test form submission with various data types
- Verify password reset functionality
- Test user registration with edge cases
- Validate chart widget data handling

## Best Practices

### Development Guidelines

1. **Always extend XotBaseWidget**: Never extend Filament classes directly
2. **Use safeStringCast()**: For all type conversions from mixed to string
3. **Add proper type declarations**: All methods should have parameter and return types
4. **Implement proper validation**: Validate all user inputs
5. **Handle errors gracefully**: Provide meaningful error messages

### Security Guidelines

1. **Hash passwords**: Always use Hash::make() for password storage
2. **Validate inputs**: Comprehensive validation for all user inputs
3. **Sanitize data**: Clean all data before processing
4. **Rate limiting**: Implement rate limiting for authentication endpoints
5. **Session security**: Proper session handling and security

### Performance Guidelines

1. **Efficient queries**: Use proper Eloquent relationships
2. **Caching**: Implement caching where appropriate
3. **Lazy loading**: Use lazy loading for widgets
4. **Memory management**: Proper memory handling for large datasets

## Troubleshooting

### Common Issues

1. **PHPStan Errors**: Ensure all type declarations are proper
2. **View Not Found**: Check view paths and namespaces
3. **Form Validation**: Verify validation rules and messages
4. **Authentication**: Check user model and guard configuration

### Debugging

1. **Enable logging**: Check Laravel logs for errors
2. **PHPStan Analysis**: Run `./vendor/bin/phpstan analyse Modules/User`
3. **Test Coverage**: Run tests to identify issues
4. **Type Checking**: Verify all type declarations

## Contributing

When contributing to this module:

1. Follow the established architectural patterns
2. Implement proper type safety measures
3. Add comprehensive tests
4. Update documentation
5. Ensure PHPStan compliance

## Related Documentation

- [Type Safety Improvements](type-safety-improvements.md)
- [Widget Structure](widgets_structure.md)
- [PHPStan Fixes](phpstan-fixes.md)

