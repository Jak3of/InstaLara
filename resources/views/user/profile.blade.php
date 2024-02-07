
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
            <div class="card mb-3">
                <div class="card-header" Style="display: flex; flex-flow: column; width: 100%; justify-content: start;">
                    <div class="d-flex flex-row align-items-center justify-content-start">
                        <a href="" class="text-decoration-none text-dark d-flex flex-column align-items-start justify-content-start">
                            <img class="rounded-circle img-thumbnail  d-block img-fluid" 
                            style="width: 100px; height: 100px; margin: 10px; object-fit: cover"
                            src="{{ url('user/avatar/'.$user->image)}}" alt="{{ $user->name }}">
                            <span class="ms-2 d-flex flex-column ">
                                {{ $user->name . ' ' . $user->surname }}
                                <div style="font-size: 12px; color: gray; margin-top: 2px;">{{ '@' . $user->nick }}</div>
                            </span>
                            
                        </a>
                        <div class="  " style="width: 100%; margin-top: 10px; display: flex; flex-flow: row; align-items: center; justify-content: space-evenly" >
                            
                                <a href="" class=" text-decoration-none text-dark d-flex flex-column align-items-center justify-content-start">
                                    <span> {{ $user->images->count() }}</span>
                                    <div style="font-size: 12px; color: gray; margin-top: 2px;">Publicaciones</div>
                                </a>
                            
                            
                                <a href="" class=" text-decoration-none text-dark d-flex flex-column align-items-center justify-content-start">
                                    <span> {{ $user->likes->count() }}</span>
                                    <div style="font-size: 12px; color: gray; margin-top: 2px;">Seguidores</div>
                                </a>
                            
                            
                                <a href="" class=" text-decoration-none text-dark d-flex flex-column align-items-center justify-content-start">
                                    <span> {{ $user->likes->count() }}</span>
                                    <div style="font-size: 12px; color: gray; margin-top: 2px;">Seguidos</div>
                                </a>
                            
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-around " style="margin-top: 10px; width: 100%;  "> 
                        @if (Auth::user()->id == $user->id)
                        <a href="{{ route('config')}}" class=" text-decoration-none text-dark d-flex flex-column align-items-center justify-content-start" 
                        style="padding: 5px 50px; border: 1px solid gray; border-radius: 5px;  ">
                            <div style="font-size: 12px; color: gray; margin-top: 2px;">Editar Perfil</div>
                        </a>
                        @endif
                        <div class=" text-decoration-none text-dark d-flex flex-column align-items-center justify-content-start"
                        style="padding: 5px 50px; border: 1px solid gray; border-radius: 5px; cursor: pointer; " 
                        onclick="navigator.clipboard.writeText('{{ env('APP_URL') }}/{{ $user->nick }}')">
                            <div style="font-size: 12px; color: gray; margin-top: 2px;">Compartir Perfil</div>
                        </div>
                    </div>


                </div>

            
                <div class="card-body">
                    <h3 class="text-center">Publicaciones</h3>

                    <div class="row">
                        @if (count($user->images) == 0)
                            <div class="col-12">
                               
                                <h3 class="text-center " style=" font-size: 20px; color: gray; ">No hay publicaciones</h3>
                                    
                            </div>
                        @else
                        @foreach ($user->images as $image)
                            <div class="col-4" style="padding: 1px !important ;">
                                <div class="card" style="width: 100%; border: none !important;">
                                    <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="text-decoration-none text-dark ">
                                        <img style="width: 100%; height: 280px; object-fit: cover; object-position: center;" class="img-fluid" src="{{ url('image/'.$image->image_path)}}" alt="">
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        @endif
                    </div>

                </div>

            
            </div>
            
            
            
        </div>
        
    </div>

</div>
@endsection
