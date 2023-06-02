<?php

namespace App\Models;

use App\Enums\{ItemShipmentType, ItemStatus};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'shipment_type' => ItemShipmentType::class,
        'status' => ItemStatus::class,

        'weight' => 'decimal:8',

        'shipped_on' => 'date',
        'created_at' => 'datetime'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'sender',
        'receiver',
        'events'
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        // When an item is deleted also delete it's associated Sender
        // and Receiver address models.
        static::deleted(function (Item $item) {
            $item->sender->delete();
            $item->receiver->delete();
        });
    }

    /**
     * Get the item's weight converted to pounds and ounces and returned as an array.
     */
    protected function weight(): Attribute
    {
        return Attribute::make(
            get: function(float $weight) {
                $pounds = floor($weight); // Extract the whole number of pounds
                $ounces = round(($weight - $pounds) * 16); // Calculate the remaining ounces

                return ['pounds' => (int) $pounds, 'ounces' => (int) $ounces];
            }
        );
    }

    /**
     * Scope a query to get the item by it's tracking number.
     */
    public function scopeByTrackingNumber(Builder $query, string $tracking_number): void
    {
        $query->where('tracking_number', $tracking_number);
    }

    /**
     * Get the sender associated with the item.
     */
    public function sender(): HasOne
    {
        return $this->hasOne(ItemAddress::class, 'id', 'sender_address_id');
    }

    /**
     * Get the receiver associated with the item.
     */
    public function receiver(): HasOne
    {
        return $this->hasOne(ItemAddress::class, 'id', 'receiver_address_id');
    }

    /**
     * Get the tracking events for the item.
     */
    public function events(): HasMany
    {
        return $this->hasMany(ItemTrackingEvent::class);
    }
}
