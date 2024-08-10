@extends('layouts.master')

@section('title')@endsection

@section('css')

@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Variabile @endslot
        @slot('title') Modifica @endslot
    @endcomponent
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('var.update',$var->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <h5 class="card-header bg-transparent border-bottom text-uppercase">Modifica variabila</h5>
                    <div class="card-body">

                        <div class="row mb-4">
                            <label for="type" class="col-form-label col-lg-2">Tip</label>
                            <div class="col-lg-10">
                                <select class="form-control select2 @error('type') is-invalid @enderror" name="type">
                                    @foreach(\App\Enums\VarsTypeEnum::asSelectArray() as $key => $value)
                                        <option value="{{ $key }}" @if(old('type',$var->type->value) == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="key" class="col-form-label col-lg-2">Denumire</label>
                            <div class="col-lg-10">
                                <input id="key" name="key" type="text" value="{{ old('key',$var->key) }}" class="form-control @error('key') is-invalid @enderror" placeholder="">
                                @error('key')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="value" class="col-form-label col-lg-2">Valoare</label>
                            <div class="col-lg-10">
                                <input id="value" name="value" type="text" value="{{ old('value',$var->value) }}" class="form-control @error('value') is-invalid @enderror" placeholder="">
                                @error('value')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="description" class="col-form-label col-lg-2">Descriere</label>
                            <div class="col-lg-10">
                                <input id="description" name="description" type="text" value="{{ old('description',$var->description) }}" class="form-control @error('description') is-invalid @enderror" placeholder="">
                                @error('description')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="is_public" class="col-form-label col-lg-2"></label>
                            <div class="col-lg-10">
                                <div class="form-check form-checkbox-outline form-check-primary mb-3">
                                    <input class="form-check-input" type="checkbox" id="is_public" name="is_public" value="1" @if(old('is_public',$var->is_public) == 1) checked="" @endif>
                                    <label class="form-check-label" for="is_public">Este publica</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-sm-3">
                <button type="submit" class="btn btn-success waves-effect waves-light"><i class="bx bx-save font-size-16 align-middle me-2"></i> Salveaza</button>
            </div>
            <div class="col-sm-9">
                <div class="text-sm-end">
                    <a href="{{ route('var.index') }}" class="btn btn-secondary waves-effect waves-light"><i class="mdi mdi-close-circle-outline font-size-16 align-middle me-2"></i> Renunta</a>
                </div>
            </div>
        </div>
    </form>

@endsection