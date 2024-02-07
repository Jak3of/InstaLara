
            <div class="d-flex flex-row align-items-center justify-content-start">
                <img class="rounded-circle img-thumbnail  d-block img-fluid" 
                    style="width: 40px; height: 40px; object-fit: cover;"
                    src="{{ url('user/avatar/'.$comment->user->image)}}" alt="{{ $comment->user->name }}">
                <div class="text-decoration-none " style="display: flex; flex-flow: column; align-items: start; justify-content: center;">
                    
                    <span class="ms-2 d-flex flex-row ">
                        <a href="{{ route('user.profiles', ['id' => $comment->user->nick]) }}" class="text-decoration-none"><div style="font-size: 12px; color: gray; margin-top: 2px;">{{ '@' . $comment->user->nick }}</div></a>
                        <div class="" style="font-size: 12px; color: gray; margin-left: 2px; margin-top: 2px;" >{{ str_replace(['a ', 'an ',' second ago', ' seconds ago', ' minute ago', ' minutes ago', ' hour ago', ' hours ago', ' day ago', ' days ago', ' month ago', ' months ago', ' year ago', ' years ago'], [' ', ' ', 's','s', 'm', 'm', 'h', 'h', 'd', 'd', 'mo', 'mo', 'y', 'y'], $comment->created_at->diffForHumans()) }}</div>
                    </span>
                    <div class="ms-2" style="font-size: 12px; margin-top: 2px; ">{{ $comment->content }}</div>
                    <div class="ms-2" style="font-size: 12px; margin-top: 2px; color: gray; ">
                        <a href="" class="text-decoration-none" style="margin-right: 5px; color: gray;">Responder</a>
                        @if($comment->user->id == Auth::user()->id)
                        
                        <a class="text-decoration-none" style="margin-right: 5px; color: gray; cursor: pointer" data-bs-toggle="modal" data-bs-target="#deleteCommentModal">Eliminar</a>

                        <!-- Modal -->
                        <div class="modal fade" id="deleteCommentModal" tabindex="-1" aria-labelledby="deleteCommentModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteCommentModalLabel">Confirmar eliminación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que quieres eliminar este comentario?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-danger">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                

                
            </div>
            