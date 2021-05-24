@extends('layouts.backend.app')

@section('title', 'Estado de Salud Details')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Detalles Estado de Salud</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('app.health.edit', $health->id) }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-edit fa-w-20"></i>
                        </span>
                        {{ __('Edit') }}
                    </a>
                    <a href="{{ route('app.health.index') }}" class="btn-shadow btn btn-danger">
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
                                <td>{{ $health->Customers->username }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Calorias:</th>
                                <td>{{ $health->calorie }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Altura:</th>
                                <td>{{ $health->height }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Peso:</th>
                                <td>{{ $health->weight }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Grasa:</th>
                                <td>{{ $health->fat }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Comentarios:</th>
                                <td>{{ $health->remarks }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
