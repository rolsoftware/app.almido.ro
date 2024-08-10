@extends('layouts.master')

@section('title') @lang('translation.Dashboards') @endsection


@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Nomenclatoare @endslot
        @slot('title') Afiseaza @endslot
    @endcomponent
    
    @include('layouts.alert')

    <div class="row">
        <div class="col-lg-3">
            @can('app:nomenclature-create')
                <a  class="btn btn-success btn-rounded btn-label waves-effect waves-light mb-2 me-2" href="{{ route('nomenclatureitems.create',['nomenclature_id'=>$nomenclature_id]) }}"  title="Adauga"><i class="bx bx-plus label-icon"></i> Adauga</a>
            @endcan
        </div>
        <div class="col-lg-6  text-center">
            <h2 class="mb-4">Lista elemente nomenclatoar</h2>
        </div>
        <div class="col-lg-3"></div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap table-hover table-striped text-center">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>
                                    <th scope="col">Key</th>
                                    <th scope="col">Valoare</th>
                                    <th scope="col">Badge</th>
                                    <th scope="col">Active</th>
                                    <th scope="col" class="text-center">Actiune</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($nomenclature)
                                    @foreach ($nomenclature->items as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><h5 class="font-size-14 mb-1"><a href="#" class="text-dark">{{ $row->key }}</a></h5></td>
                                            <td>{{ $row->value }}</td>
                                            <td>{!! $row->color->badge() !!}</td>
                                            <td>{{ $row->active }}</td>

                                            <td  class="text-center">
                                                <ul class="list-inline font-size-20 contact-links mb-0">

                                                    @can('app:nomenclature-edit')
                                                        <li class="list-inline-item"><a href="{{ route('nomenclatureitems.edit',$row) }}" title="Editeaza"><i class="text-success bx bx-edit-alt"></i></a></li>
                                                    @endcan

                                                    @if($row->active == "Yes")
                                                        @can('app:nomenclature-delete')
                                                            <li class="list-inline-item">
                                                                <a href="" title="Sterge"><i class="delete-confirm text-danger bx bx-trash" data-id="{{ $row->id }}"></i></a>
                                                                <form id="delete-form-{{ $row->id }}" action="{{ route('nomenclatureitems.destroy',$row) }}" method="POST" class="d-none">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </li>
                                                        @endcan
                                                    @endif
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    {{-- {{ $rows->withQueryString()->links('layouts.pagination') }} --}}
                </div>
            </div>
        </div>
    </div>

@endsection

