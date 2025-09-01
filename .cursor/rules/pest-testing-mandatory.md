# CRITICAL RULE: Mandatory Pest Testing Without RefreshDatabase

## ABSOLUTE REQUIREMENTS

**ALWAYS use Pest testing framework and NEVER use RefreshDatabase trait.**

## Pest Testing Requirements

### Framework
- Use Pest instead of PHPUnit class-based tests
- Use functional syntax with `it()` and `test()` functions
- Organize tests in logical groups with `describe()` blocks
- NEVER use `RefreshDatabase` trait

### Forbidden Patterns
- ❌ `use RefreshDatabase;` trait in any test
- ❌ PHPUnit class-based test structure
- ❌ `class SomeTest extends TestCase`
- ❌ `public function test_something(): void`

### Correct Pest Patterns
- ✅ `it('can perform some action', function () { ... });`
- ✅ `test('some functionality', function () { ... });`
- ✅ `describe('Feature Group', function () { ... });`
- ✅ Use factories and seeders without database refresh

## Why This Rule Exists

1. **Performance**: RefreshDatabase is slow and memory-intensive
2. **Pest Benefits**: More readable, concise test syntax
3. **Maintenance**: Easier to maintain functional tests
4. **Consistency**: Uniform testing approach across all modules
5. **Memory Issues**: RefreshDatabase can cause memory leaks in large test suites

## Alternative Database Strategies

- Use database transactions
- Use factories for test data
- Use in-memory testing databases
- Use seeders for consistent test data
- Mock external dependencies

## Enforcement Strategy

- Convert all existing PHPUnit tests to Pest
- Remove all RefreshDatabase usage
- Update test documentation
- Create Pest-specific testing guidelines

**THIS IS A FUNDAMENTAL TESTING QUALITY RULE**
