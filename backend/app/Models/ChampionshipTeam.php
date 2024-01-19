<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ChampionshipTeam extends Pivot
{
	protected $table = 'campeonato_times';

	public $incrementing = false;

	protected $fillable = [
		'campeonato_id', 'time_id', 'data_inscricao', 'pontos_acumulados',
	];
}
