<?php

namespace App\Http\Enums;

enum Education: string
{
    case HighSchool = 'Ensino Médio';
    case Graduate = 'Graduação';
    case Master = 'Mestrado';
    case Doctorate = 'Doutorado';
}