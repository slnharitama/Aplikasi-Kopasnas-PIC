<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Vote extends Model
{
    /** @use HasFactory<\Database\Factories\VoteFactory> */
    use HasFactory;
    protected $fillable = ['anggota_id', 'opsi_id'];

    public function anggotas()
    {
        return $this->belongsTo(anggota::class, 'anggota_id');
    }

    public function opsivotings()
    {
        return $this->belongsTo(opsivoting::class, 'opsi_id');
    }
}
