<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\HomeController;
use App\Models\Contacto;
use App\Models\Gracias;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::post('/contacto', [ContactFormController::class, 'store'])
    ->name('contacto.store')
    ->middleware('throttle:5,1');

Route::get('/gracias', function () {
    return view('gracias', [
        'gracias' => Gracias::first(),
        'contacto' => Contacto::first(),
    ]);
});
