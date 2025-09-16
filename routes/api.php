<?php

use App\Http\Controllers\Api\CurriculumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/curriculum/create', [CurriculumController::class, 'store']);
