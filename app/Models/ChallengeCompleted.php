<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeCompleted extends Model
{
    use HasFactory;
    protected $table = 'challenges_completed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'challenge_id',
        'date',
        'completed',
        'type',
        'created_by',
    ];
}
