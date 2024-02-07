@extends('layouts.app')

@section('content')
<div class="container">
    @if (!$likes)
        <div class="alert alert-warning" role="alert">
            Todavia no tienes imagenes favoritas
        </div>
    @endif
    <h1 class="text-center">Imagenes Favoritas:</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif
            {{-- $images --}}
            
            @foreach ($likes as $like)
                 
                @include('includes.image', ['image' => $like->image])

                @if($like->image->comments->count() > 0)
                <hr>
                @endif
                <div class="row">
                    <div class="col-md-8">
                        @foreach ($like->image->comments->take(5) as $comment)
                            @include('includes.comments', ['comment' => $comment])
                        @endforeach

            
                            </div>
                            
                        </div>

                    </div>
                </div>
            @endforeach
            
            <style>
                

            </style>
            <div class="links  d-flex justify-content-center">
                {{ $likes->links() }}
            </div>
        </div>
        
    </div>

</div>
@endsection
