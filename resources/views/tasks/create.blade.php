@extends('layouts.app')

@section('content')
    <h1>Ajouter une nouvelle tâche</h1>
    <form action="{{ route('tasks.store') }}" method="POST" class="form">
        @csrf
        <div class="form-group">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control">
            @error('titre')
              <div class="alert alert-danger p-2 mt-2" role="alert">
                {{ $message }}
              </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
            @error('description')
              <div class="alert alert-danger p-2 mt-2" role="alert">
                {{ $message }}
              </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="date_echeance" class="form-label">Date d'échéance</label>
            <input type="date" name="date_échéance" class="form-control">
            @error('date_échéance')
              <div class="alert alert-danger p-2 mt-2" role="alert">
                {{ $message }}
              </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="statut" class="form-label">Statut</label>
            <select name="status" class="form-control">
                <option value="" disabled selected>Selectionner</option>
                <option value="en cours">En cours</option>
                <option value="terminee">Terminée</option>
            </select>
            @error('status')
              <div class="alert alert-danger p-2 mt-2" role="alert">
                {{ $message }}
              </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
@endsection
