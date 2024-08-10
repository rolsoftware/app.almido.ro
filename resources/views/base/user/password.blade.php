@extends('layouts.master')

@section('title') {{ @$title }} @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Utilizatori @endslot
        @slot('title') Schimba parola @endslot
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

    <form action="{{ route('user.updatePassword',$user) }}" method="POST">
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
                                <input id="username" name="username" type="text" value="{{ old('username',$user['username']) }}" class="form-control @error('username') is-invalid @enderror" disabled>
                                @error('username')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password" class="col-form-label col-lg-2">Parola</label>
                            <div class="col-lg-10">
                                <input id="password" name="password" type="password" value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror" placeholder="">
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="confirm_password" class="col-form-label col-lg-2">Confirmare parola</label>
                            <div class="col-lg-10">
                                <input id="confirm_password" name="confirm_password" type="password" value="{{ old('confirm_password') }}" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="">
                                @error('confirm_password')
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
                    <a href="{{ route('user.index') }}" class="btn btn-secondary waves-effect waves-light"><i class="mdi mdi-close-circle-outline font-size-16 align-middle me-2"></i> Renunta</a>
                </div>
            </div>
        </div>
    </form>

@endsection
