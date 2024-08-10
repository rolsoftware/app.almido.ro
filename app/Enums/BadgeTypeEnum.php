<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;
use Illuminate\Support\Str;

/**
 * @method static static String()
 * @method static static Interger()
 * @method static static Date()
 * @method static static Array()
 * @method static static Email()
 */
final class BadgeTypeEnum extends Enum
{
    const None              = 0;

    const NormalPrimary     = 11;
    const NormalSuccess     = 12;
    const NormalInfo        = 13;
    const NormalWarnning    = 14;
    const NormalDanger      = 15;
    const NormalDark        = 16;

    const SoftPrimary       = 21;
    const SoftSuccess       = 22;
    const SoftInfo          = 23;
    const SoftWarnning      = 24;
    const SoftDanger        = 25;
    const SoftDark          = 26;

    public function badge($value = ""){
        
        if(empty($value)) $value = $this->description;

        $html = $this->value;
        
        # frendlly name
        if (ctype_upper(preg_replace('/[^a-zA-Z]/', '', $value))) {
            $value = strtolower($value);
        }

        $value =  ucfirst(str_replace('_', ' ', Str::snake($value)));

        switch ($this->value) {
            case '11':
                $html = '<span class="badge bg-primary">'.$value.'</span>';
                break;
            case '12':
                $html = '<span class="badge bg-success">'.$value.'</span>';
                break;
            case '13':
                $html = '<span class="badge bg-info">'.$value.'</span>';
                break;
            case '14':
                $html = '<span class="badge bg-warning">'.$value.'</span>';
                break;
            case '15':
                $html = '<span class="badge bg-danger">'.$value.'</span>';
                break;
            case '16':
                $html = '<span class="badge bg-dark">'.$value.'</span>';
                break;

            case '21':
                $html = '<span class="badge badge-soft-primary">'.$value.'</span>';
                break;
            case '22':
                $html = '<span class="badge badge-soft-success">'.$value.'</span>';
                break;
            case '23':
                $html = '<span class="badge badge-soft-info">'.$value.'</span>';
                break;
            case '24':
                $html = '<span class="badge badge-soft-warning">'.$value.'</span>';
                break;
            case '25':
                $html = '<span class="badge badge-soft-danger">'.$value.'</span>';
                break;
            case '26':
                $html = '<span class="badge badge-soft-dark">'.$value.'</span>';
                break;
            default:
                $html = $this->value;
                break;
        }

        return $html;
    }
}
