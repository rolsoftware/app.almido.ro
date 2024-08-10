@extends('layouts.master')

@section('title')@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Variabile @endslot
        @slot('title') Afisare @endslot
    @endcomponent
        
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <h5 class="card-header bg-transparent border-bottom text-uppercase">Date variabila</h5>
                <div class="card-body">

                    <div class="row mb-4">
                        <label for="type" class="col-form-label col-lg-2">Tip</label>
                        <div class="col-lg-10">
                            <input id="key" name="key" type="text" value="{{ $var->type->description }}" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="key" class="col-form-label col-lg-2">Denumire</label>
                        <div class="col-lg-10">
                            <input id="key" name="key" type="text" value="{{ $var->key }}" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="value" class="col-form-label col-lg-2">Valoare</label>
                        <div class="col-lg-10">
                            <input id="value" name="value" type="text" value="{{ $var->value }}" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="description" class="col-form-label col-lg-2">Descriere</label>
                        <div class="col-lg-10">
                            <input id="description" name="description" type="text" value="{{ $var->description }}" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="is_public" class="col-form-label col-lg-2"></label>
                        <div class="col-lg-10">
                            <div class="form-check form-checkbox-outline form-check-primary mb-3">
                                <input class="form-check-input" type="checkbox" id="is_public" name="is_public" value="1" @if($var->is_public == 1) checked="" @endif disabled>
                                <label class="form-check-label" for="is_public">Este publica</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-sm-12">
            <div class="text-sm-end">
                <a href="{{ route('var.index') }}" class="btn btn-secondary waves-effect waves-light"><i class="mdi mdi-close-circle-outline font-size-16 align-middle me-2"></i> Inapoi</a>
            </div>
        </div>
    </div>


@endsection