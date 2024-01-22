<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
	protected $table = 'jogos';

	protected $fillable = [
		'campeonato_id', 'fase', 'time_casa_id', 'time_visitante_id', 'placar_casa', 'placar_visitante', 'vencedor_id', 'data_jogo',
	];

	public function championship()
	{
		return $this->belongsTo(Championship::class);
	}

	public function homeTeam()
	{
		return $this->belongsTo(Team::class, 'time_casa_id');
	}

	public function awayTeam()
	{
		return $this->belongsTo(Team::class, 'time_visitante_id');
	}

	public function winner()
	{
		return $this->belongsTo(Team::class, 'vencedor_id');
	}
}
