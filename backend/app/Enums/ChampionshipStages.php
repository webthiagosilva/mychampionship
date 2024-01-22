<?php

namespace App\Enums;

enum ChampionshipStages: string
{
	case QUARTER_FINALS = 'quartas';
	case SEMI_FINALS = 'semifinais';
	case FINAL = 'final';
	case THIRD_PLACE = 'terceiro_lugar';
}
