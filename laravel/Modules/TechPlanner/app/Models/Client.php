<?php

declare(strict_types=1);

namespace Modules\TechPlanner\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Geo\Models\Traits\HasAddress;
use Modules\Geo\Models\Traits\GeographicalScopes;
use function Safe\preg_replace;
use function Safe\preg_match;

/**
 * Class Client.
 *
 * @property int         $id
 * @property string      $name
 * @property string|null $vat_number
 * @property string|null $client_office
 * @property string|null $fiscal_code
 * @property string|null $address
 * @property string|null $city
 * @property string|null $postal_code
 * @property string|null $province
 * @property string|null $country
 * @property string|null $phone
 * @property string|null $email
 * @property bool        $business_closed
 * @property string|null $company_name
 * @property string|null $competent_health_unit
 * @property string|null $tax_code
 * @property string|null $fax
 * @property string|null $mobile
 * @property string|null $pec
 * @property string|null $whatsapp
 * @property float|null  $latitude
 * @property float|null  $longitude
 * @property int|null    $assigned_worker_id
 * @property string|null $notes
 * @property string|null $administrative_reference
 * @property string|null $route
 * @property string|null $street_number
 * @property string|null $locality
 * @property string|null $sublocality
 * @property string|null $sublocality_level_1
 * @property string|null $sublocality_level_2
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read string $full_address
 * @property-read string $contacts_html
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\TechPlanner\Models\Appointment[] $appointments
 * @property-read int|null $appointments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\TechPlanner\Models\Device[] $devices
 * @property-read int|null $devices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\TechPlanner\Models\LegalOffice[] $legalOffices
 * @property-read int|null $legal_offices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Modules\TechPlanner\Models\LegalRepresentative[] $legalRepresentatives
 * @property-read int|null $legal_representatives_count
 * @property-read \Modules\TechPlanner\Models\Profile|null $creator
 * @property-read \Modules\TechPlanner\Models\Profile|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereAdministrativeReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereAssignedWorkerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereBusinessClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCompetentHealthUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereFax($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereFiscalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereLocality($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client wherePec($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereStreetNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereSublocality($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereSublocalityLevel1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereSublocalityLevel2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereTaxCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereVatNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereWhatsapp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client withDistance(float $latitude, float $longitude)
 * @mixin \Eloquent
 */
class Client extends BaseModel
{
    use GeographicalScopes;
    //use HasAddress;

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
        // Additional fields from business context
        'business_closed',
        'company_name',
        'competent_health_unit',
        'tax_code',
        'fax',
        'mobile',
        'pec',
        'whatsapp',
        'latitude',
        'longitude',
        'assigned_worker_id',
        'notes',
        'administrative_reference',
        'route',
        'street_number',
        'locality',
        'sublocality',
        'sublocality_level_1',
        'sublocality_level_2',
    ];

    public function getFullAddressAttribute(?string $value): string
    {
        if ($value !== null) {
            return $value;
        }
        $address = sprintf(
            '%s, %s - %s, %s (%s)',
            $this->route,
            $this->street_number,
            $this->postal_code,
            $this->city,
            $this->province
        );

        return trim(preg_replace('/[,\s]+/', ' ', $address));
    }

    /**
     * Get the devices for the client.
     */
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    /**
     * Get the appointments for the client.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the legal offices for the client.
     */
    public function legalOffices(): HasMany
    {
        return $this->hasMany(LegalOffice::class);
    }

    /**
     * Get the legal representatives for the client.
     */
    public function legalRepresentatives(): HasMany
    {
        return $this->hasMany(LegalRepresentative::class);
    }

    /**
     * Get the medical directors for the client.
     */
    public function medicalDirectors(): HasMany
    {
        return $this->hasMany(MedicalDirector::class);
    }

    public function phoneCalls(): HasMany
    {
        return $this->hasMany(PhoneCall::class);
    }

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'business_closed' => 'boolean',
            'longitude' => 'float',
            'latitude' => 'float',
        ];
    }

    /**
     * Genera HTML per i contatti con icone e link.
     *
     * @return string
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
                'Chiama: ' . $this->phone
            );
        }
        
        if ($this->mobile) {
            $contacts[] = $this->formatContactLink(
                'mobile',
                $this->mobile,
                'heroicon-o-device-phone-mobile',
                'text-blue-500 hover:text-blue-700',
                'Chiama cellulare: ' . $this->mobile
            );
        }
        
        if ($this->email) {
            $contacts[] = $this->formatContactLink(
                'email',
                $this->email,
                'heroicon-o-envelope',
                'text-green-600 hover:text-green-800',
                'Email: ' . $this->email
            );
        }
        
        if ($this->pec) {
            $contacts[] = $this->formatContactLink(
                'pec',
                $this->pec,
                'heroicon-o-shield-check',
                'text-purple-600 hover:text-purple-800',
                'PEC: ' . $this->pec
            );
        }
        
        if ($this->whatsapp) {
            $contacts[] = $this->formatContactLink(
                'whatsapp',
                $this->whatsapp,
                'heroicon-o-chat-bubble-left-right',
                'text-green-500 hover:text-green-700',
                'WhatsApp: ' . $this->whatsapp
            );
        }
        
        if (empty($contacts)) {
            return '<span class="text-gray-400 text-sm italic">Nessun contatto</span>';
        }
        
        return '<div class="flex flex-wrap gap-2">' . implode('', $contacts) . '</div>';
    }

    /**
     * Formatta un singolo link di contatto.
     *
     * @param string $type
     * @param string $value
     * @param string $icon
     * @param string $classes
     * @param string $title
     * @return string
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
     *
     * @param string $type
     * @param string $value
     * @return string
     */
    private function getContactHref(string $type, string $value): string
    {
        return match($type) {
            'phone', 'mobile' => 'tel:' . preg_replace('/[^+\d]/', '', $value),
            'email', 'pec' => 'mailto:' . $value,
            'whatsapp' => 'https://wa.me/' . preg_replace('/[^+\d]/', '', $value),
            default => '#'
        };
    }

    /**
     * Genera il valore display per il tipo di contatto.
     *
     * @param string $type
     * @param string $value
     * @return string
     */
    private function getContactDisplayValue(string $type, string $value): string
    {
        return match($type) {
            'phone', 'mobile' => $this->formatPhoneNumber($value),
            'email', 'pec' => strlen($value) > 20 ? substr($value, 0, 17) . '...' : $value,
            'whatsapp' => 'WhatsApp',
            default => $value
        };
    }

    /**
     * Formatta un numero di telefono per la visualizzazione.
     *
     * @param string $phone
     * @return string
     */
    private function formatPhoneNumber(string $phone): string
    {
        // Rimuove tutti i caratteri non numerici eccetto il +
        $clean = preg_replace('/[^+\d]/', '', $phone);
        
        // Formattazione italiana standard
        if (preg_match('/^\+39(\d{10})$/', $clean, $matches)) {
            $number = $matches[1];
            return '+39 ' . substr($number, 0, 3) . ' ' . substr($number, 3, 3) . ' ' . substr($number, 6);
        }
        
        return $phone;
    }

    /**
     * Genera SVG per icona Heroicon.
     *
     * @param string $iconName
     * @return string
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