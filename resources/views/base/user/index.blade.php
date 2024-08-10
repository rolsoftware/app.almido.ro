@extends('layouts.master')

@section('title') Utilizatori @endsection

@section('content')

    @component('components.breadcrumb')
        @slot('li_1') Utilizatori @endslot
        @slot('title') Afisare @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-lg-3">
            @can('app:user-create')
                <a  class="btn btn-success btn-rounded btn-label waves-effect waves-light mb-2 me-2" href="{{ route('user.create') }}"  title="Adauga"><i class="bx bx-plus label-icon"></i> Adauga</a>
            @endcan
        </div>
        <div class="col-lg-6  text-center font-size-20">
            <h2 class="mb-4">Lista utilizatori</h2>
        </div>
        <div class="col-sm-3 float-right">
            <div class="text-sm-end">
                <div class="btn-group" role="group">
                    <a  class="btn btn-success btn-rounded font-size-14" href="{{ route('user.export') }}"  title="Export"><i class="mdi mdi-file-excel-outline"></i></a>
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
                                    <th scope="col">Utilizator</th>
                                    <th scope="col">Nume</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roluri</th>
                                    <th scope="col">Adaugat la</th>
                                    <th scope="col">Ultima logare</th>
                                    <th scope="col">IP</th>
                                    <th scope="col" class="text-center">Actiune</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $row)
                                    <tr class="text-center">
                                        <td>
                                            <div class="d-none">{{ ($rows->currentpage()-1) * $rows->perpage() + $loop->index + 1 }}</div>
                                            <div class="avatar-xs img-fluid rounded-circle"><div class="avatar-title rounded-circle text-uppercase">{{ $row->shortname }}</div></div>
                                        </td>
                                        <td><a href="#" class="text-dark">{{ $row->username }}</a></td>
                                        <td><a href="#" class="text-dark">{{ $row->name }}</a></td>
                                        <td>{{ $row->email }}</td>
                                        <td>
                                            @if(!empty($row->getRoleNames()))
                                                @foreach($row->getRoleNames() as $v)
                                                    <label class="badge bg-info font-size-11 m-1">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ date('d M, Y', strtotime($row->created_at)); }}</td>
                                        <td>
                                            @if(empty($row->last_login_at))
                                                <span class="badge bg-warning font-size-11">Nu s-a logat</span>
                                            @else
                                                {{ date('d M, Y H:i', strtotime($row->last_login_at)); }}
                                            @endif
                                        <td>{{ $row->last_login_ip ?? ""}}</td>

                                        <td  class="text-center">

                                            <ul class="list-inline font-size-20 contact-links mb-0">

                                                @can('app:user-create')
                                                    <li class="list-inline-item">
                                                        <a href="{{ route('user.password',['user'=>$row]) }}" title="Restare parola"><i class="text-primary bx bx-key"></i></a>
                                                    </li>
                                                @endcan

                                                @can('app:user-edit')
                                                    <li class="list-inline-item"><a href="{{ route('user.edit',$row->id) }}" title="Editeaza"><i class="text-success bx bx-edit-alt"></i></a></li>
                                                @endcan

                                                @if($row->active == 'Yes')
                                                    @can('app:user-delete')
                                                        @if($row->id != $system['user']->id)
                                                            <li class="list-inline-item">
                                                                <a href="" title="Sterge"><i class="delete-confirm text-danger bx bx-trash" data-id="{{ $row->id }}"></i></a>
                                                                <form id="delete-form-{{ $row->id }}" action="{{ route('user.destroy',$row->id) }}" method="POST" class="d-none">
                                                                    @csrf
                                                                    @method('delete')
                                                                </form>
                                                            </li>
                                                        @endif
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


