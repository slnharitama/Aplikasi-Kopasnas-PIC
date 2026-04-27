<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpsiVoting extends Model
{
    /** @use HasFactory<\Database\Factories\OpsiVotingFactory> */
    use HasFactory;

    protected $fillable = ['voting_id', 'nama_opsi'];

    public function votings()
    {
        return $this->belongsTo(voting::class, 'voting_id');
    }

    public function votes()
    {
        return $this->hasMany(vote::class, 'opsi_id');
    }
}
