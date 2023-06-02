<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemAddress extends Model
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
     * Get the address formatted for display.
     */
    protected function address(): Attribute
    {
        return Attribute::make(
            get: function(mixed $value, array $attrs) {
                unset($attrs['id']);
                extract($attrs); // Extract the rest of the model attributes to variables

                $address = <<<END
                $name
                $street\n
                END;

                if ($region && $postal_code) {
                    $address .= "$municipality, $region $postal_code, $country";

                } elseif ($postal_code) {
                    $address .= "$municipality, $postal_code, $country";

                } elseif ($region) {
                    $address .= "$municipality, $region, $country";

                } else {
                    $address .= "$municipality, $country";
                }

                return $address;
            }
        );
    }
}
