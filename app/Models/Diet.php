<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diet extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'goal', 'total_calories', 'created_by', 'updated_by'];

    public function days()
    {
        return $this->hasMany(DayOfWeek::class);
    }

    public function today()
    {
        
        // Define a localização para pegar o nome do dia em português
        Carbon::setLocale('pt_BR');
    
        // Obtém o nome do dia atual (ex: Segunda, Terça, etc.)
        $todayName = ucfirst(Carbon::now()->isoFormat('dddd'));
    
        // Busca o dia correspondente na dieta
        $day = $this->days()->where('name', $todayName)->first();

        return $day;

    }

}
