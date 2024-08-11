@extends('layouts.master')

@section('title') {{ $title }} @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Produse / Categorii @endslot
        @slot('title') Adauga @endslot
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

    <form action="{{ route('product-category.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <h5 class="card-header bg-transparent border-bottom text-uppercase">Date</h5>
                    <div class="card-body">

                        <div class="row mb-4">
                            <label for="parent_id" class="col-form-label col-lg-2">Parinte</label>
                            <div class="col-lg-10">
                                <select class="form-control select2 @error('parent_id') is-invalid @enderror" name="parent_id" >
                                    <option value="0">/</option>
                                    @foreach($category_list AS $key => $category)
                                            <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected':'' }}>{{ $category->name }} ({{ $category->code }})</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="code" class="col-form-label col-lg-2">Cod</label>
                            <div class="col-lg-10">
                                <input id="code" name="code" type="text" value="{{ old('code') }}" class="form-control @error('code') is-invalid @enderror" placeholder="">
                                @error('code')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="name" class="col-form-label col-lg-2">Nume</label>
                            <div class="col-lg-10">
                                <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="">
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="description" class="col-form-label col-lg-2">Descriere</label>
                            <div class="col-lg-10">
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description')  }}</textarea>
                                @error('description')
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
                <button type="submit" class="btn btn-success waves-effect waves-light"><i class="bx bx-plus font-size-16 align-middle me-2"></i> Adauga</button>
            </div>
            <div class="col-sm-9">
                <div class="text-sm-end">
                    <a href="{{ route('product-category.index') }}" class="btn btn-secondary waves-effect waves-light"><i class="mdi mdi-close-circle-outline font-size-16 align-middle me-2"></i> Renunta</a>
                </div>
            </div>
        </div>
    </form>

@endsection

