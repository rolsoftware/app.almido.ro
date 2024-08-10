<?php

namespace Modules\Core\Http\Livewire;

use App\Models\Vars;
use Livewire\Component;

class ButttonVerticalMenu extends Component
{
    public function render()
    {
        return view('core::livewire.buttton-vertical-menu');
    }

    public function click()
    {

        $verticalCollpsed = (bool) @Vars::where('key', 'vertical-collpsed')->where('user_id',auth()->user()->id)->first()->value ?? false;
        $newVerticalCollpsed = !$verticalCollpsed;
        Vars::updateOrCreate(
            ['key' => 'vertical-collpsed', 'user_id' => auth()->user()->id],
            ['value' => $newVerticalCollpsed,'type'=>'1']
        );
    }
}
