@extends('layouts.backend.app')

@section('title', 'Health')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __((isset($health) ? 'Edit' : 'Create New') . ' Health') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
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
        <div class="col-12">
            <!-- form start -->
            <form role="form" id="healthFrom" method="POST"
                action="{{ isset($health) ? route('app.health.update', $health->id) : route('app.health.store') }}"
                enctype="multipart/form-data">
                @csrf
                @if (isset($health))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Estado de Salud Info</h5>

                                <x-forms.select label="Selecciona Usuario" name="id_user" class="select js-example-basic-single">
                                    @foreach ($customers as $key => $customers)
                                        <x-forms.select-item :value="$customers->id" :label="$customers->username"
                                            :selected="$health->Customers->id ?? null" />
                                    @endforeach
                                </x-forms.select>

                                <x-forms.textbox label="Caloria" name="calorie" value="{{ $health->calorie ?? '' }}"
                                    field-attributes="required autofocus">
                                </x-forms.textbox>

                                <x-forms.textbox type="number" label="Altura" name="height"
                                    value="{{ $health->height ?? '' }}" />

                                <x-forms.textbox type="number" label="Grasa" name="fat"
                                    value="{{ $health->fat ?? '' }}" />

                                <x-forms.textbox type="number" label="Peso Kg" name="weight"
                                    value="{{ $health->weight ?? '' }}" />

                                <div class="form-group">
                                    <label for="remarks">Comentarios</label>
                                    <textarea id="remarks" class="form-control"
                                        name="remarks"
                                        rows="3">{{ isset($health) ? $health->remarks : old('remarks') }}</textarea>
                                </div>

                                @isset($health)
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
