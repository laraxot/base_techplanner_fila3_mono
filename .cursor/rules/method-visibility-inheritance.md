# CRITICAL RULE: Method Visibility Must Match Parent Class

## ABSOLUTE REQUIREMENT

**When overriding methods from XotBase classes, ALWAYS maintain the same visibility level as the parent method.**

## Fatal Error Example

```
Access level to getTableActions() must be public (as in class XotBaseListRecords)
```

## Common Violations

- ❌ `protected function getTableActions()` when parent is `public`
- ❌ `private function getHeaderActions()` when parent is `public`
- ❌ `protected function getTableColumns()` when parent is `public`
- ❌ `protected function getFormSchema()` when parent is `public`

## Correct Patterns

- ✅ `public function getTableActions()` matching parent visibility
- ✅ `public function getHeaderActions()` matching parent visibility
- ✅ `public function getTableColumns()` matching parent visibility
- ✅ `public function getFormSchema()` matching parent visibility

## Why This Rule Exists

1. **PHP Inheritance Rules**: Child classes cannot reduce visibility of parent methods
2. **Liskov Substitution Principle**: Child classes must be substitutable for parent classes
3. **Framework Compatibility**: Filament expects public methods for resource operations
4. **Polymorphism**: Methods must be callable through parent class interface

## Common XotBase Methods That Must Be Public

- `getTableActions(): array`
- `getHeaderActions(): array`
- `getTableColumns(): array`
- `getFormSchema(): array`
- `getTableFilters(): array`
- `getTableBulkActions(): array`

## Enforcement Strategy

- Always check parent method visibility before overriding
- Use IDE tools to verify method signatures
- Run PHPStan to catch visibility violations
- Document visibility requirements in XotBase classes

**THIS IS A FUNDAMENTAL PHP INHERITANCE RULE**
