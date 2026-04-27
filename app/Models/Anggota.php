<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Anggota extends Model
{
    /** @use HasFactory<\Database\Factories\AnggotaFactory> */
    use HasFactory;

     protected $fillable = ['nama', 'kelas'];

    public function votes()
    {
        return $this->hasMany(vote::class, 'anggota_id');
    }
}
