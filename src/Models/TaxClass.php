<?php

namespace Branzia\Tax\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class TaxClass extends Model
{
    protected $table = 'tax_classes';

    protected $fillable = [
        'name',
        'type',
    ];

    // Optional: Add scopes or constants if needed
    public const TYPE_PRODUCT = 'product';
    public const TYPE_CUSTOMER = 'customer';

    public $timestamps = true;

    public static function types(): array
    {
        return [
            self::TYPE_PRODUCT => 'Product',
            self::TYPE_CUSTOMER => 'Customer',
        ];
    }

    public function taxRates():HasMany
    {
        return $this->hasMany(TaxRate::class);
    }
}
