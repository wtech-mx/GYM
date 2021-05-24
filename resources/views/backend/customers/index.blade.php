@extends('layouts.backend.app')

@section('title', 'Customers')

    @push('css')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    @endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Clientes</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('app.customers.create') }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        Nuevo Cliente
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nombre</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Unido en</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $key => $customers)
                                <tr>
                                    <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $customers->username }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $customers->email }}</td>
                                    <td class="text-center">{{ $customers->joining_date }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-secondary btn-sm"
                                            href="{{ route('app.customers.show', $customers->id) }}"><i
                                                class="fas fa-eye"></i>
                                            <span>Show</span>
                                        </a>
                                        <a class="btn btn-info btn-sm"
                                            href="{{ route('app.customers.edit', $customers->id) }}"><i
                                                class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a type="button" class="btn btn-danger btn-sm text-white" data-toggle="modal"
                                            data-target="#modal-{{ $customers->id }}">
                                            <span>Eliminar</span>
                                        </a>
                                    </td>
                                </tr>
                                @include('backend.customers.destroy')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Datatable
            $("#datatable").DataTable();
        });

    </script>
@endpush
