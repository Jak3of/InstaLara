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
            @foreach ($images as $image)
                @include('includes.image', ['image' => $image])
                @if($image->comments->count() > 0)
                <hr>
                @endif
                <div class="row">
                    <div class="col-md-8">
                        @foreach ($image->comments->take(5) as $comment)
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
                {{ $images->links() }}
            </div>
        </div>
        
    </div>

</div>
@endsection
