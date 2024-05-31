@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
<h1>Liste des tâches</h1>
            </div>
            <div class="col-md-6">
            <a href="{{ route('login') }}" class="btn btn-warning">Logout</a>
            </div>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-4">
                <form action="{{ route('tasks.index') }}" method="GET" class="form-inline">
                    <div class="input-group">
                        <select name="status" class="form-select">
                            <option value="">Tous les statuts</option>
                            <option value="en cours" {{ request()->input('status') == 'en cours' ? 'selected' : '' }}>En cours</option>
                            <option value="terminee" {{ request()->input('status') == 'terminee' ? 'selected' : '' }}>Terminée</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Filtrer</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
    <form class="form-inline" action="{{ route('tasks.index') }}" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search...">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>
</div>

            
            <div class="col-md-4 text-md-end">
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">Ajouter une nouvelle tâche</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><a href="{{ route('tasks.index', ['sortBy' => 'titre']) }}">Titre</a></th>
                        <th>Description</th>
                        <th><a href="{{ route('tasks.index', ['sortBy' => 'date_échéance']) }}">Date d'échéance</a></th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->titre }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->date_échéance }}</td>
                            <td>{{ $task->status }}</td>
                            <td>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Modifier</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#tache{{ $task->id }}">
                                    Supprimer
                                </button>
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="tache{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $task->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $task->id }}">Confirmation de suppression</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Êtes-vous sûr de vouloir supprimer cette tâche?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Confirmer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Delete Confirmation Modal -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $tasks->appends(request()->input())->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
