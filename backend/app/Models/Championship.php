<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Championship extends Model
{
	protected $table = 'campeonatos';

	protected $fillable = [
		'nome', 'data_inicio', 'data_fim', 'time_vencedor_id',
	];

	public function teams()
	{
		return $this->belongsToMany(Team::class, 'campeonato_times')
			->withPivot(['data_inscricao', 'pontos_acumulados']);
	}

	public function games()
	{
		return $this->hasMany(Game::class);
	}

	public function winner()
	{
		return $this->belongsTo(Team::class, 'time_vencedor_id');
	}
}
