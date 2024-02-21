<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JokerApiController;
use App\Http\Controllers\ProxyApiController;

// Authenticate Token
Route::post('/authenticate-token', [JokerApiController::class, 'authenticateToken']);

// Balance
Route::post('/balance', [JokerApiController::class, 'balance']);

// Bet
Route::post('/bet', [JokerApiController::class, 'bet']);

// Settle Bet
Route::post('/settle-bet', [JokerApiController::class, 'settleBet']);

// Cancel Bet
Route::post('/cancel-bet', [JokerApiController::class, 'cancelBet']);

Route::post('/normal-login', [ProxyApiController::class, 'normalLogin']);

Route::get('/open-game-url', [ProxyApiController::class, 'openGameUrl']);

Route::post('/list-games', [ProxyApiController::class, 'listGames']);

Route::post('/sign-out', [ProxyApiController::class, 'signOut']);


// FOR USER STUFF 

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/verify-secret', [UserController::class, 'verifySecret'])->middleware(['auth:api', 'scope:verify_secret']);

Route::post('/change-password', [UserController::class, 'changePassword'])->middleware('auth:api');
