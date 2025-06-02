<?php



use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\AffectationController;
use App\Http\Controllers\SocieteController;
use App\Http\Controllers\ContratController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');




Route::get('/notifications/materiels', [MaterielController::class, 'lowStock'])->name('materiels.lowStock');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('materiels/export', [MaterielController::class, 'export'])->name('materiels.export');
    Route::resource('materiels', MaterielController::class)->except(['show']);
    Route::get('materiels/{materiel}', [MaterielController::class, 'show'])->name('materiels.show');
    Route::post('/materiels/import', [MaterielController::class, 'import'])->name('materiels.import');

    Route::resource('affectations', AffectationController::class);
    Route::post('/affectations/bulk-delete', [AffectationController::class, 'bulkDelete'])->name('affectations.bulkDelete');


    Route::resource('societes', SocieteController::class);
    Route::resource('contrats', ContratController::class);
    Route::get('/contrats/export', [ContratController::class, 'export'])->name('contrats.export');
    Route::get('/contrats/export/{format?}', [ContratController::class, 'export'])->name('contrats.export');



});

require __DIR__.'/auth.php';
