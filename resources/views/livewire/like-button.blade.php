<button class="btn btn-warning" wire:click.prevent="toggleLike">
    👍 {{ Auth::user()->hasLiked($this->image) ? 'Dislike' : 'Like' }} ({{ $image->likes->count() }})
</button>
