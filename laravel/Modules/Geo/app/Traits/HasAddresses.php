<?php

declare(strict_types=1);

namespace Modules\Geo\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Geo\Enums\AddressTypeEnum;
use Modules\Geo\Models\Address;

/**
 * Trait HasAddresses
 * 
 * Questo trait fornisce funzionalità per gestire indirizzi multipli su qualsiasi modello.
 */
trait HasAddresses
{
    /**
     * Relazione a tutti gli indirizzi.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'model');
    }

    /**
     * Relazione all'indirizzo principale.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function primaryAddress(): MorphOne
    {
        return $this->morphOne(Address::class, 'model')
            ->where('is_primary', true);
    }

    /**
     * Relazione all'indirizzo di casa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function homeAddress(): MorphOne
    {
        return $this->morphOne(Address::class, 'model')
            ->where('type', AddressTypeEnum::HOME->value);
    }

    /**
     * Relazione all'indirizzo di lavoro.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function workAddress(): MorphOne
    {
        return $this->morphOne(Address::class, 'model')
            ->where('type', AddressTypeEnum::WORK->value);
    }

    /**
     * Relazione all'indirizzo di fatturazione.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function billingAddress(): MorphOne
    {
        return $this->morphOne(Address::class, 'model')
            ->where('type', AddressTypeEnum::BILLING->value);
    }

    /**
     * Relazione all'indirizzo di spedizione.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function shippingAddress(): MorphOne
    {
        return $this->morphOne(Address::class, 'model')
            ->where('type', AddressTypeEnum::SHIPPING->value);
    }

    /**
     * Imposta un indirizzo come principale.
     *
     * @param \Modules\Geo\Models\Address $address
     * @return void
     */
    public function setPrimaryAddress(Address $address): void
    {
        // Assicurati che l'indirizzo appartenga a questo modello
        if ($address->model_id !== $this->id || $address->model_type !== get_class($this)) {
            throw new \InvalidArgumentException('L\'indirizzo non appartiene a questo modello.');
        }

        // Rimuovi lo stato primario da tutti gli altri indirizzi
        $this->addresses()->update(['is_primary' => false]);

        // Imposta questo indirizzo come primario
        $address->is_primary = true;
        $address->save();
    }

    /**
     * Aggiunge un nuovo indirizzo.
     *
     * @param array<string, mixed> $data
     * @param bool $isPrimary
     * @return \Modules\Geo\Models\Address
     */
    public function addAddress(array $data, bool $isPrimary = false): Address
    {
        // Se l'indirizzo deve essere primario, rimuovi lo stato primario dagli altri
        if ($isPrimary) {
            $this->addresses()->update(['is_primary' => false]);
        }

        // Crea il nuovo indirizzo
        $data['is_primary'] = $isPrimary;
        return $this->addresses()->create($data);
    }

    /**
     * Ottiene gli indirizzi per tipo.
     *
     * @param \Modules\Geo\Enums\AddressTypeEnum|string $type
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAddressesByType($type)
    {
        $typeValue = $type instanceof AddressTypeEnum ? $type->value : $type;
        return $this->addresses()->where('type', $typeValue)->get();
    }
}