@extends('layouts.backend.app')

@section('title', 'Plan')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __((isset($plan) ? 'Edit' : 'Create New') . ' Plan') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
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
        <div class="col-12">
            <!-- form start -->
            <form role="form" id="planFrom" method="POST"
                action="{{ isset($plan) ? route('app.plan.update', $plan->id) : route('app.plan.store') }}"
                enctype="multipart/form-data">
                @csrf
                @if (isset($plan))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Plan Info</h5>

                                <x-forms.textbox label="Nombre" name="planName" value="{{ $plan->planName ?? '' }}"
                                    field-attributes="required autofocus">
                                </x-forms.textbox>

                                <x-forms.textbox label="Descripción" name="description"
                                    value="{{ $plan->description ?? '' }}" />

                                <x-forms.textbox type="number" label="Costo" name="amount"
                                    value="{{ $plan->amount ?? '' }}" />

                                <x-forms.textbox type="number" label="Tiempo Validez" name="validity"
                                    value="{{ $plan->validity ?? '' }}" />

                                @isset($plan)
                                    <x-forms.button type="submit" label="Actualizar" icon-class="fas fa-arrow-circle-up" />
                                @else
                                    <x-forms.button type="submit" label="Crear" icon-class="fas fa-plus-circle" />
                                @endisset
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
