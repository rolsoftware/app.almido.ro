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

    <form action="{{ route('product.update',$product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <h5 class="card-header bg-transparent border-bottom text-uppercase">Modifica produs</h5>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="name">Nume</label>
                                    <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nume produs" value="{{ old('name',$product->name) }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="brand">Brand</label>
                                    <input id="brand" name="brand" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nume brand" value="{{ old('brand',$product->brand) }}">
                                    @error('brand')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="code">Cod intern</label>
                                    <input id="code" name="code" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Cod intern" value="{{ old('code',$product->code) }}">
                                    @error('code')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ean">EAN</label>
                                    <input id="ean" name="ean" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="EAN" value="{{ old('ean',$product->ean) }}">
                                    @error('ean')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="control-category_id">Categorie</label>
                                    <select class="form-control select2 @error('category_id') is-invalid @enderror" name="category_id" >
                                        <option value="">Alege</option>
                                        @foreach($category_list AS $key => $category)
                                                <option value="{{ $category->id }}" {{ old('category_id',$product->category_id) == $category->id ? 'selected':'' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="price">Pret net</label>
                                    <input id="price" name="price" type="text" class="form-control @error('price') is-invalid @enderror" placeholder="Pret de vanzare fara tva" value="{{ old('price',$product->price) }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="vat">TVA (%)</label>
                                    <input id="vat" name="vat" type="text" class="form-control @error('vat') is-invalid @enderror" placeholder="TVA in procent" value="{{ old('vat',$product->vat) }}">
                                    @error('vat')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="value">Pret brut</label>
                                    <input id="value" name="value" type="text" class="form-control @error('value') is-invalid @enderror" placeholder="Pret de vanzare cu tva" value="{{ old('value',$product->value) }}">
                                    @error('value')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label for="stock">Stoc</label>
                                    <input id="stock" name="stock" type="text" class="form-control @error('stock') is-invalid @enderror" placeholder="Stoc" stock="{{ old('stock',$product->stock) }}">
                                    @error('stock')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
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
                    <a href="{{ route('product.index') }}" class="btn btn-secondary waves-effect waves-light"><i class="mdi mdi-close-circle-outline font-size-16 align-middle me-2"></i> Renunta</a>
                </div>
            </div>
        </div>
    </form>

@endsection

