<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TypeNewController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ActualityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\RideSearchController;
use App\Http\Controllers\RideRequestController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeVehicleController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\DriverDocumentController;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contacter-nous', [ContactController::class, 'create'])->name('contact');
Route::post('/contacter-nous/send', [ContactController::class, 'store'])->name('contact.send');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/avatar/update', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::put('/notification/settings', [ProfileController::class, 'updateNotificationSettings'])->name('notification.settings.update');

    // contact

    Route::get('/contacter/liste', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/contacter/detail/{contact:email}', [ContactController::class, 'show'])->name('contact.show');
    Route::delete('/contacter/supprimer/{contact:email}', [ContactController::class, 'destroy'])->name('contact.destroy');

    // User
    Route::get('/check-username', [UserController::class, 'checkUsername'])->name('check.username');
    // Settings
    Route::get('/settings/edit', [DashboardController::class, 'setting'])->name('settings');
    Route::put('/settings/update', [DashboardController::class, 'update'])->name('settings.update');
    Route::get('/city', [DashboardController::class, 'city'])->name('setting.city');
    Route::get('/countries/update/{country}', [DashboardController::class, 'countryStatus'])->name('country.updatestatus');

    Route::get('/cities/update/{city}', [DashboardController::class, 'cityStatus'])->name('city.updatestatus');

    Route::get('/filter-cities', [DashboardController::class, 'filterCitiesByCountry'])->name('filter.cities');


    Route::get('/apis/edit/', [ApiController::class, 'api'])->name('apis');
    Route::put('/apis/update/', [ApiController::class, 'update'])->name('apis.update');


    Route::get('/users/filter', [UserController::class, 'filter'])->name('users.filter');

    Route::get('/demande/create', [RideRequestController::class, 'create'])->name('ride_requests.create');
    Route::post('/demande/edit', [RideRequestController::class, 'store'])->name('ride_requests.store');
    Route::get('/demande/liste', [RideRequestController::class, 'index'])->name('ride_requests.index');
    Route::get('/demande/detail', [RideRequestController::class, 'show'])->name('ride_requests.show');
    Route::get('/demande/{rideRequest}/{status}', [RideRequestController::class, 'updatestatus'])->name('ride_requests.status');
    Route::get('/demande/historique', [RideRequestController::class, 'historique'])->name('ride_requests.historique');

    Route::resource('users', UserController::class)->parameters([
        'users' => 'user:email',
    ]);

    Route::get('/doc/liste', [UserController::class, 'doc'])->name('users.doc');

    Route::resource('typenews', TypeNewController::class)->parameters([
        'typenews' => 'typenew:slug',
    ]);

    Route::resource('actualities', ActualityController::class)->parameters([
        'actualities' => 'actuality:slug',
    ]);

    Route::get('/actualite/filter', [ActualityController::class, 'filterByType'])->name('actualities.filterByType');


    Route::resource('rides', RideController::class)->parameters([
        'rides' => 'ride',
    ]);

    Route::resource('reviews', ReviewController::class)->parameters([
        'reviews' => 'review',
    ]);

    Route::resource('ridesearches', RideSearchController::class)->parameters([
        'ridesearches' => 'ridesearche',
    ]);

    Route::resource('transactions', TransactionController::class)->parameters([
        'transactions' => 'transaction',
    ]);

    Route::resource('bookings', BookingController::class)->parameters([
        'bookings' => 'booking',
    ]);

    Route::resource('reports', ReportController::class)->parameters([
        'reports' => 'report',
    ]);

    Route::get('/signaler/filter', [ReportController::class, 'filterByType'])->name('reports.filterByType');

    // Maps & Cartographie
    Route::get('/vues-d-ensemble/tarjets/reels', [DashboardController::class, 'cartograpie'])->name('tarjets.cartograpie');
    Route::get('/trajets-en-cours', [RideController::class, 'getTrajetsEnCours'])->name('trajets.en.cours');
    Route::post('/ride/{rideId}/update-location', [RideController::class, 'updateLocation']);

    Route::resource('faqs', FaqController::class)->parameters([
        'faqs' => 'faq:slug',
    ]);

// vehicles
    Route::resource('vehicles', VehicleController::class)->parameters([
        'vehicles' => 'vehicle:slug',
    ]);
    Route::get('/vehicule/filter-by-type', [VehicleController::class, 'filterByType'])->name('vehicles.filterByType');


    // Route::resource('typevehicles', TypeVehicleController::class)->parameters([
    //     'typevehicles' => 'typevehicle:slug',
    // ]);



// document
    Route::get('/document-detail/{user:email}', [UserController::class, 'Showdoc'])->name('documents.show');

//commission
Route::get('/commission/statistique', [CommissionController::class, 'index'])->name('commissions.index');

    Route::post('/paper/{document:number}/status', [DocumentController::class, 'validated'])->name('documents.validated');
    Route::post('/rejeter/raison', [DocumentController::class, 'reason'])->name('documents.reason');
// trajet
    Route::get('/trajet/historique', [RideController::class, 'historique'])->name('rides.historique');
    Route::get('/trajet/{ride}/{status}', [RideController::class, 'updatestatus'])->name('rides.status');
//transaction

    Route::get('/transac/historique', [TransactionController::class, 'historique'])->name('transactions.historique');
    Route::get('/transac/{transaction}/{status}', [TransactionController::class, 'updatestatus'])->name('transactions.status');
//reservation
    Route::get('/reservation/historique', [BookingController::class, 'historique'])->name('bookings.historique');
    Route::get('/reservation/{booking}/{status}', [BookingController::class, 'updatestatus'])->name('bookings.status');
    Route::post('/rides/filter', [BookingController::class, 'filterRides'])->name('rides.filter');

    Route::get('/users/delete/{user:email}', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users/status/{user}', [UserController::class, 'updateStatus'])->name('users.updateStatus');
    Route::get('/users/certified/{user}', [UserController::class, 'updateIsCertified'])->name('users.updateIsCertified');
    Route::get('/assign-role', [UserController::class, 'Indexrole'])->name('users.Role');
    Route::post('/users/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assignRole');

    // Support Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/messages/conversations', [ChatController::class, 'getMessages'])->name('chat.messages');
    Route::post('/chat/send/{conversationId}', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/conversations/{conversationId}/user-info', [ConversationController::class, 'getUserInfo']);
    Route::get('/chat/messages/read/{conversationId}', [ChatController::class, 'markMessagesAsRead']);
    Route::get('/chat/messages/{id}/delete', [MessageController::class, 'deleteMessage']);
    // Route::put('/chat/messages/{id}/update', [MessageController::class, 'updateMessage']);

    Route::prefix('api')->group(base_path('routes/api.php'));

    Route::get('/conversation/closed/{conversation}', [ConversationController::class, 'close'])->name('conversation.down');

});



require __DIR__.'/auth.php';