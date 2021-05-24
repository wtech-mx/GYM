@extends('layouts.backend.app')

@section('title', 'Customers Details')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Detalles Clientes</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('app.customers.edit', $customers->id) }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-edit fa-w-20"></i>
                        </span>
                        {{ __('Edit') }}
                    </a>
                    <a href="{{ route('app.customers.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        {{ __('Back to list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <div class="main-card card">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <tbody>
                            <tr>
                                <th scope="row">Nombre:</th>
                                <td>{{ $customers->username }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Genero:</th>
                                <td>{{ $customers->gender }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Telefono:</th>
                                <td>{{ $customers->mobile }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Email:</th>
                                <td>{{ $customers->email }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Calle:</th>
                                <td>{{ $customers->streetName }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Estado/Municpio:</th>
                                <td>{{ $customers->state }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Ciudad/Delegacion:</th>
                                <td>{{ $customers->city }}</td>
                            </tr>

                            <tr>
                                <th scope="row">CP:</th>
                                <td>{{ $customers->zipcode }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Se unió:</th>

                                <td>{{ $customers->joining_date }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Fecha Nacimiento:</th>
                                <td>{{ $customers->date_birth }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
