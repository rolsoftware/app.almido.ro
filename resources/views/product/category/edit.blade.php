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

    <form action="{{ route('user.update',$user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <h5 class="card-header bg-transparent border-bottom text-uppercase">Editeaza</h5>
                    <div class="card-body">

                        <div class="row mb-4">
                            <label for="username" class="col-form-label col-lg-2">Utilizator</label>
                            <div class="col-lg-10">
                                <input id="username" name="username" type="text" value="{{ old('username',$user['username']) }}" class="form-control @error('username') is-invalid @enderror" placeholder="">
                                @error('username')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="name" class="col-form-label col-lg-2">Email</label>
                            <div class="col-lg-10">
                                <input id="email" name="email" type="text" value="{{ old('email',$user['email']) }}" class="form-control @error('email') is-invalid @enderror" placeholder="">
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="name" class="col-form-label col-lg-2">Nume</label>
                            <div class="col-lg-10">
                                <input id="name" name="name" type="text" value="{{ old('name',$user['name']) }}" class="form-control @error('name') is-invalid @enderror" placeholder="">
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="parent_id" class="col-form-label col-lg-2">Rol</label>
                            <div class="col-lg-10">
                                <select class="form-control select2" name="roles[]" multiple>
                                    @foreach ($roles AS $key => $role)
                                        <option value="{{ $key }}" {{ (collect(old('roles',$userRole))->contains($key)) ? 'selected':'' }}>{{ $role }}</option>
                                    @endforeach
                                </select>
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
                    <a href="{{ route('user.index') }}" class="btn btn-secondary waves-effect waves-light"><i class="mdi mdi-close-circle-outline font-size-16 align-middle me-2"></i> Renunta</a>
                </div>
            </div>
        </div>
    </form>

@endsection

