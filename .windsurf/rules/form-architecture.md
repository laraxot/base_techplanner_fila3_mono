---
trigger: manual
description:
globs:
---
# Form Architecture Rule

## Description
All forms in the system must be implemented using Filament widgets. No duplicate form logic should exist in Blade views.

## Rationale
- Centralize form logic
- Ensure consistency
- Improve maintainability
- Follow DRY principle

## Examples
```blade
# ❌ Wrong
<div class="form">
    <form>
        <!-- Duplicate form logic -->
    </form>
</div>

# ✅ Correct
@livewire(\Modules\<nome progetto>\Filament\Widgets\Patient\FindDoctorAndAppointmentWidget::class)
```

## Related
- [Form Architecture Documentation](../../docs/standards/form-architecture.md)
- [Filament Widgets Documentation](../../docs/standards/filament-widgets.md)
- [Component Structure Documentation](../../docs/standards/component-structure.md)
