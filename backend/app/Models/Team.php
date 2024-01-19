<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
	protected $table = 'times';

	protected $fillable = [
		'nome',
		'created_at',
		'updated_at'
	];

	public function championships()
	{
		return $this->belongsToMany(Championship::class, 'campeonato_times');
	}
}
