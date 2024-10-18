@extends('back.layouts.master')
@section('title', 'Parametre ')
@section('content')

    <!-- Content -->
    <div class="row gy-4">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Formulaire de Paramètres de l'Entreprise</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row gy-3">
                            @foreach ($settings as $setting)
                                <div class="col-12 d-flex">
                                    <label class="form-label col-3" for="{{ $setting->key }}">
                                        {{ ucfirst(str_replace('_', ' ', $setting->key)) }}
                                        @if ($setting->description)
                                        <span class="text-secondary " style="font-style: italic;">
                                            {{ $setting->description }}
                                        </span>
                                    @endif
                                    </label>

                                    @if ($setting->key == 'company_logo')
                                        <input type="file" class="form-control" id="{{ $setting->key }}" name="settings[{{ $setting->key }}]">
                                    @else
                                        <input type="text" class="form-control" id="{{ $setting->key }}" name="settings[{{ $setting->key }}]" value="{{ old('settings.' . $setting->key, $setting->value) }}">
                                    @endif

                                </div>

                            @endforeach

                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary-600">Modifier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- / Content -->
@endsection
