<?php

use App\Http\Controllers\CandidatController;
use App\Http\Controllers\ReferentielController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin', [CandidatController::class, 'index'])->name('admin');
Route::get('home', [CandidatController::class, 'home'])->name('home');

//type
Route::post('type/create', [CandidatController::class, 'typeStore'])->name('type.store');
Route::get('type/{id}/delete', [CandidatController::class, 'deleteType'])->name('type.delete');

//referentiel
Route::post('referentiel/create', [CandidatController::class, 'referentielStore'])->name('referentiel.store');
Route::get('referentiel/{id}/delete', [CandidatController::class, 'deleteReferentiel'])->name('referentiel.delete');
Route::get('admin/referentiel/{id}/edit', [CandidatController::class, 'editReferentiel'])->name('referentiel.edit');
Route::post('referentiel/{id}/update', [CandidatController::class, 'referentielUpdate'])->name('referentiel.update');

//formation
Route::post('formation/create', [CandidatController::class, 'formmationStore'])->name('formation.store');
Route::get('formation/{id}/delete', [CandidatController::class, 'deleteFormation'])->name('formation.delete');
Route::get('admin/formation/{id}/edit', [CandidatController::class, 'editFormation'])->name('formation.edit');
Route::put('formation/{id}/update', [CandidatController::class, 'formationUpdate'])->name('formation.update');


//candidat
Route::post('candidat/create', [CandidatController::class, 'candidatStore'])->name('candidat.store');
Route::get('candidat/{id}/delete', [CandidatController::class, 'deleteCandidat'])->name('candidat.delete');
Route::get('candidat/{id}/detail', [CandidatController::class, 'detailCandidat'])->name('candidat.detail');
Route::get('hoeme/candidat/{id}/edit', [CandidatController::class, 'editCandidat'])->name('candidat.edit');
Route::put('candidat/{id}/update', [CandidatController::class, 'candidatUpdate'])->name('candidat.update');




