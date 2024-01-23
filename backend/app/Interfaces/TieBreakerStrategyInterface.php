<?php


namespace App\Interfaces;

interface TieBreakerStrategyInterface
{
	public function determineWinner(array $game, int $homeScore, int $awayScore): ?int;
}
