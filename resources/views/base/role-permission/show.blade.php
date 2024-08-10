@extends('layouts.master')

@section('title') Permisiuni @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Roluri @endslot
        @slot('title') Permisiuni @endslot
    @endcomponent
    
    <div class="row">
        <div class="col-lg-12  text-center font-size-20">
            <h2 class="mb-4">Seteaza permisiuni pentru role-ul {{ $role->name }}</h2>
        </div>
    </div>

    <div class="row">
        @foreach($permissions_list AS $name => $permission)
            @livewire('base.role-permission', ['role'=>$role, 'permission' => $permission, 'name'=>$name], key($name))
        @endforeach
    </div>

@endsection
@section('script')
@endsection
