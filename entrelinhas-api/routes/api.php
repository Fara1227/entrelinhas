Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:api')->group(function () {
    Route::apiResource('noticias', NoticiaController::class);
    Route::apiResource('historias', HistoriaVidaController::class);
});