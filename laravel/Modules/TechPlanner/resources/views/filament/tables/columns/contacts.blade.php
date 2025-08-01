{{--
/**
 * Contacts Column View for TechPlanner Client Resource
 * 
 * Displays multiple contact methods (phone, mobile, email, PEC, WhatsApp, fax)
 * with semantic icons and clickable links following AGID accessibility standards.
 * 
 * @var \Modules\TechPlanner\Models\Client $record The client record
 * @var mixed $state The column state (not used, we access record directly)
 */
--}}

@php
    $contacts = [];
    
    // Phone (landline)
    if ($record->phone) {
        $contacts[] = [
            'type' => 'phone',
            'value' => $record->phone,
            'href' => 'tel:' . $record->phone,
            'icon' => 'heroicon-o-phone',
            'color' => 'text-blue-600 hover:text-blue-800',
            'title' => 'Telefono: ' . $record->phone
        ];
    }
    
    // Mobile
    if ($record->mobile) {
        $contacts[] = [
            'type' => 'mobile',
            'value' => $record->mobile,
            'href' => 'tel:' . $record->mobile,
            'icon' => 'heroicon-o-device-phone-mobile',
            'color' => 'text-blue-500 hover:text-blue-700',
            'title' => 'Cellulare: ' . $record->mobile
        ];
    }
    
    // Email
    if ($record->email) {
        $contacts[] = [
            'type' => 'email',
            'value' => $record->email,
            'href' => 'mailto:' . $record->email,
            'icon' => 'heroicon-o-envelope',
            'color' => 'text-green-600 hover:text-green-800',
            'title' => 'Email: ' . $record->email
        ];
    }
    
    // PEC (Certified Email)
    if ($record->pec) {
        $contacts[] = [
            'type' => 'pec',
            'value' => $record->pec,
            'href' => 'mailto:' . $record->pec,
            'icon' => 'heroicon-o-shield-check',
            'color' => 'text-purple-600 hover:text-purple-800',
            'title' => 'PEC: ' . $record->pec
        ];
    }
    
    // WhatsApp
    if ($record->whatsapp) {
        $contacts[] = [
            'type' => 'whatsapp',
            'value' => $record->whatsapp,
            'href' => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $record->whatsapp),
            'icon' => 'heroicon-o-chat-bubble-left-right',
            'color' => 'text-green-500 hover:text-green-700',
            'title' => 'WhatsApp: ' . $record->whatsapp
        ];
    }
    
    // Fax
    if ($record->fax) {
        $contacts[] = [
            'type' => 'fax',
            'value' => $record->fax,
            'href' => null, // Fax is not clickable
            'icon' => 'heroicon-o-printer',
            'color' => 'text-gray-600',
            'title' => 'Fax: ' . $record->fax
        ];
    }
@endphp

@if(empty($contacts))
    <span class="text-gray-400 text-sm italic">Nessun contatto</span>
@else
    <div class="flex flex-wrap gap-2 items-center">
        @foreach($contacts as $contact)
            @if($contact['href'])
                <a 
                    href="{{ $contact['href'] }}" 
                    class="inline-flex items-center {{ $contact['color'] }} transition-colors duration-200 group"
                    title="{{ $contact['title'] }}"
                    @if($contact['type'] === 'whatsapp') target="_blank" rel="noopener noreferrer" @endif
                >
                    @svg($contact['icon'], 'w-4 h-4 flex-shrink-0')
                    <span class="ml-1 text-xs font-medium hidden sm:inline-block group-hover:underline">
                        {{ Str::limit($contact['value'], 15) }}
                    </span>
                </a>
            @else
                {{-- Non-clickable contact (like fax) --}}
                <span 
                    class="inline-flex items-center {{ $contact['color'] }}"
                    title="{{ $contact['title'] }}"
                >
                    @svg($contact['icon'], 'w-4 h-4 flex-shrink-0')
                    <span class="ml-1 text-xs font-medium hidden sm:inline-block">
                        {{ Str::limit($contact['value'], 15) }}
                    </span>
                </span>
            @endif
        @endforeach
    </div>
@endif