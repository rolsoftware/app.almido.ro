@extends('layouts.master')

@section('title') @lang('translation.Dashboards') @endsection


@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Permisiuni @endslot
        @slot('title') Afisare @endslot
    @endcomponent

    @include('layouts.alert')
    
    <div class="row">
        <div class="col-lg-3">
            @can('app:permission-create')
                <a  class="btn btn-success btn-rounded btn-label waves-effect waves-light mb-2 me-2" href="{{ route('permission.create') }}"  title="Adauga"><i class="bx bx-plus label-icon"></i> Adauga</a>
            @endcan
        </div>
        <div class="col-lg-6  text-center font-size-20">
            <h2 class="mb-4">Lista permisiuni</h2>
        </div>
        <div class="col-sm-3 float-right">
            <div class="text-sm-end">
                <div class="btn-group" role="group">
                    {{-- <a  class="btn btn-success btn-rounded font-size-14" href="{{ route('rol.export') }}"  title="Export"><i class="mdi mdi-file-excel-outline"></i></a> --}}
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
                        <table class="table align-middle table-nowrap table-hover table-striped">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th scope="col" style="width: 70px;">#</th>
                                    <th scope="col">Nume</th>
                                    <th scope="col">Nume gardian</th>
                                    <th scope="col">Data</th>
                                    <th scope="col" class="text-center">Actiune</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $row)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><h5 class="font-size-14 mb-1"><a href="#" class="text-dark">{{ $row->name }}</a></h5></td>
                                        <td>{{ $row->guard_name }}</td>
                                        <td>{{ $row->created_at }}</td>
                                        <td  class="text-center">
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                @can('app:permission-edit')
                                                    <li class="list-inline-item"><a href="{{ route('permission.edit',$row) }}" title="Edit"><i class="text-success bx bx-edit-alt"></i></a></li>
                                                @endcan

                                                @can('app:permission-delete')
                                                    <li class="list-inline-item">
                                                        <a href="" title="Sterge"><i class="text-danger delete-confirm bx bx-trash" data-id="{{ $row->id }}"></i></a>
                                                        <form id="delete-form-{{ $row->id }}" action="{{ route('permission.destroy',$row) }}" method="POST" class="d-none">
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


