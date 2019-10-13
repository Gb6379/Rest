@extends('layouts.app')

@section('content')


<div class="container col-md-4">
<h1 class="mb-3">Nova Tarefa</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form method="POST" action="{{ route('task.store') }}">
                @csrf
                <div class="form-group">    
                    <label for="title">Titulo:</label>
                    <input type="text" class="form-control" name="title"/>
                </div>

                <div class="form-group">
                    <label for="description">description</label>
                    <textarea type="text" class="form-control" name="description"></textarea>
                </div>

                <div class="form-group">
                    <label for="due_at">Data Prazo</label>
                    <input type="date" class="form-control" name="due_at"/>
                </div>

                <div class="form-group">
                    <label for="user_id">Responsavel:</label>
                        <select name="user_id" id="user_id" required class="form-control select2" style="width: 100%;">
                            @foreach($users as $user)
                                <option value="{{$user->id }}">{{$user->name}}</option>
                            @endforeach
                        </select>
                </div>

                
                        
                <button type="submit" class="btn btn-primary">Add </button>
            </form>
    </div>




@endsection