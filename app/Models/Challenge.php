<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Challenge extends Model
{
    use HasFactory;
    protected $table = 'challenges';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'url',
        'date',
        'custom_start',
        'custom_end',
        'description',
        'position',
        'status',
        'created_by',
        'updated_by',
    ];

    // Obtém os dis dos desafios
    public function getDays(){

        // Desafio
        $challenge = $this;

        // Se for mensal
        if($challenge->type == 'mensal') {

            // Divide a string "MM/YYYY" em partes
            list($month, $year) = explode('/', $challenge->date);
            $start = Carbon::createFromDate($year, $month, 1)->startOfDay()->format('Y-m-d');
            $end = Carbon::createFromDate($year, $month, 1)->endOfMonth()->endOfDay()->format('Y-m-d');

        } else {
            $start = $challenge->custom_start;
            $end   = $challenge->custom_end;
        }

        // Formata datas
        $start = Carbon::parse($start);
        $end = Carbon::parse($end);
        $dates = [];

        // Faz looping entre elas
        for ($date = $start; $date->lte($end); $date->addDay()) {
            
            // Formata data
            $day['date'] = $date->format('Y-m-d');
            $day['completed'] = $this->completed($day['date']);

            $dates[] = $day;
        }

        return $dates;

    }

    public function completed($date){

        return ChallengeCompleted::where('challenge_id', $this->id)->where('date', $date)->first()->completed ?? null;

    }


}
