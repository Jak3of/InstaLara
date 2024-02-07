<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center ">
        <a href="{{ (Auth::user()->id == $image->user->id) ? route('user.me') : route('user.profiles', ['id' => $image->user->nick]) }}" class="text-decoration-none text-dark d-flex align-items-center justify-content-start">
            <img class="rounded-circle img-thumbnail  d-block img-fluid" 
            style="width: 40px; height: 40px;"
            src="{{ url('user/avatar/'.$image->user->image)}}" alt="{{ $image->user->name }}">
            <span class="ms-2 d-flex flex-row ">
                {{ $image->user->name . ' ' . $image->user->surname }} |
                <div style="font-size: 12px; color: gray; margin-top: 2px;">{{ '@' . $image->user->nick }}</div>
            </span>
            
            
        </a>
        <div class="d-flex align-items-center justify-content-end">
            @if (Auth::user()->id == $image->user->id)
            <div class="text-muted me-2 " ><a class="text-decoration-none " style="color: gray;" href="{{ route('image.edit', ['id' => $image->id]) }}">Editar</a></div>
            <div class="text-muted me-2">
                <a class="text-decoration-none" style="color: gray; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar</a>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que quieres eliminar esta imagen?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="text-muted me-2 " ><div style="color: gray; cursor: pointer" onClick="navigator.clipboard.writeText('{{ env('APP_URL') }}/image/detalle/{{ $image->id }}')" >Compartir</div></div>
            <div class="text-muted me-auto">
                {{ str_replace(['a ', 'an ',' second ago', ' seconds ago', ' minute ago', ' minutes ago', ' hour ago', ' hours ago', ' day ago', ' days ago', ' month ago', ' months ago', ' year ago', ' years ago'], [' ', ' ', 's','s', 'm', 'm', 'h', 'h', 'd', 'd', 'mo', 'mo', 'y', 'y'], $image->created_at->diffForHumans()) }}
                </div>

        </div>
    </div>
    <div class="card-body">
        <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="text-decoration-none text-dark">
        <img class="img-fluid mb-3 " 
        style="max-height: 1000px; width: 100%; object-fit: cover; object-position: center;"
        src="{{ url('image/'.$image->image_path) }}" alt="{{ $image->description }}">
        <p>{{ $image->description }}</p>
        </a>

        <div class="row ">
            <div class="col-md-4">
                <div class="d-flex align-items-center">
                    {!! \Livewire\Livewire::mount('like-button', ['image' => $image]) !!}
                    {{-- @ livewire('like-button', ['image' => $image])  --}}
                </div>
            </div>
            <div class="col-md-4">
                </div>
            <div class="col-md-4 d-flex justify-content-end align-items-center">
                <div class="d-flex justify-content-end align-items-center" >
                    <div onClick="window.location.href='{{ route('image.detail', ['id' => $image->id]) }}' " style="font-size: 12px; color: gray; margin-top: 2px; cursor: pointer;">
                        💬
                        <span>{{ $image->comments->count() }}</span>
                        comentario{{ $image->comments->count() == 1 ? '' : 's' }}
                    </div>
                </div>

            </div>
            
        </div>
        

