@extends('layouts.master')

@section('title')  {{ @$title }}  @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Produse / Categorii @endslot
        @slot('title') Afisare @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-lg-3">
            @can('product:category-create')
                <a  class="btn btn-success btn-rounded btn-label waves-effect waves-light mb-2 me-2" href="{{ route('product-category.create') }}"  title="Adauga"><i class="bx bx-plus label-icon"></i> Adauga</a>
            @endcan
        </div>
        <div class="col-lg-6  text-center font-size-20">
            <h2 class="mb-4">{{ $title }}</h2>
        </div>
        <div class="col-sm-3 float-right">
            <div class="text-sm-end">
                <div class="btn-group" role="group">
                    {{-- <a  class="btn btn-success btn-rounded font-size-14" href="{{ route('product-category.export') }}"  title="Export"><i class="mdi mdi-file-excel-outline"></i></a> --}}
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
                        <table class="table align-middle table-nowrap table-hover">
                            <thead class="table-light text-center">
                                <tr>
                                    <th scope="col" class="text-left">#</th>
                                    <th scope="col">Cod</th>
                                    <th scope="col">Nume</th>
                                    <th scope="col">Descriere</th>
                                    <th scope="col">Produse</th>
                                    <th scope="col" class="text-center">Actiune</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $row)
                                    <tr class="text-center">
                                        <td>
                                            {{ ($rows->currentpage()-1) * $rows->perpage() + $loop->index + 1 }}
                                        </td>
                                        <td><a href="#" class="text-dark">{{ $row->code }}</a></td>
                                        <td><a href="#" class="text-dark">{{ $row->name }}</a></td>
                                        <td>{{ $row->description }}</td>
                                        <td>0</td>
                                        <td  class="text-center">
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                @can('product:category-edit')
                                                    <li class="list-inline-item"><a href="{{ route('product-category.edit',$row->id) }}" title="Editeaza"><i class="text-success bx bx-edit-alt"></i></a></li>
                                                @endcan

                                                @can('product:category-delete')
                                                    <li class="list-inline-item">
                                                        <a href="" title="Sterge"><i class="delete-confirm text-danger bx bx-trash" data-id="{{ $row->id }}"></i></a>
                                                        <form id="delete-form-{{ $row->id }}" action="{{ route('product-category.destroy',$row->id) }}" method="POST" class="d-none">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </li>
                                                @endcan

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


