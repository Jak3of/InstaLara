<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'name',
        'surname',
        'nick',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function images()
    {
        // code...
        return $this->hasMany('App\Models\Image');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    public function hasLiked(Image $image)
    {
        return $this->likes->where('image_id', $image->id)->isNotEmpty();
    }

    public function like(Image $image)
    {
        if (!$this->hasLiked($image)) {
            $this->likes()->create([
                'image_id' => $image->id,
            ]);
        }
    }

    public function unlike(Image $image)
    {
        if ($this->hasLiked($image)) {
            $this->likes()->where('image_id', $image->id)->delete();
        }
    }
}
