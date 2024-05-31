@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier la tâche</h1>
        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" name="titre" class="form-control" value="{{ $task->titre }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" required>{{ $task->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="date_echeance">Date d'échéance</label>
                <input type="date" name="date_échéance" class="form-control" value="{{ $task->date_échéance }}" required>
            </div>
            <div class="form-group">
                <label for="status">Statut</label>
                <select name="status" class="form-control">
                    <option value="en cours" {{ $task->status == 'en cours' ? 'selected' : '' }}>En cours</option>
                    <option value="terminée" {{ $task->status == 'terminée' ? 'selected' : '' }}>Terminée</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection