<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonAnggota extends Model
{
    /** @use HasFactory<\Database\Factories\CalonAnggotaFactory> */
    use HasFactory;

    protected $fillable = ['nama', 'kelas'];
}
