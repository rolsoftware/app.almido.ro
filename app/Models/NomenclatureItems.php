<?php

namespace App\Models;

use App\Enums\BadgeTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NomenclatureItems extends Model
{
    use HasFactory;

    protected $fillable = ['nomenclature_id', 'key', 'value', 'color', 'active'];
    
    protected $casts = [
        'color' => BadgeTypeEnum::class,
    ];

    public function  nomenclature(): BelongsTo
    {
        return $this->belongsTo(Nomenclature::class);
    }

}
