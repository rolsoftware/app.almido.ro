<?php

namespace App\Models;

use App\Enums\VarsTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vars extends Model
{
    use HasFactory;
    protected $table = 'vars';
    
    protected $fillable = [
        'user_id',
        'type',
        'key',
        'value',
        'description',
        'active',
        'is_public'
    ];

    protected $casts = [
        'type' => VarsTypeEnum::class,
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    static function get(string $key, $default = null)
    {
        $model = self::where('key', $key)->first();
        if (empty($model)) {
            if (empty($default)) {
                throw new \Exception('Cannot find setting: '.$key);
            }else{
                return $default;
            }
        }else{
            return $model->value;
        }

    }
}
