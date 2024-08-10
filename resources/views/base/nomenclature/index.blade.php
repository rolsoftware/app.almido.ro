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
                <a  class="btn btn-success btn-rounded btn-label waves-effect waves-light mb-2 me-2" href="{{ route('nomenclature.create') }}"  title="Adauga"><i class="bx bx-plus label-icon"></i> Adauga</a>
            @endcan
        </div>
        <div class="col-lg-6  text-center">
            <h2 class="mb-4">Lista nomenclatoare</h2>
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
                                    <th scope="col">Nume</th>
                                    <th scope="col">Descriere</th>
                                    <th scope="col">Elemente</th>
                                    <th scope="col">Active</th>
                                    <th scope="col" class="text-center">Actiune</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><h5 class="font-size-14 mb-1"><a href="{{ route('nomenclatureitems.index',['nomenclature_id'=>$row->id]) }}" class="text-dark">{{ $row->name }}</a></h5></td>
                                        <td>{{ $row->description }}</td>
                                        <td>{{ $row->items->count() }}</td>
                                        <td>{{ $row->active }}</td>

                                        <td  class="text-center">
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                @can('app:nomenclature-list')
                                                    <li class="list-inline-item"><a href="{{ route('nomenclatureitems.index',['nomenclature_id'=>$row->id]) }}" title="Elemente"><i class="text-primary bx bx-dots-horizontal-rounded"></i></a></li>
                                                @endcan

                                                @can('app:nomenclature-edit')
                                                    <li class="list-inline-item"><a href="{{ route('nomenclature.edit',$row) }}" title="Editeaza"><i class="text-success bx bx-edit-alt"></i></a></li>
                                                @endcan

                                                @if($row->active == "Yes")
                                                    @can('app:nomenclature-delete')
                                                        <li class="list-inline-item">
                                                            <a href="" title="Sterge"><i class="delete-confirm text-danger bx bx-trash" data-id="{{ $row->id }}"></i></a>
                                                            <form id="delete-form-{{ $row->id }}" action="{{ route('nomenclature.destroy',$row) }}" method="POST" class="d-none">
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
                            </tbody>
                        </table>
                    </div>
                    
                    {{ $rows->withQueryString()->links('layouts.pagination') }}
                </div>
            </div>
        </div>
    </div>

@endsection

