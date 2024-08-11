@extends('layouts.master')

@section('title')  {{ @$title }}  @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Produse @endslot
        @slot('title') Afisare @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-lg-3">
            @can('product:product-create')
                <a  class="btn btn-success btn-rounded btn-label waves-effect waves-light mb-2 me-2" href="{{ route('product.create') }}"  title="Adauga"><i class="bx bx-plus label-icon"></i> Adauga</a>
            @endcan
        </div>
        <div class="col-lg-6  text-center font-size-20">
            <h2 class="mb-4">{{ $title }}</h2>
        </div>
        <div class="col-sm-3 float-right">
            <div class="text-sm-end">
                <div class="btn-group" role="group">
                    {{-- <a  class="btn btn-success btn-rounded font-size-14" href="{{ route('product-product.export') }}"  title="Export"><i class="mdi mdi-file-excel-outline"></i></a> --}}
                    <a  class="btn btn-success btn-rounded right-bar-toggle font-size-14" href="#"  title="Filtrare"><i class="mdi mdi-filter"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th></th>
                                    <th>Informatii produs</th>
                                    <th>Pret Vanzare</th>
                                    <th>Stoc</th>
                                    <th>Valore stoc</th>
                                    <th>Actiuni</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $row)
                                    <tr class="product">
                                        <td><img src="{{ $row->first_image }}" alt="product-img" title="{{ $row->images->first()->name ?? "xxx" }}" class="avatar-md" /></td>
                                        <td>
                                            <h5 class="font-size-14 text-wrap"><a href="ecommerce-product-detail" class="text-dark">{{ $row->name }}</a></h5>
                                            <p class="mb-0">Brand : <span class="fw-medium">{{ $row->brand }}</span></p>
                                        </td>
                                        <td><span class="product-price">{{ $row->price }} RON</span></td>
                                        <td>{{ $row->stock }}</td>
                                        <td><span class="product-line-price">{{ round(($row->price * $row->stock),2) }} RON</span></td>
                                        <td>
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                <li class="list-inline-item"><a href="{{ route('product.edit',$row->id) }}" title="Actualizare stock"><i class="text-success bx bx-edit-alt"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $rows->withQueryString()->links('layouts.pagination') }}
                </div>
            </div>
        </div>
    </div>

@endsection


