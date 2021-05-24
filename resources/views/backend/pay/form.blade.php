@extends('layouts.backend.app')

@section('title', 'Pay')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __((isset($pay) ? 'Edit' : 'Create New') . ' Pay') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('app.pay.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="payFrom" method="POST"
                action="{{ isset($pay) ? route('app.pay.update', $pay->id) : route('app.pay.store') }}"
                enctype="multipart/form-data">
                @csrf
                @if (isset($pay))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Pagos Info</h5>

                                <x-forms.select label="Select Cliente" name="id_user"
                                    class="select js-example-basic-single">
                                    @foreach ($customers as $key => $customers)
                                        <x-forms.select-item :value="$customers->id" :label="$customers->username"
                                            :selected="$pay->Customers->id ?? null" />
                                    @endforeach
                                </x-forms.select>

                                <x-forms.select label="Seleccione nuevo Plan" name="id_plan"
                                    class="select js-example-basic-single">
                                    @foreach ($plan as $key => $plan)
                                        <x-forms.select-item :value="$plan->id" :label="$plan->planName"
                                            :selected="$pay->Plan->id ?? null" />
                                    @endforeach
                                </x-forms.select>

                                <x-forms.textbox type="date" label="Fecha de Pago" name="plan_date"
                                    value="{{ $pay->plan_date ?? '' }}" />

                                <x-forms.textbox type="date" label="Fecha de Expiración" name="expire"
                                    value="{{ $pay->expire ?? '' }}" />

                                @isset($pay)
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
