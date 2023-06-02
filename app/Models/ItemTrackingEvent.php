<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ItemTrackingEvent extends Model
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
        'occurred_at' => 'datetime'
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope('latestEventsFirst', function (Builder $builder) {
            $builder->latest('occurred_at');
        });
    }

    /**
     * Get the tracking event's location (formatted with commas).
     */
    protected function location(): Attribute
    {
        return Attribute::make(
            get: function(mixed $value, array $attrs) {
                $location_data = Arr::only($attrs, ['location_municipality', 'location_region', 'location_country']);
                $location_data = Arr::whereNotNull($location_data); // Region can be null :)
                $location = Arr::join($location_data, ', ');

                return str($location)->upper();
            }
        );
    }

    /**
     * Get the tracking event's details.
     */
    protected function details(): Attribute
    {
        return Attribute::make(
            get: fn (string $details) => str($details)->upper(),
        );
    }
}
