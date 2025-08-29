# Employee Module Language Standards - Internal Rules

## Critical Rule: Language File Structure

### ALWAYS Use Expanded Structure
- **Fields**: MUST include `label`, `placeholder`, `help`, `tooltip`, `description`
- **Actions**: MUST include `label`, `success`, `error`, `confirmation`, `tooltip`, `modal_heading`, `modal_description`
- **Sections**: MUST include `heading`, `description`, `subtitle`, `collapsible`, `collapsed`
- **Tabs**: MUST include `label`, `description`, `icon`
- **Status**: MUST include `label`, `description`, `color`, `icon`

### NEVER Use Simplified Structure
```php
// ❌ FORBIDDEN
'field_name' => 'Simple Label'

// ✅ MANDATORY
'field_name' => [
    'label' => 'Field Label',
    'placeholder' => 'Enter value...',
    'help' => 'Help text for the field',
    'tooltip' => 'Tooltip text',
    'description' => 'Detailed description'
]
```

## File Organization

### Required Files
- `Modules/Employee/lang/it/{model}.php` - Italian translations
- `Modules/Employee/lang/en/{model}.php` - English translations
- `Modules/Employee/docs/language_best_practices.md` - Module documentation
- `docs/employee_language_standards.md` - Root documentation

### File Structure
```php
<?php

declare(strict_types=1);

return [
    'navigation' => [...],
    'resource' => [...],
    'fields' => [...],
    'actions' => [...],
    'sections' => [...],
    'filters' => [...],
    'tabs' => [...],
    'pages' => [...],
    'widgets' => [...],
    'status' => [...],
    'messages' => [...],
    'summary' => [...],
    'quick_actions' => [...],
];
```

## Translation Keys

### Navigation
- `navigation.label` - Main navigation label
- `navigation.group` - Navigation group
- `navigation.icon` - Heroicon name
- `navigation.sort` - Sort order

### Resource
- `resource.label` - Resource label
- `resource.plural_label` - Plural form
- `resource.navigation_label` - Navigation label
- `resource.description` - Resource description

### Fields
- `fields.{field_name}.label` - Field label
- `fields.{field_name}.placeholder` - Placeholder text
- `fields.{field_name}.help` - Help text below field
- `fields.{field_name}.tooltip` - Tooltip text
- `fields.{field_name}.description` - Detailed description
- `fields.{field_name}.options` - Select options (if applicable)

### Actions
- `actions.{action_name}.label` - Action button text
- `actions.{action_name}.success` - Success message
- `actions.{action_name}.error` - Error message
- `actions.{action_name}.confirmation` - Confirmation message
- `actions.{action_name}.tooltip` - Action tooltip
- `actions.{action_name}.modal_heading` - Modal title
- `actions.{action_name}.modal_description` - Modal description

### Sections
- `sections.{section_name}.heading` - Section heading
- `sections.{section_name}.description` - Section description
- `sections.{section_name}.subtitle` - Section subtitle
- `sections.{section_name}.collapsible` - Whether collapsible
- `sections.{section_name}.collapsed` - Default collapsed state

### Filters
- `filters.{filter_name}.label` - Filter label
- `filters.{filter_name}.placeholder` - Filter placeholder
- `filters.{filter_name}.help` - Filter help text

### Tabs
- `tabs.{tab_name}.label` - Tab label
- `tabs.{tab_name}.description` - Tab description
- `tabs.{tab_name}.icon` - Tab icon

### Pages
- `pages.{page_name}.title` - Page title
- `pages.{page_name}.subtitle` - Page subtitle
- `pages.{page_name}.heading` - Page heading
- `pages.{page_name}.description` - Page description
- `pages.{page_name}.welcome_message` - Welcome message
- `pages.{page_name}.instructions` - Instructions text
- `pages.{page_name}.success_message` - Success message
- `pages.{page_name}.empty_state` - Empty state message
- `pages.{page_name}.loading_message` - Loading message

### Widgets
- `widgets.{widget_name}.title` - Widget title
- `widgets.{widget_name}.description` - Widget description
- `widgets.{widget_name}.{stat_name}.label` - Stat label
- `widgets.{widget_name}.{stat_name}.description` - Stat description
- `widgets.{widget_name}.{stat_name}.tooltip` - Stat tooltip
- `widgets.{widget_name}.empty_state` - Empty state
- `widgets.{widget_name}.view_all` - View all text
- `widgets.{widget_name}.refresh` - Refresh text

### Status
- `status.{status_name}.label` - Status label
- `status.{status_name}.description` - Status description
- `status.{status_name}.color` - Status color
- `status.{status_name}.icon` - Status icon

### Messages
- `messages.validation.{rule_name}` - Validation error message
- `messages.success.{action_name}` - Success message
- `messages.error.{error_type}` - Error message
- `messages.empty_states.{state_name}` - Empty state message
- `messages.confirmations.{action_name}` - Confirmation message

### Summary
- `summary.{item_name}.label` - Summary item label
- `summary.{item_name}.description` - Summary item description
- `summary.{item_name}.tooltip` - Summary item tooltip

### Quick Actions
- `quick_actions.title` - Quick actions title
- `quick_actions.description` - Quick actions description
- `quick_actions.{action_name}.label` - Action label
- `quick_actions.{action_name}.description` - Action description
- `quick_actions.{action_name}.tooltip` - Action tooltip

## Quality Standards

### Language Quality
- **Professional**: Use professional but understandable language
- **Consistent**: Maintain consistent terminology across all files
- **Complete**: Include all required keys for each section
- **Contextual**: Provide meaningful help text and descriptions

### Technical Quality
- **Syntax**: Always use `declare(strict_types=1);`
- **Structure**: Use short array syntax `[]` instead of `array()`
- **Organization**: Group related keys logically
- **Documentation**: Document any special requirements

### Validation
- **PHP Syntax**: Use `php -l` to validate syntax
- **Structure**: Verify all required keys are present
- **Consistency**: Check terminology consistency
- **Completeness**: Ensure no missing translations

## Implementation Checklist

### Before Creating Language Files
- [ ] Study existing language files in other modules
- [ ] Understand the model structure and fields
- [ ] Plan the translation key hierarchy
- [ ] Document special requirements

### During Creation
- [ ] Use expanded structure for all sections
- [ ] Include all required keys
- [ ] Provide meaningful help text
- [ ] Use consistent terminology
- [ ] Follow naming conventions

### After Creation
- [ ] Validate PHP syntax with `php -l`
- [ ] Check structure completeness
- [ ] Verify terminology consistency
- [ ] Update module documentation
- [ ] Update root documentation

## Common Patterns

### Field with Options
```php
'status' => [
    'label' => 'Status',
    'placeholder' => 'Select status',
    'help' => 'Current status of the record',
    'tooltip' => 'Status information',
    'description' => 'Current status of the record',
    'options' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
        'pending' => 'Pending',
    ],
],
```

### Action with Modal
```php
'delete' => [
    'label' => 'Delete',
    'success' => 'Record deleted successfully',
    'error' => 'Unable to delete record',
    'confirmation' => 'Are you sure you want to delete this record?',
    'tooltip' => 'Delete this record',
    'modal_heading' => 'Confirm Deletion',
    'modal_description' => 'This action cannot be undone',
],
```

### Section with Collapse
```php
'details' => [
    'heading' => 'Record Details',
    'description' => 'Basic information about the record',
    'subtitle' => 'Fill in the required information',
    'collapsible' => true,
    'collapsed' => false,
],
```

## Error Prevention

### Common Mistakes
1. **Missing Keys**: Always include all required keys
2. **Inconsistent Structure**: Use same structure for similar items
3. **Poor Help Text**: Provide meaningful help text
4. **Missing Tooltips**: Include tooltips for better UX
5. **Incomplete Descriptions**: Add detailed descriptions

### Validation Rules
- Every field must have `label`, `placeholder`, `help`, `tooltip`, `description`
- Every action must have `label`, `success`, `error`, `confirmation`, `tooltip`, `modal_heading`, `modal_description`
- Every section must have `heading`, `description`, `subtitle`, `collapsible`, `collapsed`
- Every tab must have `label`, `description`, `icon`
- Every status must have `label`, `description`, `color`, `icon`

## Documentation Requirements

### Module Documentation
- Update `Modules/Employee/docs/language_best_practices.md`
- Include examples of translation structure
- Document any special requirements
- Link to root documentation

### Root Documentation
- Update `docs/employee_language_standards.md`
- Include complete standards
- Provide implementation examples
- Link to module documentation

### Cross-References
- Create bidirectional links between module and root docs
- Reference related documentation
- Include examples and best practices
- Document common patterns

---

**CRITICAL**: Always use expanded structure for language files. Never use simplified structure. Maintain high quality and consistency across all translations.
