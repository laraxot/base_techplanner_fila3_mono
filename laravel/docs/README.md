# TechPlanner Laravel Application Documentation

## Project Overview

This is a comprehensive Laravel application built using a modular architecture with Filament for admin interfaces and multi-tenant support.

## 🚨 CRITICAL DEVELOPMENT RULES - READ FIRST

### 1. XotBase/LangBase Extension Rule (MANDATORY)
**NEVER extend Filament classes directly. ALWAYS extend XotBase OR LangBase abstract classes.**

⚠️ **CRITICAL**: Check if module is multilingual FIRST!

```php
// ❌ WRONG
use Filament\Resources\Pages\ListRecords;
class MyPage extends ListRecords { }

// ✅ FOR NON-MULTILINGUAL MODULES
use Modules\Xot\Filament\Resources\Pages\XotBaseListRecords;
class MyPage extends XotBaseListRecords { }

// ✅ FOR MULTILINGUAL MODULES (Cms, Blog, News)
use Modules\Lang\Filament\Resources\Pages\LangBaseListRecords;
class MyPage extends LangBaseListRecords { }
```

### 2. Method Signature Rule (CRITICAL)
**ALWAYS match parent/trait method signatures exactly - static vs non-static matters!**

### 3. Abstract Method Rule
**ALL abstract methods from parent classes and traits MUST be implemented.**

## Architecture

### Modular Structure
The application is built using Nwidart Laravel Modules package with the following modules:

#### Core Modules
- **Xot**: Core module providing base classes and shared functionality
- **User**: User management and authentication
- **Tenant**: Multi-tenant support and data isolation
- **Lang**: Internationalization and language management

#### Business Logic Modules
- **TechPlanner**: Main business logic module
- **Employee**: Employee management features
- **Chart**: Data visualization and reporting
- **Activity**: Activity logging and tracking
- **Job**: Background job management

#### Support Modules
- **UI**: User interface components and Filament customizations
- **Geo**: Geographic functionality and location services
- **Media**: File and media management
- **Notify**: Notification and email systems
- **Cms**: Content management system
- **Gdpr**: GDPR compliance features

### Key Technologies

- **Laravel 11**: PHP framework with modern features
- **Filament 3**: Modern admin interface builder
- **Livewire**: Dynamic frontend components
- **Multi-tenancy**: Isolated data per tenant using spatie/multitenancy
- **Sushi Models**: In-memory Eloquent models from JSON files
- **Spatie Packages**: Laravel permissions, media library, model states

## Development Guidelines

### Code Quality Standards
- Follow PSR-12 coding standards
- Use PHPStan level 10 for static analysis
- Implement proper type hints and return types
- Use strict typing (`declare(strict_types=1)`)
- Write comprehensive tests using Pest

### Translation Standards
- **Always implement missing keys in all three languages** (Italian, English, German)
- **Never mix different languages** in a single translation
- **Use consistent terminology** throughout the system
- **For file upload fields**: placeholder should indicate the action (e.g., "Upload Invoice") NOT the content

### File and Folder Structure
- **In docs folders**: use only lowercase characters, exception README.md
- **In Blade templates**: use `@lang` instead of `@trans`
- Each module follows consistent structure with app/, docs/, tests/, etc.

## Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- MySQL/PostgreSQL database
- Redis (optional, for caching)

### Installation
1. Clone the repository
2. Run `composer install`
3. Run `npm install`
4. Copy `.env.example` to `.env` and configure
5. Run migrations: `php artisan migrate`
6. Seed database: `php artisan db:seed`
7. Generate key: `php artisan key:generate`

### Development Commands
- `php artisan serve` - Start development server
- `npm run dev` - Start asset compilation with Vite
- `php artisan test` - Run Pest test suite
- `vendor/bin/phpstan analyse` - Run PHPStan static analysis
- `php artisan module:make-command CommandName ModuleName` - Create new module command

## 🔍 Pre-Implementation Checklist

**Before ANY Filament implementation:**

### Critical Checks
- [ ] Read [`claude-code-rules.md`](./claude-code-rules.md)
- [ ] **🚨 MULTILINGUAL CHECK**: Is the module multilingual? (Use LangBase* if yes, XotBase* if no)
- [ ] Verify XotBase class exists for the Filament class you need
- [ ] Check abstract methods that need implementation
- [ ] Verify method signatures match parent/trait exactly

### Implementation Checks
- [ ] Using XotBase class instead of direct Filament class
- [ ] All abstract methods implemented
- [ ] Method signatures match (especially static vs non-static)
- [ ] No PHP fatal errors when loading page

### Quality Checks
- [ ] Page loads successfully
- [ ] Functionality works as expected
- [ ] Caches cleared if needed
- [ ] New errors documented if encountered

## Testing

The application uses Pest for testing with comprehensive coverage:

### Test Structure
- **Unit Tests**: Models, services, and actions
- **Feature Tests**: HTTP endpoints and workflows
- **Integration Tests**: Module interactions
- **Browser Tests**: End-to-end user flows

### Running Tests
```bash
# Run all tests
php artisan test

# Run specific module tests
php artisan test --filter="User"

# Run with coverage
php artisan test --coverage
```

## 📚 Documentation Structure

### Essential Documentation (READ FIRST)
- [`claude-code-rules.md`](./claude-code-rules.md) - **CRITICAL**: Essential rules that must never be broken
- [`xotbase-extension-rules.md`](./xotbase-extension-rules.md) - XotBase extension patterns and mappings

### Error Prevention Documentation
- [`error-prevention/`](./error-prevention/) - Critical error pattern analysis and prevention
- [`maintenance/git-merge-conflicts.md`](./maintenance/git-merge-conflicts.md) - Git conflict resolution

### Architecture Documentation
- [`architecture/`](./architecture/) - System architecture and design patterns
- [`patterns/`](./patterns/) - Code patterns and best practices

## 🚨 Most Common Fatal Errors

1. **"Cannot make non static method... static"** → Method signature mismatch
2. **"Class contains N abstract method"** → Missing abstract method implementation  
3. **"Method...::route does not exist"** → Incorrect route usage on Page classes

**Solution**: Check [`error-prevention/`](./error-prevention/) documentation for detailed fixes.

## Deployment

### Environment Configuration
- Production: Optimized for performance and security
- Staging: Mirror of production for testing
- Development: Debug mode enabled with detailed logging

### Deployment Steps
1. Run `composer install --optimize-autoloader --no-dev`
2. Run `npm run build`
3. Clear and cache configurations
4. Run migrations
5. Set proper file permissions

## Contributing

1. Follow established code standards and architecture rules
2. Write comprehensive tests for new features
3. Update documentation for significant changes
4. Use conventional commits format
5. Create clear and detailed pull requests
6. Ensure PHPStan level 10 compliance

## Support and Troubleshooting

For technical issues:
1. Check module-specific documentation in `Modules/*/docs/`
2. Review error prevention guides in `docs/error-prevention/`
3. Consult architecture documentation for design patterns
4. Review git conflict resolution procedures

## License

This project is proprietary software. All rights reserved. 