<?php

use Illuminate\Support\Facades\Facade;

return [

    'aliases' => Facade::defaultAliases()->merge([
        'Datatables' => Yajra\Datatables\Facades\Datatables::class,
    ])->toArray(),

];
