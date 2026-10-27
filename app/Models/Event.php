<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    // Relasi: Event milik 1 Admin
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    // Relasi: Event punya banyak registrasi
    public function registrasis()
    {
        return $this->hasMany(Registrasi::class);
    }
}