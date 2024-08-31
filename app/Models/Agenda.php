<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Agenda extends Model
{
    use HasFactory;
    protected $table = 'agendas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'general',
        'date_start',
        'hour_start',
        'date_end',
        'hour_end',
        'recurrent',
        'frequency',
        'week_days',
        'duration',
        'status',
        'color',
        'created_by',
    ];

    /**
     * Get the infos associated with the user.
    */
    public function usersParticipants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'agenda_users', 'agenda_id', 'user_id');
    }
}
