@extends('layouts.app')

@section('content')

<div class="container w-55 ">
        <h1 class="display-3">Update a companie</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="POST" action="{{route('task.update', $task->id)}}">
            @method('PUT') 
            @csrf
            <div class="form-group">
                <label for="title">Titulo: </label>
                <input type="text" class="form-control" name="title" value="{{ $task->title }}" />
            </div>

            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea class="form-control" name="description" >{{ $task->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="due_at">Data Prazo:</label>
                <input type="date" class="form-control" name="due_at" value="{{ $task->due_at }}" />
            </div>

            <div class="form-group">
                    <label for="user_id">Responsavel:</label>
                        <select name="user_id" id="user_id" required class="form-control select2" style="width: 100%;">
                            @foreach($users as $user)
                                <option value="{{$user->id }}">{{$user->name}}</option>
                            @endforeach
                        </select>
                </div>
            <div class="form-group">
                <span class="badge-pill badge-dark">
                    <label for="is_completed">Status</label>
                @if($task->is_completed)
                    <span>completada</span>
                   
                @else
                <span>a fazer</span>
               
                @endif
                </span>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a class="btn btn-danger" href="{{ route('task')}}" > Cancel</a>
            
           
        </form>
        
        @if($task->is_completed)
        <form action="{{route('task.statusu', $task->id)}}" method="POST">  
        @csrf
        @method('PUT')


            <button type="submit" class="btn btn-info mt-3">Uncomplete</button>
        </form> 
        @else
         <form action="{{route('task.status', $task->id)}}" method="POST">  
        @csrf
        @method('PUT')

                    
            <button type="submit" class="btn btn-info mt-3">Complete</button>
        </form>                    
       @endif
    </div>
</div>









@endsection