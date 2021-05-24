@extends('layouts.backend.app')

@section('title', 'Customers')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __((isset($customers) ? 'Edit' : 'Create New') . ' Customers') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
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
        <div class="col-12">
            <!-- form start -->
            <form role="form" id="customersFrom" method="POST"
                action="{{ isset($customers) ? route('app.customers.update', $customers->id) : route('app.customers.store') }}"
                enctype="multipart/form-data">
                @csrf
                @if (isset($customers))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">customers Info</h5>

                                <x-forms.textbox label="Nombre" name="username" value="{{ $customers->username ?? '' }}"
                                    field-attributes="required autofocus">
                                </x-forms.textbox>

                                <x-forms.textbox label="Genero" name="gender" value="{{ $customers->gender ?? '' }}" />

                                <x-forms.textbox label="Telefono" name="mobile" value="{{ $customers->mobile ?? '' }}" />

                                <x-forms.textbox type="email" label="Email" name="email"
                                    value="{{ $customers->email ?? '' }}" />

                                <x-forms.textbox type="streetName" label="Calle" name="streetName"
                                    value="{{ $customers->streetName ?? '' }}" />

                                <x-forms.textbox type="state" label="Estado/Municpio" name="state"
                                    value="{{ $customers->state ?? '' }}" />

                                <x-forms.textbox type="city" label="Ciudad/Delegacion" name="city"
                                    value="{{ $customers->city ?? '' }}" />

                                <x-forms.textbox type="zipcode" label="CP" name="zipcode"
                                    value="{{ $customers->zipcode ?? '' }}" />

                                <x-forms.textbox type="date" label="Fecha en que se unio" name="joining_date"
                                    value="{{ $customers->joining_date ?? '' }}" />

                                <x-forms.textbox type="date" label="Fecha de nacimiento" name="date_birth"
                                    value="{{ $customers->date_birth ?? '' }}" />

                                @isset($customers)
                                    <x-forms.button type="submit" label="Update" icon-class="fas fa-arrow-circle-up" />
                                @else
                                    <x-forms.button type="submit" label="Create" icon-class="fas fa-plus-circle" />
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
