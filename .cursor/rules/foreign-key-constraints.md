# CRITICAL RULE: Foreign Key Constraint Errors in Migrations

## ABSOLUTE REQUIREMENT

**Always ensure foreign key constraints are correctly formed and reference existing tables.**

## Common Error

```
SQLSTATE[HY000]: General error: 1005 Can't create table (errno: 150 "Foreign key constraint is incorrectly formed")
```

## Root Causes

1. **Referenced table doesn't exist**: Target table must exist before creating foreign key
2. **Column type mismatch**: Foreign key and referenced column must have identical types
3. **Migration order**: Dependencies not created in correct sequence
4. **Table name mismatch**: Wrong table name in migration vs actual database

## Correct Patterns

### Use foreignId() for Consistency
```php
// ✅ CORRECT - Ensures matching column types
$table->foreignId('employee_id')
    ->constrained('users')
    ->onDelete('cascade');
```

### Use foreignIdFor() for Model References
```php
// ✅ CORRECT - Type-safe with model reference
$table->foreignIdFor(\Modules\Employee\Models\Employee::class)
    ->constrained()
    ->onDelete('cascade');
```

### Check Table Existence
```php
// ✅ CORRECT - Verify dependencies exist
if (!$this->hasTable('users')) {
    throw new Exception('Users table must exist before creating work_hours');
}
```

## Common Violations

- ❌ Creating foreign key before referenced table exists
- ❌ Mismatched column types (int vs bigint, signed vs unsigned)
- ❌ Wrong table names in constraints
- ❌ Missing primary key on referenced table

## Debugging Steps

1. **Check table existence**: Verify referenced table exists in database
2. **Verify column types**: Ensure exact type match between columns
3. **Check migration order**: Create dependencies first
4. **Validate table names**: Ensure migration creates correct table name

## Prevention Strategy

- Always create referenced tables before dependent tables
- Use `foreignId()` and `foreignIdFor()` for type consistency
- Verify table names match between migration and database
- Test migrations in clean database environment

**THIS IS A CRITICAL DATABASE INTEGRITY RULE**
