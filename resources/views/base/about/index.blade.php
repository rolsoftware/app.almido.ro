@extends('layouts.master')

@section('title') About @endsection


@section('content')

    @component('components.breadcrumb')
        @slot('li_1') About @endslot
        @slot('title') Afiseaza @endslot
    @endcomponent

    @include('layouts.alert')

    <div class="row">
        <div class="col-lg-12 text-center">
            <h2 class="mb-4">About</h2>
        </div>
    </div>

    <div class="row">
        @foreach ($rows as $category => $row)
            <div class="col-lg-4 mb-5">
                <div class="card h-100">
                    <div class="card-header bg-transparent border-bottom text-uppercase text-center">
                        <h4 class="card-title"> {{ ucfirst(str_replace("_"," ",$category))  }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                    @foreach ($row as $key => $value)
                                        <tr>
                                            <th scope="row">{{ ucfirst(str_replace("_"," ",$key)) }} :</th>
                                            <td class="text-end">
                                                @if(is_array($value))
                                                    @foreach ($value as $k => $v)
                                                        <span class="badge bg-primary">{{ $v }}</span>
                                                    @endforeach
                                                @else
                                                    {{ $value }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection

