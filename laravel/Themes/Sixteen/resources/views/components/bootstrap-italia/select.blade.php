{{-- 
/**
 * Select Component - Bootstrap Italia Compliant
 * 
 * Classic "dropdown menu" select component
 * Wrapped in .select-wrapper with proper label association
 * 
 * @param string $id Unique ID for the select element
 * @param string $name Form field name
 * @param string $label Label text for the select
 * @param array $options Array of options [value => label] or [['value' => '', 'label' => '', 'selected' => false]]
 * @param array $optgroups Array of optgroups [['label' => '', 'options' => [...]]]
 * @param string $placeholder Default option text (default: "Scegli un'opzione")
 * @param string $selected Currently selected value
 * @param bool $disabled Whether the select is disabled
 * @param bool $required Whether the select is required
 * @param bool $multiple Whether multiple selection is allowed
 * @param string $helpText Optional help text
 */
--}}

@props([
    'id' => 'select-' . uniqid(),
    'name' => '',
    'label' => '',
    'options' => [],
    'optgroups' => [],
    'placeholder' => "Scegli un'opzione",
    'selected' => '',
    'disabled' => false,
    'required' => false,
    'multiple' => false,
    'helpText' => ''
])

<div class="select-wrapper">
    @if($label)
        <label for="{{ $id }}">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    
    <select 
        {{ $attributes->merge([
            'id' => $id,
            'name' => $name ?: $id,
            'class' => 'form-select'
        ]) }}
        @if($disabled) disabled @endif
        @if($required) required @endif
        @if($multiple) multiple @endif
        aria-describedby="{{ $helpText ? $id . '-help' : '' }}"
    >
        @if($placeholder && !$multiple)
            <option value="" {{ empty($selected) ? 'selected' : '' }}>
                {{ $placeholder }}
            </option>
        @endif
        
        @if(!empty($optgroups))
            {{-- Render optgroups --}}
            @foreach($optgroups as $optgroup)
                <optgroup label="{{ $optgroup['label'] }}">
                    @foreach($optgroup['options'] as $value => $option)
                        @php
                            if (is_array($option)) {
                                $optionValue = $option['value'];
                                $optionLabel = $option['label'];
                                $isSelected = $option['selected'] ?? ($optionValue == $selected);
                            } else {
                                $optionValue = $value;
                                $optionLabel = $option;
                                $isSelected = ($optionValue == $selected);
                            }
                        @endphp
                        <option value="{{ $optionValue }}" {{ $isSelected ? 'selected' : '' }}>
                            {{ $optionLabel }}
                        </option>
                    @endforeach
                </optgroup>
            @endforeach
        @else
            {{-- Render regular options --}}
            @foreach($options as $value => $option)
                @php
                    if (is_array($option)) {
                        $optionValue = $option['value'];
                        $optionLabel = $option['label'];
                        $isSelected = $option['selected'] ?? ($optionValue == $selected);
                    } else {
                        $optionValue = $value;
                        $optionLabel = $option;
                        $isSelected = ($optionValue == $selected);
                    }
                @endphp
                <option value="{{ $optionValue }}" {{ $isSelected ? 'selected' : '' }}>
                    {{ $optionLabel }}
                </option>
            @endforeach
        @endif
        
        {{ $slot }}
    </select>
    
    @if($helpText)
        <div id="{{ $id }}-help" class="form-text">
            {{ $helpText }}
        </div>
    @endif
</div>

{{-- 
Usage Examples:

1. Basic select:
<x-pub_theme::bootstrap-italia.select 
<x-pub_theme::bootstrap-italia.select 
=======
<x-pub_theme::bootstrap-italia.select 
    id="defaultSelect"
    label="Etichetta"
    :options="[
        'Value 1' => 'Opzione 1',
        'Value 2' => 'Opzione 2', 
        'Value 3' => 'Opzione 3',
        'Value 4' => 'Opzione 4',
        'Value 5' => 'Opzione 5'
    ]" />

2. Select with custom placeholder:
<x-pub_theme::bootstrap-italia.select 
<x-pub_theme::bootstrap-italia.select 
=======
<x-pub_theme::bootstrap-italia.select 
    label="Seleziona categoria"
    placeholder="Seleziona una categoria"
    :options="['cat1' => 'Categoria 1', 'cat2' => 'Categoria 2']" />

3. Disabled select:
<x-pub_theme::bootstrap-italia.select 
<x-pub_theme::bootstrap-italia.select 
=======
<x-pub_theme::bootstrap-italia.select 
    label="Etichetta"
    :disabled="true"
    :options="['Value 1' => 'Opzione 1']" />

4. Select with optgroups:
<x-pub_theme::bootstrap-italia.select 
<x-pub_theme::bootstrap-italia.select 
=======
<x-pub_theme::bootstrap-italia.select 
    id="defaultSelectGroup"
    label="Etichetta"
    :optgroups="[
        [
            'label' => 'Gruppo 1',
            'options' => ['1' => 'Opzione 1', '2' => 'Opzione 2']
        ],
        [
            'label' => 'Gruppo 2', 
            'options' => ['3' => 'Opzione 3', '4' => 'Opzione 4']
        ]
    ]" />

5. Required select with help text:
<x-pub_theme::bootstrap-italia.select 
<x-pub_theme::bootstrap-italia.select 
=======
<x-pub_theme::bootstrap-italia.select 
    label="Campo obbligatorio"
    :required="true"
    help-text="Seleziona una delle opzioni disponibili"
    :options="['option1' => 'Prima opzione', 'option2' => 'Seconda opzione']" />

6. Multiple select:
<x-pub_theme::bootstrap-italia.select 
<x-pub_theme::bootstrap-italia.select 
=======
<x-pub_theme::bootstrap-italia.select 
    label="Selezione multipla"
    :multiple="true"
    name="categories[]"
    :options="$categories" />

7. Select with pre-selected value:
<x-pub_theme::bootstrap-italia.select 
<x-pub_theme::bootstrap-italia.select 
=======
<x-pub_theme::bootstrap-italia.select 
    label="Con valore selezionato"
    selected="Value 2"
    :options="[
        'Value 1' => 'Opzione 1',
        'Value 2' => 'Opzione 2',
        'Value 3' => 'Opzione 3'
    ]" />

8. Advanced options array format:
<x-pub_theme::bootstrap-italia.select 
<x-pub_theme::bootstrap-italia.select 
=======
<x-pub_theme::bootstrap-italia.select 
    label="Opzioni avanzate"
    :options="[
        ['value' => 'opt1', 'label' => 'Opzione 1', 'selected' => true],
        ['value' => 'opt2', 'label' => 'Opzione 2', 'selected' => false],
        ['value' => 'opt3', 'label' => 'Opzione 3', 'selected' => false]
    ]" />

Bootstrap Italia Classes Reference:
- .select-wrapper: Container wrapper for select and label
- .form-select: Bootstrap select styling
- .form-text: Help text styling
- .text-danger: Required field indicator
--}}
