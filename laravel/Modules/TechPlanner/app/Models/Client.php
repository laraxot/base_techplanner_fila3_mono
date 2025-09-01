<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Geo\Models\Traits\GeographicalScopes;

/**
 * Class Client.
 *
 * @property int $id
 * @property string $name
 * @property string|null $vat_number
 * @property string|null $fiscal_code
 * @property string|null $address
 * @property string|null $city
 * @property string|null $postal_code
 * @property string|null $province
 * @property string|null $country
 * @property string|null $phone
 * @property string|null $email
 */
class Client extends BaseModel
{
    use GeographicalScopes;

    protected $fillable = [
        'name',
        'vat_number',
        'fiscal_code',
        'address',
        'city',
        'postal_code',
        'province',
        'country',
        'phone',
        'email',
        // ----------
        'business_closed',                // cessato
        'company_name',               // ditta
        'competent_health_unit', // az_ulss_competente
        'tax_code',              // cf
        'vat_number',            // partita_iva
        'address',               // indirizzo
        'province',              // provincia
        'postal_code',           // cap
        'phone',                 // telefono
        'fax',                   // fax
        'mobile',                // cellulare
        'email',                 // email
        'pec',
        'whatsapp',
        'notes',                 // note
        'activity',              // attivita
        'longitude',
        'latitude',
    ];

    public function getFullAddressAttribute(?string $value): string
    {
        if ($value !== null) {
            return $value;
        }
        $address = sprintf(
            '%s, %s, %s (%s)',
            $this->address,
            $this->postal_code,
            $this->city,
            $this->province
        );

        return $address;
    }

    /**
     * Relazione con le chiamate telefoniche.
     */
    public function phoneCalls(): HasMany
    {
        return $this->hasMany(PhoneCall::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Relazione con le chiamate telefoniche.
     */
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    public function legalRepresentatives(): HasMany
    {
        return $this->hasMany(LegalRepresentative::class);
    }

    public function legalOffices(): HasMany
    {
        return $this->hasMany(LegalOffice::class);
    }

    public function medicalDirectors(): HasMany
    {
        return $this->hasMany(MedicalDirector::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'business_closed' => 'boolean',
            'longitude' => 'float',
            'latitude' => 'float',
        ];
    }

    /**
     * Genera HTML per i contatti con icone e link.
     */
    public function getContactsHtmlAttribute(): string
    {
        $contacts = [];

        if ($this->phone) {
            $contacts[] = $this->formatContactLink(
                'phone',
                $this->phone,
                'heroicon-o-phone',
                'text-blue-600 hover:text-blue-800',
                'Chiama: '.$this->phone
            );
        }

        if ($this->mobile) {
            $contacts[] = $this->formatContactLink(
                'mobile',
                $this->mobile,
                'heroicon-o-device-phone-mobile',
                'text-blue-500 hover:text-blue-700',
                'Chiama cellulare: '.$this->mobile
            );
        }

        if ($this->email) {
            $contacts[] = $this->formatContactLink(
                'email',
                $this->email,
                'heroicon-o-envelope',
                'text-green-600 hover:text-green-800',
                'Email: '.$this->email
            );
        }

        if ($this->pec) {
            $contacts[] = $this->formatContactLink(
                'pec',
                $this->pec,
                'heroicon-o-shield-check',
                'text-purple-600 hover:text-purple-800',
                'PEC: '.$this->pec
            );
        }

        if ($this->whatsapp) {
            $contacts[] = $this->formatContactLink(
                'whatsapp',
                $this->whatsapp,
                'heroicon-o-chat-bubble-left-right',
                'text-green-500 hover:text-green-700',
                'WhatsApp: '.$this->whatsapp
            );
        }

        if (empty($contacts)) {
            return '<span class="text-gray-400 text-sm italic">Nessun contatto</span>';
        }

        return '<div class="flex flex-wrap gap-2">'.implode('', $contacts).'</div>';
    }

    /**
     * Formatta un singolo link di contatto.
     */
    private function formatContactLink(string $type, string $value, string $icon, string $classes, string $title): string
    {
        $href = $this->getContactHref($type, $value);
        $displayValue = $this->getContactDisplayValue($type, $value);
        $iconSvg = $this->getHeroIcon($icon);

        return sprintf(
            '<a href="%s" class="inline-flex items-center gap-1 %s transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 rounded" title="%s" aria-label="%s">%s<span class="text-xs hidden sm:inline">%s</span></a>',
            htmlspecialchars($href, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($classes, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($title, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($title, ENT_QUOTES, 'UTF-8'),
            $iconSvg,
            htmlspecialchars($displayValue, ENT_QUOTES, 'UTF-8')
        );
    }

    /**
     * Genera l'href appropriato per il tipo di contatto.
     */
    private function getContactHref(string $type, string $value): string
    {
        return match ($type) {
            'phone', 'mobile' => 'tel:'.preg_replace('/[^+\d]/', '', $value),
            'email', 'pec' => 'mailto:'.$value,
            'whatsapp' => 'https://wa.me/'.preg_replace('/[^+\d]/', '', $value),
            default => '#'
        };
    }

    /**
     * Genera il valore display per il tipo di contatto.
     */
    private function getContactDisplayValue(string $type, string $value): string
    {
        return match ($type) {
            'phone', 'mobile' => $this->formatPhoneNumber($value),
            'email', 'pec' => strlen($value) > 20 ? substr($value, 0, 17).'...' : $value,
            'whatsapp' => 'WhatsApp',
            default => $value
        };
    }

    /**
     * Formatta un numero di telefono per la visualizzazione.
     */
    private function formatPhoneNumber(string $phone): string
    {
        // Rimuove tutti i caratteri non numerici eccetto il +
        $clean = preg_replace('/[^+\d]/', '', $phone);

        // Formattazione italiana standard
        if (preg_match('/^\+39(\d{10})$/', $clean, $matches)) {
            $number = $matches[1];

            return '+39 '.substr($number, 0, 3).' '.substr($number, 3, 3).' '.substr($number, 6);
        }

        return $phone;
    }

    /**
     * Genera SVG per icona Heroicon.
     */
    private function getHeroIcon(string $iconName): string
    {
        $icons = [
            'heroicon-o-phone' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>',
            'heroicon-o-device-phone-mobile' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a1 1 0 001-1V4a1 1 0 00-1-1H8a1 1 0 00-1 1v16a1 1 0 001 1z"></path></svg>',
            'heroicon-o-envelope' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>',
            'heroicon-o-shield-check' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>',
            'heroicon-o-chat-bubble-left-right' => '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>',
        ];

        return $icons[$iconName] ?? '';
    }
}
