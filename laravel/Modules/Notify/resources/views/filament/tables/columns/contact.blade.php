{{--
/**
 * Template ViewColumn per contatti modulo Notify
 * 
 * Visualizza:
 * - Nome completo (first_name + last_name)
 * - Tipo contatto con icona (email, phone, mobile_phone, whatsapp, telegram, sms)
 * - Stato verifica (verified_at)
 * - Statistiche invio (sms_count, mail_count)
 * 
 * @var \Modules\Notify\Models\Contact $record
 */
--}}

@php
    $record = $getRecord();
    $hasContacts = $record->value || $record->email || $record->mobile_phone;
@endphp

<div class="flex flex-col space-y-1">
    {{-- Nome completo --}}
    @if($record->first_name || $record->last_name)
        <div class="font-medium text-gray-900">
            {{ trim($record->first_name . ' ' . $record->last_name) }}
        </div>
    @endif
    
    {{-- Contatti usando contact_types se disponibile --}}
    @if(isset($contact_types))
        @foreach($contact_types as $contact_type)
            @php
                $contact_value = $record->{$contact_type->value};
            @endphp
            @if($contact_value)
                <div class="flex items-center space-x-2">
                    <x-filament::icon
                        :icon="$contact_type->getIcon()"
                        :label="$contact_type->getLabel()"
                        :color="$contact_type->getColor()"
                        class="w-4 h-4 flex-shrink-0"
                    />
                    <span class="text-sm font-medium">{{ $contact_value }}</span>
                </div>    
            @endif    
        @endforeach
    @else
        {{-- Fallback: Contatto con icona usando logica tradizionale --}}
        @if($hasContacts)
            @php
                $contactType = $record->contact_type ?? 'unknown';
                $value = $record->value ?? $record->email ?? $record->mobile_phone;
                
                $iconClass = match($contactType) {
                    'email' => 'heroicon-o-envelope',
                    'phone' => 'heroicon-o-phone',
                    'mobile' => 'heroicon-o-phone',
                    'mobile_phone' => 'heroicon-o-device-phone-mobile',
                    'whatsapp' => 'heroicon-o-chat-bubble-left-right',
                    'telegram' => 'heroicon-o-chat-bubble-left-right',
                    'sms' => 'heroicon-o-chat-bubble-left-right',
                    default => 'heroicon-o-user',
                };
                
                $colorClass = match($contactType) {
                    'email' => 'text-blue-600',
                    'phone' => 'text-green-600',
                    'mobile' => 'text-green-600',
                    'mobile_phone' => 'text-purple-600',
                    'whatsapp' => 'text-green-600',
                    'telegram' => 'text-blue-500',
                    'sms' => 'text-orange-600',
                    default => 'text-gray-600',
                };
                
                $href = match($contactType) {
                    'email' => 'mailto:' . $value,
                    'phone', 'mobile', 'mobile_phone' => 'tel:' . $value,
                    'whatsapp' => 'https://wa.me/' . preg_replace('/[^0-9+]/', '', $value),
                    default => null,
                };
            @endphp
            
            <div class="flex items-center text-sm {{ $colorClass }}">
                @if($href)
                    <a href="{{ $href }}" class="flex items-center hover:underline" 
                       @if($contactType === 'whatsapp') target="_blank" rel="noopener" @endif>
                        <x-dynamic-component :component="$iconClass" class="w-4 h-4 mr-1 flex-shrink-0" />
                        <span class="truncate">{{ $value }}</span>
                    </a>
                @else
                    <div class="flex items-center">
                        <x-dynamic-component :component="$iconClass" class="w-4 h-4 mr-1 flex-shrink-0" />
                        <span class="truncate">{{ $value }}</span>
                    </div>
                @endif
            </div>
        @endif
    @endif
    
    {{-- Stato verifica --}}
    @if($record->verified_at)
        <div class="text-green-600 text-xs flex items-center">
            <x-heroicon-o-check-circle class="w-3 h-3 mr-1" />
            <span>Verificato {{ $record->verified_at->format('d/m/Y') }}</span>
        </div>
    @endif
    
    {{-- Statistiche invio --}}
    @if($record->sms_count > 0 || $record->mail_count > 0)
        <div class="flex gap-2 text-xs">
            @if($record->sms_count > 0)
                <span class="text-blue-600 flex items-center">
                    <x-heroicon-o-chat-bubble-left-right class="w-3 h-3 mr-1" />
                    {{ $record->sms_count }} SMS
                </span>
            @endif
            
            @if($record->mail_count > 0)
                <span class="text-green-600 flex items-center">
                    <x-heroicon-o-envelope class="w-3 h-3 mr-1" />
                    {{ $record->mail_count }} Email
                </span>
            @endif
        </div>
    @endif
    
    {{-- Stato vuoto --}}
    @if(!$hasContacts && !$record->first_name && !$record->last_name)
        <span class="text-gray-400 text-xs italic">Nessun contatto</span>
    @endif
</div>
