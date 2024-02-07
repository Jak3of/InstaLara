@if (Auth::user()->image)
    
    
    <img id="image_path" class="rounded-circle img-thumbnail d-block img-fluid" style="width: 100%; height: 100%; object-fit: cover"  src=" {{ url('/user/avatar/'.Auth::user()->image)}}" alt="Avatar">
    
@endif