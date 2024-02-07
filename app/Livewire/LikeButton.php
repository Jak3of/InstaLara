<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Image;

class LikeButton extends Component
{
    public $image;
    protected $listeners = ['refresh' => '$refresh'];

    public function render()
    {
        return view('livewire.like-button', ['image' => $this->image]);
    }

    public function mount(Image $image)
    {
        $this->image = $image;
    }

    public function toggleLike(){
        if(\Auth::user()->hasLiked($this->image)) {
            \Auth::user()->unlike($this->image);
        } else {
            \Auth::user()->like($this->image);
        }
        
        $this->dispatch('refresh');
        $this->image = Image::find($this->image->id); // Refresca la imagen para obtener el conteo de "likes" actualizado

    }
}
