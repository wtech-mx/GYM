@extends('layouts.backend.app')

@section('title', 'Plan Details')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Detalles Plan</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('app.plan.edit', $plan->id) }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-edit fa-w-20"></i>
                        </span>
                        {{ __('Edit') }}
                    </a>
                    <a href="{{ route('app.plan.index') }}" class="btn-shadow btn btn-danger">
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
                                <td>{{ $plan->planName }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Descripción:</th>
                                <td>{{ $plan->description }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Tiempo Validez:</th>
                                <td>{{ $plan->validity }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Costo:</th>
                                <td>{{ $plan->amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
