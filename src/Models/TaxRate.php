<?php

namespace Branzia\Tax\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class TaxRate extends Model
{
    protected $table = 'tax_rates';

    protected $fillable = [
        'tax_class_id',
        'country_code',
        'state_code',
        'rate',
    ];

    public $timestamps = true;

    /**
     * Get the tax class associated with the rate.
     */
    public function taxClass(): BelongsTo
    {
        return $this->belongsTo(TaxClass::class);
    }
    public function formattedRate(): string 
    {
        return number_format($this->rate, 2) . '%';
    }
}
