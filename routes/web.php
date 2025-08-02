<?php

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SubscriptionController;
use App\Models\Subscription;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

Route::get('/', [FrontendController::class,'home'])->name('home');


// Route::get('/articles', function () {
//     return Inertia::render('Articles');
// })->name('articles');

Route::get('/all-articles', [FrontendController::class, 'showAll'])->name('articles.all');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/faqs', function () {
    return Inertia::render('Faqs');
})->name('faqs');

Route::get('/single-article/{post:id}', [PostController::class, 'view'])->name('single-article');

Route::get('/registration', function () {
    return Inertia::render('Registration');
})->name('registration');


Route::middleware(['auth', 'IsSubscribe'])->prefix('admin')->group(function () {
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::get('admin-articles', function () {
        return Inertia::render('Admin/Admin-Articles');
    })->name('admin-articles');

    Route::get('subscription', [SubscriptionController::class, 'subscriptionDetail'])->name('subscription');
    Route::get('payment-logs', [SubscriptionController::class, 'paymentLogs'])->name('payment-logs');
    Route::resource(('posts'), PostController::class);
});


//subscription
Route::get('/plans', function () {
    return Inertia::render('Plans');
})->name('plans')->middleware('auth');
Route::group(['middleware' => ['auth']], function () {
    Route::post('/plans/subscription', [SubscriptionController::class, 'subscribe']);
    Route::get('/basic-plan', [SubscriptionController::class, 'showBasicPlan'])->name('basic-plan');
    Route::get('/premium-plan', [SubscriptionController::class, 'showPremiumPlan'])->name('premium-plan');
    Route::post('/cancel-subscription', [SubscriptionController::class, 'cancelSubscription'])->name('cancel-subscription');
    Route::post('/resume-subscription', [SubscriptionController::class, 'resumeSubscription'])->name('resume-subscription');
});

//Contact Email
Route::get('/contact-us', function () {
    return Inertia::render('ContactUs');
})->name('contact');
Route::post('/contact-us', [ContactController::class, 'send'])->name('contact.send');

