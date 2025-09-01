# Employee Module - Laraxot

## Overview

Complete Employee module implementation for comprehensive employee management functionality. The module provides employee data management, time tracking, department organization, and follows strict Laraxot conventions.

## Documentation Structure

The documentation is organized into logical categories for better navigation and maintenance:

### 📚 Core Documentation
- **[README.md](README.md)** - This overview document
- **[configuration.md](configuration.md)** - Module configuration guide
- **[naming-standards.md](naming-standards.md)** - Naming conventions and standards
- **[module_structure.md](module_structure.md)** - Module organization guide
- **[xotbase_extension_rules.md](xotbase_extension_rules.md)** - Critical Laraxot compliance rules

### 🏗️ Architecture Documentation
- **[architecture/](architecture/README.md)** - System architecture and design
  - Data architecture and relationships
  - Model architecture and structure
  - Technical architecture overview
  - Feature comparison matrix

### 🚀 Implementation Guides
- **[implementation/](implementation/README.md)** - Implementation guides and setup
  - Master implementation plan
  - Module setup and installation
  - Technical implementation details
  - Development workflows and best practices

### ✨ Feature Documentation
- **[features/](features/README.md)** - Feature specifications and implementation
  - Work hour tracking system
  - Functional requirements
  - Implementation strategies
  - Detailed feature specifications

### 🔍 Analysis & Research
- **[analysis/](analysis/README.md)** - Research and analysis documentation
  - Reference system analysis
  - Language and naming best practices

### 🔧 Maintenance & Fixes
- **[maintenance/](maintenance/README.md)** - Maintenance and troubleshooting
  - Historical corrections log
  - PHPStan fixes and solutions
  - XotBase compliance fixes

### 👨‍💻 Development Guides
- **[development/](development/README.md)** - Step-by-step development guides
  - **[employee-management/](development/employee-management/README.md)** - Employee registry and profiles
  - **[time-tracking/](development/time-tracking/README.md)** - Time tracking and attendance
  - **[organizational/](development/organizational/README.md)** - Department and position management
  - **[leave-management/](development/leave-management/README.md)** - Vacation and leave systems
  - **[document-management/](development/document-management/README.md)** - Document storage and contracts
  - **[communication/](development/communication/README.md)** - Bulletin board and messaging
  - **[reporting/](development/reporting/README.md)** - Dashboard and analytics
  - **[security/](development/security/README.md)** - Roles and permissions
  - **[mobile/](development/mobile/README.md)** - PWA and mobile development
  - **[integrations/](development/integrations/README.md)** - External system integrations

## Critical Laraxot Philosophy Compliance

### XotBase Extension Rules (ABSOLUTE PRIORITY)

**NEVER EXTEND FILAMENT CLASSES DIRECTLY - ALWAYS USE XOTBASE**

```php
// ❌ FORBIDDEN
class EmployeeResource extends Filament\Resources\Resource
class EmployeePage extends Filament\Pages\Page

// ✅ MANDATORY
class EmployeeResource extends Modules\Xot\Filament\Resources\XotBaseResource
class EmployeePage extends Modules\Xot\Filament\Pages\XotBasePage
```

### Naming Standards (Employee Module)

**ALL CODE ELEMENTS MUST BE IN ENGLISH - NO EXCEPTIONS**

- **Classes**: English only (TimeClockWidget ✅, TimbratureWidget ❌)
- **Methods**: English only (getTimeEntries ✅, getTimbrature ❌)
- **Properties**: English only ($timeEntries ✅, $timbrature ❌)
- **Files**: English only (TimeClockWidget.php ✅, TimbratureWidget.php ❌)
- **Directories**: English only (TimeClock/ ✅, Timbrature/ ❌)
- **Table names**: English only (time_entries ✅, timbrature ❌)
- **Column names**: English only (timestamp ✅, data_timbratura ❌)
- **Enum values**: English only (clock_in ✅, entrata ❌)
- **Variables**: English only ($currentTime ✅, $oraCorrente ❌)

**CRITICAL: NO CASE-ONLY VARIATIONS**

**NEVER create multiple classes where names differ ONLY by case:**
- ❌ `userController` vs `UserController` (case-only difference)
- ❌ `employeeModel` vs `EmployeeModel` (case-only difference)
- ✅ `TimeClockWidget` vs `AttendanceWidget` (distinct names)
- ✅ `UserController` vs `AuthController` (distinct names)

**Why This Rule Exists:**
- Prevents developer confusion and maintenance nightmares
- Avoids file system conflicts on case-insensitive systems
- Ensures clear, unambiguous naming conventions
- Maintains code clarity and team collaboration

**ITALIAN ALLOWED ONLY IN:**
- Translation files (lang/it/, lang/en/)
- View Blade text for users  
- PHP comments for explanations
- As absolute last resort when no English alternative exists

## Module Structure

```
laravel/Modules/Employee/
├── app/
│   ├── Actions/           # Business logic actions
│   ├── Data/             # Data Transfer Objects
│   ├── Filament/         # Filament resources and pages
│   ├── Http/             # Controllers and middleware
│   ├── Models/           # Eloquent models
│   └── Providers/        # Service providers
├── config/               # Module configuration
├── database/             # Migrations and seeders
├── docs/                 # Module documentation (organized structure)
├── lang/                 # Language files
│   ├── it/              # Italian translations
│   └── en/              # English translations
├── resources/            # Views and assets
│   └── svg/             # SVG icons
│       ├── icon.svg     # Main module icon
│       ├── icon1.svg    # First variant
│       ├── icon2.svg    # Second variant
│       └── icon3.svg    # Third variant
└── routes/               # Module routes
```

## Core Features

### 1. Employee Management
- Complete employee profile management
- Department and position organization
- Employee status tracking
- Document management

### 2. Time Tracking (WorkHour)
- Clock in/out functionality
- Break management
- GPS location tracking
- Photo verification
- Approval workflow

### 3. Department Management
- Hierarchical department structure
- Employee assignment
- Department statistics

### 4. Reporting and Analytics
- Employee performance metrics
- Time tracking reports
- Department analytics
- Export functionality

## Database Schema

### Tables
- `employees` - Employee profiles
- `departments` - Department structure
- `positions` - Job positions
- `time_entries` - Time tracking records

### Relationships
- Employee belongs to Department
- Employee has many TimeEntries
- Department has many Employees
- Department can have parent Department

## Language and Localization

### Language Files Structure
The module follows Laraxot language standards with comprehensive translation files:

- **Italian (it/)**: Primary language with complete translations
- **English (en/)**: Secondary language for international use
- **Structure**: Organized by model and functionality

### Translation Standards
- **Consistency**: Uniform terminology across all files
- **Completeness**: All user-facing text is translated
- **Quality**: Professional but understandable language
- **Maintenance**: Regular updates and validation

### Key Language Files
- `work_hour.php` - Time tracking translations
- `employee.php` - Employee management translations
- `department.php` - Department management translations

## SVG Icon System

### Custom SVG Icon System
The Employee module uses a custom SVG icon system:
- **Config**: `'icon' => 'employee-icon'` in navigation
- **SVG Files**: Multiple variants in `resources/svg/`
- **Auto-Registration**: XotBaseServiceProvider automatically registers all SVG files
- **Naming Convention**: Files become `{module-name}-{filename}` (e.g., `employee-icon`)

### Icon Variants Available
- **icon.svg** - Main module icon (Heroicon outline style)
- **icon1.svg** - First variant with different design
- **icon2.svg** - Second variant with alternative design
- **icon3.svg** - Third variant for additional options

### Icon Features
- **Dark Theme Ready**: Uses `currentColor` for automatic theme adaptation
- **Animations**: CSS transitions and hover effects
- **Heroicon Style**: Outline design consistent with Filament
- **Responsive**: Scalable vector graphics for all sizes

## Filament Integration

### Resources
- `EmployeeResource` - Employee management interface
- `DepartmentResource` - Department management interface
- `WorkHourResource` - Time tracking interface

### Pages
- Custom pages for specialized functionality
- Time clock interface for employees
- Dashboard with employee statistics

### Widgets

#### Primary Widget (Active)
- **TimeClockWidget** ✨ UNIFIED - Single consolidated time tracking widget
  - Layout: [TIME+DATE] [TIME ENTRIES] [FILAMENT BUTTON]
  - Native Filament components (`x-filament::button`)
  - Real-time updates with polling
  - Complete time tracking functionality
  - Consolidates all time tracking features into one widget

#### CRITICAL NAMING RULES
**NEVER use Italian words in class names** - Fundamental Laraxot philosophy rule:
- ❌ FORBIDDEN: `TimbratureWidget`, `DipendenteModel`, `OrganizzativaResource`
- ✅ CORRECT: `TimeClockWidget`, `EmployeeModel`, `OrganizationalResource`

**NEVER create case-only variations** - Prevents confusion and maintenance issues:
- ❌ FORBIDDEN: `userController` and `UserController` (case difference only)
- ❌ FORBIDDEN: `UserService` and `userService` (case difference only)
- ✅ CORRECT: ONE unified class with clear, distinct naming

#### Supporting Widgets (Available)
- **EmployeeOverviewWidget** - General employee statistics overview
- **WorkHourStatsWidget** - Time tracking statistics and attendance
- Recent activity tracking
- Quick action buttons

## Configuration

### Module Configuration
```php
// config/employee.php
return [
    'default_working_hours' => 8,
    'break_duration' => 60, // minutes
    'overtime_threshold' => 8, // hours
    'gps_required' => true,
    'photo_verification' => true,
];
```

### Language Configuration
```php
// config/app.php
'locale' => 'it',
'fallback_locale' => 'en',
'available_locales' => ['it', 'en'],
```

## Development Guidelines

### 1. Code Quality
- Follow PSR-12 coding standards
- Use strict types (`declare(strict_types=1);`)
- Implement proper PHPDoc documentation
- Pass PHPStan level 10 validation

### 2. Filament Development
- **ALWAYS** extend XotBase classes
- Implement required abstract methods
- Use translation files for all text
- Follow Laraxot naming conventions

### 3. Database Development
- Use XotBaseMigration for all migrations
- **NEVER** implement `down()` method
- Follow English naming conventions
- Implement proper foreign key constraints

### 4. Language Development
- Maintain consistency across all files
- Use structured translation keys
- Include help text and tooltips
- Validate syntax with `php -l`

### 5. Icon Development
- Follow Heroicon outline style
- Use `currentColor` for theme adaptation
- Include CSS animations and transitions
- Maintain consistent viewBox and stroke-width

## Testing

### Test Structure
- Unit tests for models and actions
- Feature tests for Filament resources
- Integration tests for time tracking
- Language validation tests

### Test Commands
```bash
# Run all Employee module tests
php artisan test --testsuite=Employee

# Run specific test file
php artisan test tests/Feature/Employee/EmployeeTest.php

# Run with coverage
php artisan test --coverage --testsuite=Employee
```

## Documentation

### Module Documentation
- [Model Architecture](model_architecture.md) - Database and model structure
- [WorkHour Implementation](workhour_implementation.md) - Time tracking system
- [Filament Widgets](filament_widgets.md) - Dashboard widgets e statistiche
- [Technical Implementation](technical_implementation.md) - Technical details
- [Language Best Practices](language_best_practices.md) - Translation standards
- [SVG Icon Standards](svg_icon_standards.md) - Icon system and standards

### Root Documentation
- [Employee Language Standards](../../docs/employee_language_standards.md) - Complete language standards
- [SVG Icon System Standards](../../docs/svg_icon_system_standards.md) - Complete icon system standards
- [XotBase Extension Rules](../../docs/xotbase_extension_rules.md) - Filament development rules
- [Laraxot Conventions](../../laravel/Modules/Xot/docs/conventions.md) - General conventions

### Language Documentation
- [Translation Standards](../../laravel/Modules/Lang/docs/translation_file_syntax.md) - Language file syntax
- [Best Practices](../../laravel/Modules/Lang/docs/) - Language development guidelines

## Installation and Setup

### 1. Module Registration
```bash
# Register the module in composer.json
composer require modules/employee

# Publish configuration files
php artisan vendor:publish --tag=employee-config

# Run migrations
php artisan migrate
```

### 2. Language Setup
```bash
# Publish language files
php artisan vendor:publish --tag=employee-lang

# Clear language cache
php artisan lang:clear
```

### 3. Filament Setup
```bash
# Register Filament resources
php artisan employee:install

# Clear Filament cache
php artisan filament:clear-cache
```

### 4. Icon System Setup
```bash
# Icons are automatically registered by XotBaseServiceProvider
# No additional setup required
# SVG files in resources/svg/ are automatically available
```

## Maintenance and Updates

### Regular Tasks
- Update language files for new features
- Validate syntax with `php -l`
- Run PHPStan analysis
- Update documentation
- Verify icon system functionality

### Quality Assurance
- Test all language files
- Verify translation consistency
- Check for missing translations
- Validate Filament integration
- Test icon rendering and animations

## Troubleshooting

### Common Issues
1. **Missing Translations**: Check language file structure
2. **Syntax Errors**: Use `php -l` to validate files
3. **Filament Errors**: Verify XotBase extension
4. **Language Issues**: Clear language cache
5. **Icon Issues**: Verify SVG file structure and registration

### Debug Commands
```bash
# Check language file syntax
php -l laravel/Modules/Employee/lang/it/work_hour.php

# Validate translations
php artisan lang:missing

# Clear all caches
php artisan optimize:clear

# Check icon registration
php artisan route:list | grep icon
```

## Contributing

### Development Workflow
1. Study existing documentation
2. Follow Laraxot conventions
3. Update language files
4. Create/update SVG icons if needed
5. Test thoroughly
6. Update documentation
7. Submit for review

### Code Review Checklist
- [ ] Follows XotBase extension rules
- [ ] Passes PHPStan validation
- [ ] Includes proper translations
- [ ] SVG icons follow standards
- [ ] Updates documentation
- [ ] Follows naming conventions

## Support and Resources

### Internal Resources
- [Employee Module Docs](./) - Complete module documentation
- [Laraxot Framework](../../laravel/Modules/Xot/docs/) - Framework documentation
- [Language Standards](../../laravel/Modules/Lang/docs/) - Translation guidelines
- [Icon System Standards](../../docs/svg_icon_system_standards.md) - Icon system guidelines

### External Resources
- [Laravel Documentation](https://laravel.com/docs)
- [Filament Documentation](https://filamentphp.com/docs)
- [Laraxot Documentation](https://laraxot.com)
- [Heroicons](https://heroicons.com/) - Icon reference

---

**IMPORTANT**: Always follow Laraxot conventions and extend XotBase classes. Never extend Filament classes directly. Maintain high-quality translations, comprehensive documentation, and consistent SVG icon standards.
