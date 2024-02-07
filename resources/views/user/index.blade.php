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
            @foreach ($users as $user)
            <div class="card my-2">
                <div class="card-header d-flex justify-content-between align-items-center ">
                    <a href="{{ (Auth::user()->id == $user->id) ? route('user.me') : route('user.profiles', ['id' => $user->nick]) }}" class="text-decoration-none text-dark d-flex align-items-center justify-content-start">
                        <img class="rounded-circle img-thumbnail  d-block img-fluid" 
                        style="width: 40px; height: 40px;"
                        src="{{ url('user/avatar/'.$user->image)}}" alt="{{ $user->name }}">
                        <span class="ms-2 d-flex flex-row ">
                            {{ $user->name . ' ' . $user->surname }} |
                            <div style="font-size: 12px; color: gray; margin-top: 2px;">{{ '@' . $user->nick }}</div>
                        </span>
                        
                        
                    </a>
                </div>
            </div>

            @endforeach
            
            
            <div class="links  d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>
        
    </div>

</div>
@endsection
