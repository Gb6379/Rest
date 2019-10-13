@extends('layouts.app')

@section('content')

<div class="container">

    
    <h1>Lista de Tarefas</h1>
    <a class="btn btn-success" href="{{route('task.create')}}" > Add Task</a>

    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>
    @elseif ($message = Session::get('danger'))
    <div class="alert alert-danger">

    <p>{{ $message }}</p>

    </div>
    @endif

    <form action="{{route('daterange')}}" method="GET">
      <div class="row input-daterange mb-2 mt-2">
            <div class="col-md-4">
                <input type="date" class="form-control" name="from" placeholder="from">
            </div>
            <div class="col-md-4">
                <input type="date" name="to" class="form-control" placeholder="to">
            </div>
            <div class="col-md-4">
                <button class="btn btn-secondary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-dark"> 
        <thead>
            <th>Titulo</th>
            <th>Descricao</th>           
            <th>Data prazo</th>
            <th>Criado em</th>
            <th>Responsavel</th>   
            <th>Status</th>
                  
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                
                <td>{{$task->title}}</td>
                <td> {{$task->description}}</td>
                <td>{{$task->due_at}}</td>
                <td>{{$task->created_at}}</td>
                <td>{{$task->user->name}}</td>
                @if($task->is_completed)
                    <td>completada em {{$task->updated_at}}</td>
                    
                @else
                <td>a fazer</td>
                @endif
                <td>
                    <a class="btn btn-primary" href="{{route('task.edit', $task->id)}}" >Editar</a>
                </td>
                <td>
                @if($task->is_completed)
                <form action="{{route('task.statusu', $task->id)}}" method="POST">  
                    @csrf
                    @method('PUT')


                        <button type="submit" class="btn btn-info">Uncomplete</button>
                    </form> 
                    @else
                    <form action="{{route('task.status', $task->id)}}" method="POST">  
                    @csrf
                    @method('PUT')

                                
                        <button type="submit" class="btn btn-info">Complete</button>
                </form>                    
                @endif   
                </td>              
                <td>
                    <form action="{{route('task.destroy', $task->id)}}" method="POST">  

                            @csrf
                            @method('DELETE')

                    
                            <button type="submit" class="btn btn-danger">Delete</button>
                    </form>                   
                </td>              
            </tr>
          
           
        </tbody>
                
        @endforeach 
    </table>

  
</div>

@endsection