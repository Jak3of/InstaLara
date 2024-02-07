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
        			Upload Image
        		</div>
                <div class="card-body">
                    <form action="{{ route('image.save') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-3">

                            <label for="image_path" class="col-md-3 col-form-label text-md-end">Imagen</label>
                            


                            <div class="col-md-6 d-flex justify-content-center ">
                                <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path"  autocomplete="image_path">

                                @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-3 col-form-label text-md-end">Descripción</label>
                            <div class="col-md-6 d-flex justify-content-center ">
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10"></textarea>

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
                                    Guardar
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