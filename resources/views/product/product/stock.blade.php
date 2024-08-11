@extends('layouts.master')

@section('title') {{ @$title }} @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Utilizatori @endslot
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

    <form action="{{ route('product.update-stock',$product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <h5 class="card-header bg-transparent border-bottom text-uppercase">Actualizae stock</h5>
                    <div class="card-body">



                        <div class="row mb-4">
                            <label for="code" class="col-form-label col-lg-2">Cod</label>
                            <div class="col-lg-10">
                                <input id="code" name="code" type="text" value="{{ old('code',$productCategory->code) }}" class="form-control @error('code') is-invalid @enderror">
                                @error('code')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="code" class="col-form-label col-lg-2">EAN</label>
                            <div class="col-lg-10">
                                <input id="code" name="code" type="text" value="{{ old('code',$productCategory->code) }}" class="form-control @error('code') is-invalid @enderror">
                                @error('code')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="name" class="col-form-label col-lg-2">Nume</label>
                            <div class="col-lg-10">
                                <input id="name" name="name" type="text" value="{{ old('name',$productCategory->name) }}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="name" class="col-form-label col-lg-2">Stock</label>
                            <div class="col-lg-10">
                                <input id="name" name="name" type="text" value="{{ old('name',$productCategory->name) }}" class="form-control @error('name') is-invalid @enderror">
                                @error('name')
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
                    <a href="{{ route('product-category.index') }}" class="btn btn-secondary waves-effect waves-light"><i class="mdi mdi-close-circle-outline font-size-16 align-middle me-2"></i> Renunta</a>
                </div>
            </div>
        </div>
    </form>

@endsection

