<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use SoftDeletes;

    protected $guarded = ['id'];
    
    // Sembunyikan password saat data diambil
    protected $hidden = ['password'];

    // Relasi: Admin punya banyak event
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}