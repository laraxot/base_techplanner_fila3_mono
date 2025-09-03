{{-- 
/**
 * Badge Component - Bootstrap Italia Compliant
 * 
 * Small counters and labels component
 * Sizes automatically adapt to the font size of the containing element
 * 
 * @param string $variant Badge color variant (primary, secondary, success, danger, warning, info, light, dark)
 * @param bool $pill Whether to render as a pill (rounded) badge
 * @param string $tag HTML tag to use (span or a for links)
 * @param string $href URL for link badges (when tag is 'a')
 * @param string $srText Screen reader text for context
 * @param bool $asLink Shorthand to render as link
 */
--}}

@props([
    'variant' => 'secondary',
    'pill' => false,
    'tag' => 'span',
    'href' => '#',
    'srText' => '',
    'asLink' => false
])

@php
    $baseClasses = collect(['badge']);
    
    // Add background variant class
    $baseClasses->push("bg-{$variant}");
    
    // Add pill class if needed
    if ($pill) {
        $baseClasses->push('rounded-pill');
    }
    
    // Determine tag
    $tagName = $asLink ? 'a' : $tag;
    
    // Build final classes
    $classes = $baseClasses->implode(' ');
@endphp

<{{ $tagName }} 
    {{ $attributes->merge(['class' => $classes]) }}
    @if($tagName === 'a') href="{{ $href }}" @endif
    @if($tagName === 'span') role="status" @endif
>
    {{ $slot }}
    
    @if($srText)
        <span class="visually-hidden">{{ $srText }}</span>
    @endif
</{{ $tagName }}>

{{-- 
Usage Examples:

1. Basic badge:
<x-pub_theme::bootstrap-italia.badge>New</x-pub_theme::bootstrap-italia.badge>

2. Contextual variants:
<x-pub_theme::bootstrap-italia.badge variant="primary">Primary</x-pub_theme::bootstrap-italia.badge>
<x-pub_theme::bootstrap-italia.badge variant="secondary">Secondary</x-pub_theme::bootstrap-italia.badge>
<x-pub_theme::bootstrap-italia.badge variant="success">Success</x-pub_theme::bootstrap-italia.badge>
<x-pub_theme::bootstrap-italia.badge variant="danger">Danger</x-pub_theme::bootstrap-italia.badge>
<x-pub_theme::bootstrap-italia.badge variant="warning">Warning</x-pub_theme::bootstrap-italia.badge>

3. Pill badges:
<x-pub_theme::bootstrap-italia.badge :pill="true" variant="primary">Rounded</x-pub_theme::bootstrap-italia.badge>

4. Link badges:
<x-pub_theme::bootstrap-italia.badge :as-link="true" href="/notifications" variant="primary">
    Notifications
</x-pub_theme::bootstrap-italia.badge>

5. Badges in headings (auto-sizing):
<h1>Example heading <x-pub_theme::bootstrap-italia.badge>New</x-pub_theme::bootstrap-italia.badge></h1>

6. Badges in buttons with counter:
<button type="button" class="btn btn-primary">
    Notifiche 
    <x-pub_theme::bootstrap-italia.badge variant="light" class="text-secondary" sr-text="Messaggi non letti">
        4
    </x-pub_theme::bootstrap-italia.badge>
</button>

7. Accessible badge with screen reader text:
<x-pub_theme::bootstrap-italia.badge variant="primary" sr-text="Messaggi non letti">
    9
</x-pub_theme::bootstrap-italia.badge>

Bootstrap Italia Classes Reference:
- .badge: Base badge class
- .bg-primary, .bg-secondary, .bg-success, .bg-danger, .bg-warning: Contextual colors
- .rounded-pill: Makes badges pill-shaped (rounded)
- .visually-hidden: Hides content from visual display but keeps it for screen readers
--}}