# FUNDAMENTAL LARAXOT RULE - NEVER EXTEND FILAMENT CLASSES DIRECTLY

## CRITICAL PHILOSOPHY RULE - NEVER VIOLATE

### NEVER EXTEND FILAMENT CLASSES DIRECTLY
Always extend XotBase abstract classes with the same name prefixed with "XotBase":

#### Filament Resource Pages
- ❌ NEVER: `extends Filament\Resources\Pages\CreateRecord`
- ✅ ALWAYS: `extends Modules\Xot\Filament\Resources\Pages\XotBaseCreateRecord`

- ❌ NEVER: `extends Filament\Resources\Pages\EditRecord`  
- ✅ ALWAYS: `extends Modules\Xot\Filament\Resources\Pages\XotBaseEditRecord`

- ❌ NEVER: `extends Filament\Resources\Pages\ListRecords`
- ✅ ALWAYS: `extends Modules\Xot\Filament\Resources\Pages\XotBaseListRecords`

- ❌ NEVER: `extends Filament\Resources\Pages\Page`
- ✅ ALWAYS: `extends Modules\Xot\Filament\Resources\Pages\XotBasePage`

#### Filament Resources
- ❌ NEVER: `extends Filament\Resources\Resource`
- ✅ ALWAYS: `extends Modules\Xot\Filament\Resources\XotBaseResource`

#### Other Filament Components
- ❌ NEVER: `extends Filament\Widgets\Widget`
- ✅ ALWAYS: `extends Modules\Xot\Filament\Widgets\XotBaseWidget`

## CRITICAL ADDITIONAL RULES

### XotBaseResource Classes DO NOT Need getTableColumns Method
Classes that extend XotBaseResource should NOT implement getTableColumns() method - this is handled automatically by the base class.

### XotBase Classes Respect Old Paths
XotBase classes maintain backward compatibility and respect old path patterns, providing seamless migration.

## WHY THIS RULE EXISTS
1. **Centralized Management**: XotBase classes handle common functionality automatically
2. **Backward Compatibility**: XotBase classes respect old paths and patterns
3. **Auto-Configuration**: Navigation, properties, and behaviors are auto-managed
4. **Consistency**: Ensures all modules follow the same patterns
5. **Maintainability**: Changes to base behavior affect all modules consistently

## DETECTION COMMANDS

### Find Direct Filament Extensions (VIOLATIONS)
```bash
# Find classes extending Filament directly
grep -r "extends.*Filament\\\\" laravel/Modules/ --include="*.php"

# Find specific violations
grep -r "extends.*Resource" laravel/Modules/ --include="*.php" | grep -v XotBase
grep -r "extends.*CreateRecord" laravel/Modules/ --include="*.php" | grep -v XotBase
grep -r "extends.*EditRecord" laravel/Modules/ --include="*.php" | grep -v XotBase
grep -r "extends.*ListRecords" laravel/Modules/ --include="*.php" | grep -v XotBase
```

### Find Unnecessary getTableColumns Methods
```bash
# Find getTableColumns in XotBaseResource extensions
grep -r "getTableColumns" laravel/Modules/ --include="*.php" -A 5 -B 5
```

## IMPLEMENTATION CHECKLIST
- [ ] Update all existing Filament page classes
- [ ] Update all existing Filament resource classes  
- [ ] Update all existing Filament widget classes
- [ ] Remove getTableColumns() from XotBaseResource extensions
- [ ] Update documentation and rules
- [ ] Update memories and guidelines
- [ ] Validate no direct Filament extensions remain

## CRITICAL
This rule must be followed in ALL modules, ALL components, ALL future development.
