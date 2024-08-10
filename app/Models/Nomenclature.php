<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nomenclature extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'active'];
    
    public function items()
    {
        return $this->hasMany(NomenclatureItems::class);
    }
}
