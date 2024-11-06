@extends('back.layouts.master')
@section('title', 'Formulaire d\'ajout de FAQ ')
@section('content')


   <!-- Content -->
   <div class="row gy-4">
    <div class="col-md-10 offset-1">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Formulaire d'ajout de FAQ</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('faqs.store') }}" method="POST">
                    @csrf

                    <div class="row gy-3">
                        <div class="row mt-3">
                            <!-- Type de FAQ -->
                            <div class="col-md-6">
                                <label class="form-label" for="faq_type">Type de FAQ</label>
                                <select class="form-control @error('faq_type_id') is-invalid @enderror" id="faq_type" name="faq_type_id" required>
                                    <option value="">Sélectionnez un type</option>
                                    @foreach($faqTypes as $type)
                                        <option value="{{ $type->id }}" {{ old('faq_type_id') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('faq_type_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-4">
                            <!-- Question -->
                            <div class="col-md-12">
                                <label class="form-label" for="question">Question</label>
                                <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" placeholder="Entrez la question" value="{{ old('question') }}" required>
                                @error('question')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-4">
                            <!-- Réponse -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="answer">Réponse</label>
                                <textarea class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" rows="4" placeholder="Entrez la réponse" required>{{ old('answer') }}</textarea>
                                @error('answer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Bouton Soumettre -->
                        <div class="col-12 text-end mt-4">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->








@endsection
