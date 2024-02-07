@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
            @endif
            {{-- $images --}}
            @include('includes.image', ['image' => $image])
            @if($image->comments->count() > 0)
                <hr>
                @endif
                <div class="row">
                    <div class="col-md-8">
                        @foreach ($image->comments as $comment)
                            @include('includes.comments', ['comment' => $comment])
                        @endforeach

            
                    </div>
                    
                </div>

                    
            

            
                <div class="" style="margin-top: 20px; width: 100%;">
                    <div class="d-flex align-items-center" style="margin-top: 20px; width: 100%;">
                        <form action="{{ route('comment.save', ['id' => $image->id]) }}" class="w-100" method="post">
                            @csrf
                            <div class="input-group ">
                                <input type="text" class="form-control @error('content') is-invalid @enderror"   name="content" placeholder="Escribe un comentario">
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <button class="btn btn-warning" type="submit">Comentar</button>
                                
                            </div>

                            
                        </form>
                        
                        
                    </div>
                </div>
            
            
            
            
                </div>
            </div>
            
        </div>
        
    </div>

</div>
@endsection
        