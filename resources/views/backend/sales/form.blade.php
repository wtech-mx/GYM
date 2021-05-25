@extends('layouts.backend.app')

@section('title', 'Ventas')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __((isset($sales) ? 'Edit' : 'Create New') . ' Ventas') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('app.sales.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="salesFrom" method="POST"
                action="{{ isset($sales) ? route('app.sales.update', $sales->id) : route('app.sales.store') }}"
                enctype="multipart/form-data">
                @csrf
                @if (isset($sales))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Venta Info</h5>

                                <x-forms.select label="Selecciona Usuario" name="id_user"
                                    class="select js-example-basic-single">
                                    @foreach ($customers as $key => $customers)
                                        <x-forms.select-item :value="$customers->id" :label="$customers->username"
                                            :selected="$sales->Customers->id ?? null" />
                                    @endforeach
                                </x-forms.select>

                                <x-forms.select label="Selecciona Producto" name="id_product"
                                    class="select js-example-basic-single">
                                    @foreach ($products as $key => $products)
                                        <x-forms.select-item :value="$products->id" :label="$products->name"
                                            :selected="$sales->Products->id ?? null" />
                                    @endforeach
                                </x-forms.select>

                                <x-forms.textbox type="number" label="Cantidad" name="lot" value="{{ $sales->lot ?? '' }}"
                                    field-attributes="required autofocus">
                                </x-forms.textbox>

                                <x-forms.textbox type="number" label="Total" name="amount"
                                    value="{{ $sales->amount ?? '' }}" />

                                @isset($sales)
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
