@extends('layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('css')

@endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Vars @endslot
        @slot('title') View @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-lg-3">
            @can('app:var-create')
                <a  class="btn btn-success btn-rounded btn-label waves-effect waves-light mb-2 me-2" href="{{ route('var.create') }}"  title="Adauga"><i class="bx bx-plus label-icon"></i> Adauga</a>
            @endcan
        </div>
        <div class="col-lg-6  text-center font-size-20">
            <h2 class="mb-4">Lista utilizatori</h2>
        </div>
        <div class="col-sm-3 float-right">
            <div class="text-sm-end">
                <div class="btn-group" role="group">
                    {{-- <a  class="btn btn-success btn-rounded font-size-14" href="{{ route('user.export') }}"  title="Export"><i class="mdi mdi-file-excel-outline"></i></a> --}}
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
                        <table class="table align-middle table-nowrap table-hover text-center">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width: 70px;">#</th>
                                    <th scope="col">Denumire</th>
                                    <th scope="col">Valoare</th>
                                    <th scope="col">Tip</th>
                                    <th scope="col">Descriere</th>
                                    <th scope="col">Adaugat de & la data</th>
                                    <th scope="col" class="text-center">Actiune</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><h5 class="font-size-14 mb-1"><a href="{{ route('var.show',$row) }}" class="text-dark">{{ $row->key }}</a></h5></td>
                                        <td>{{ $row->value }}</td>
                                        <td>{{ $row->type->description }}</td>
                                        <td>{{ $row->description }}</td>
                                        <td>{{ $row->user->name }} @ {{ $row->created_at }}</td>
                                        <td  class="text-center">
                                            <ul class="list-inline font-size-20 contact-links mb-0">
                                                @can('app:var-edit')
                                                    <li class="list-inline-item"><a href="{{ route('var.edit',$row->id) }}" title="Edit"><i class="bx bx-edit-alt text-success"></i></a></li>
                                                @endcan

                                                @can('app:var-delete')
                                                    <li class="list-inline-item">
                                                        <a href="" title="Sterge"><i class="delete-confirm bx bx-trash text-danger" data-id="{{ $row->id }}"></i></a>
                                                        <form id="delete-form-{{ $row->id }}" action="{{ route('var.destroy',$row->id) }}" method="POST" class="d-none">
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

@section('script')

    <script>
        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            var id = $(this).data("id");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                cancelButtonText: 'Cancel',
              }).then(function (result) {
                if (result.value) {
                    $('#delete-form-'+id).submit();
                }
            });
        });
    </script>
@endsection

