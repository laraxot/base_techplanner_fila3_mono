# CRITICAL RULE: No Case-Only Variations in Class Names

## ABSOLUTE PROHIBITION

**NEVER create multiple classes where names differ only by case (uppercase/lowercase).**

## Examples of FORBIDDEN Case Variations

- ❌ `TimeclockWidget` and `TimeClockWidget`
- ❌ `UserService` and `userService`
- ❌ `DataModel` and `dataModel`
- ❌ `ApiController` and `APIController`

## WHY THIS RULE EXISTS

1. **Developer Confusion**: Impossible to distinguish between similar names
2. **Maintenance Nightmare**: Updates applied to wrong class
3. **File System Issues**: Case-insensitive systems create conflicts
4. **Code Clarity**: Violates unambiguous naming principles
5. **IDE Problems**: Auto-completion becomes unreliable
6. **Refactoring Dangers**: Search/replace operations become hazardous
7. **Team Collaboration**: Creates cognitive overhead

## ENFORCEMENT STRATEGY

- Immediate consolidation of case-only variations
- Choose most descriptive English name
- Merge functionality into single class
- Update all references and imports
- Remove duplicate files completely
- Document unified class purpose

## DETECTION AND PREVENTION

- Review all class names in modules for case variations
- Use consistent PascalCase for all class names
- Ensure each class has distinct, meaningful name
- Never create classes that differ only by case

## CONSOLIDATION PROCESS

1. Identify case-only variations
2. Choose best name (English, descriptive)
3. Merge functionality
4. Update all references
5. Remove duplicate files
6. Update documentation
7. Test all functionality

**THIS IS A FUNDAMENTAL CODE QUALITY RULE**
