<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registrasi extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    // Relasi: Registrasi milik 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Registrasi milik 1 Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}