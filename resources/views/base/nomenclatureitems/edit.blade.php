@extends('layouts.master')

@section('title')@endsection

@section('css')

@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Menu @endslot
        @slot('title') Editeaza @endslot
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

    <form action="{{ route('nomenclatureitems.update',$nomenclatureitem) }}" method="POST">
        @csrf
        @method('PUT')  

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <h5 class="card-header bg-transparent border-bottom text-uppercase">Modifica</h5>
                    <div class="card-body">
                        
                        <input type="hidden" name="nomenclature_id" value="{{ $nomenclatureitem->nomenclature_id }}" class="form-control">

                        <div class="row mb-4">
                            <label for="name" class="col-form-label col-lg-2">Nomenclator</label>
                            <div class="col-lg-10">
                                <input name="nomenclator" type="text" value="{{ $nomenclatureitem->nomenclature->name }}" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="key" class="col-form-label col-lg-2">Key</label>
                            <div class="col-lg-10">
                                <input id="key" name="key" type="text" value="{{ old('key',$nomenclatureitem->key) }}" class="form-control @error('key') is-invalid @enderror" >
                                @error('key')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="value" class="col-form-label col-lg-2">Valoare</label>
                            <div class="col-lg-10">
                                <input id="value" name="value" type="text" value="{{ old('value',$nomenclatureitem->value) }}" class="form-control @error('value') is-invalid @enderror" >
                                @error('value')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="color" class="col-form-label col-lg-2">Badge Type</label>
                            <div class="col-lg-10">
                                <select class="form-control select2 @error('color') is-invalid @enderror" name="color">
                                    @foreach(\App\Enums\BadgeTypeEnum::asSelectArray() as $key => $value)
                                        <option value="{{ $key }}" @if(old('color',$nomenclatureitem->color->value) == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror

                                <div class="mt-1">
                                    <span class="badge bg-primary">Normal Primary</span>
                                    <span class="badge bg-success">Normal Success</span>
                                    <span class="badge bg-info">Normal Info</span>
                                    <span class="badge bg-warning">Normal Warning</span>
                                    <span class="badge bg-danger">Normal Danger</span>
                                    <span class="badge bg-dark">Normal Dark</span>

                                    <span class="badge badge-soft-primary">Soft Primary</span>
                                    <span class="badge badge-soft-success">Soft Success</span>
                                    <span class="badge badge-soft-info">Soft Info</span>
                                    <span class="badge badge-soft-warning">Soft Warning</span>
                                    <span class="badge badge-soft-danger">Soft Danger</span>
                                    <span class="badge badge-soft-dark">Soft Dark</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="active" class="col-form-label col-lg-2">Active</label>
                            <div class="col-lg-10">
                                <select class="form-control select2 @error('active') is-invalid @enderror" name="active">
                                        <option value="Yes" @if(old('active',$nomenclatureitem->active) == 'Yes') selected @endif>Yes</option>
                                        <option value="No" @if(old('active',$nomenclatureitem->active) == 'No') selected @endif>No</option>
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
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
                    <a href="{{ url()->previous() }}" class="btn btn-secondary waves-effect waves-light"><i class="mdi mdi-close-circle-outline font-size-16 align-middle me-2"></i> Renunta</a>
                </div>
            </div>
        </div>
    </form>

@endsection
@section('script')

@endsection
