@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('error'))
                <div class="alert alert-success ">
                    {{ session('error')}}
                </div>
            @endif
        	<div class="card">
        		<div class="card-header">
        			Editar Imagen
        		</div>
                <div class="card-body">
                    <form action="{{ route('image.update', ['id' => $image->id ] ) }}" method="post">
                        @csrf
                        
                        

                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label text-md-end">Descripción</label>
                            <div class="col-md-6 d-flex justify-content-center ">
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10">{{ $image->description }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-dark">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

            
            
        </div>
    </div>
</div>
@endsection