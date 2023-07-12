@extends('app')

@section('content')
     <div class="container w-25 border p-4 mt-4">
          <form action="{{ route('todos') }}" method="POST">

               @csrf

               @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
               @endif

               @error('title')
                    <h6 class="alert alert-danger">{{ $message }}</h6>
               @enderror

               <div class="mb-3">
                 <label for="title" class="form-label">Titulo de la tarea</label>
                 <input type="text" class="form-control" id="title" name="title">
               </div>

               <div class="mb-3">
                    <label for="title" class="form-label">Categoria</label>
                    <select class="form-control" name="category_id" id="category_id">
                         @foreach ($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                         @endforeach
                    </select>
               </div>
               <button type="submit" class="btn btn-primary">Crear nueva tarea</button>
          </form>

          <div>
               @foreach ($todos as $todo)
               
                    <div class="row py-1">
                         <div class="col-md-9 d-flex align-items-center">
                              <a href="{{ route('todos-show', ['id' => $todo]) }}">{{ $todo->title }}</a>
                         </div>

                         <div class="col-md-3 d-flex justify-content-end">
                              <form action="{{ route('todos-destroy', $todo) }}" method="post">
                              
                                   @csrf
                                   @method('DELETE')

                                   <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>

                              </form>
                         </div>
                    </div>

               @endforeach
          </div>
     </div>
@endsection