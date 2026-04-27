<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    /** @use HasFactory<\Database\Factories\VotingFactory> */
    use HasFactory;

    protected $fillable = ['judul', 'status', 'show_result'];

    public function opsivotings()
    {
        return $this->hasMany(opsivoting::class, 'voting_id');
    }
}
