# Organization of Filament Resources

## Namespace Structure

- Base resource classes should be in: `Modules\<ModuleName>\Filament\Resources`
- Never use `app/Filament` - this is a legacy pattern
- Follow Filament's standard directory structure within the module's `Filament` directory

## Base Classes

- Always extend XotBase classes instead of Filament base classes
- Example: Extend `XotBaseResource` instead of `Resource`
- Keep base classes abstract
- Place base classes in the appropriate namespace within the module

## Naming Conventions

- Base classes should be prefixed with `Base` (e.g., `BaseViewUser`)
- Implementation classes should be descriptive (e.g., `ViewDoctor`, `ViewPatient`)
- Follow PSR-4 autoloading standards

## Common Pitfalls

1. **Duplicate Class Names**: Ensure class names are unique across modules
2. **Incorrect Namespace**: Always verify the namespace matches the directory structure
3. **Missing Abstract**: Base classes should be abstract
4. **Incorrect Extension**: Always extend XotBase classes, not Filament classes directly

## Best Practices

1. Keep resource-specific logic in the appropriate module
2. Use traits for shared functionality
3. Document any non-standard implementations
4. Follow the Single Responsibility Principle
5. Keep view-related code in the view layer

## Example Structure

```
Modules/
  User/
    Filament/
      Resources/
        UserResource.php
        UserResource/
          Pages/
            BaseViewUser.php
            ViewUser.php
```
