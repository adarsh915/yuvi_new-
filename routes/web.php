<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\QuizController;
use App\Http\Controllers\ContactFieldController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TreatmentTypeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\NotificationController;

// Frontend Routes
Route::name('frontend.')->group(function () {
    Route::controller(FrontendController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/about', 'about')->name('about');
        Route::get('/blog', 'blog')->name('blog');
        Route::get('/blog/{slug}', 'blogDetails')->name('blogDetails');
        Route::get('/contact', 'contact')->name('contact');
        Route::post('/contact/submit', 'contactSubmit')->name('contact.submit');
        Route::get('/faq', 'faq')->name('faq');
        Route::get('/gallery', 'gallery')->name('gallery');
        Route::get('/privacy-policy', 'privacyPolicy')->name('privacyPolicy');
        Route::get('/quiz', 'quiz')->name('quiz');
        Route::post('/quiz/submit', 'quizSubmit')->name('quiz.submit');
        Route::get('/service/{slug}', 'serviceDetail')->name('serviceDetail');
        Route::get('/services', 'services')->name('services');
        Route::get('/success-stories', 'successStories')->name('successStories');
        Route::get('/team', 'team')->name('team');
        Route::get('/media', 'media')->name('media');
    });
});


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/leads', 'leads')->name('leads');
        Route::get('/leads/export/csv', 'exportLeadsCsv')->name('leads.export.csv');
        Route::get('/leads/{lead}', 'leadDetails')->name('leads.details');
        Route::delete('/leads/{lead}', 'destroyLead')->name('leads.destroy');
        Route::get('/settings', 'settings')->name('settings');
        Route::post('/settings/update', 'settingsUpdate')->name('settings.update');
    });

    Route::controller(FaqController::class)->prefix('faqs')->group(function () {
        Route::get('/', 'index')->name('faqs');
        Route::post('/store', 'store')->name('faqs.store');
        Route::put('/{faq}', 'update')->name('faqs.update');
        Route::delete('/{faq}', 'destroy')->name('faqs.destroy');
    });

    Route::controller(FaqCategoryController::class)->prefix('faq-categories')->group(function () {
        Route::get('/', 'index')->name('faq.categories');
        Route::post('/store', 'store')->name('faq.categories.store');
        Route::put('/{faqCategory}', 'update')->name('faq.categories.update');
        Route::delete('/{faqCategory}', 'destroy')->name('faq.categories.destroy');
    });

    Route::controller(SliderController::class)->prefix('sliders')->group(function () {
        Route::get('/', 'index')->name('sliders');
        Route::get('/create', 'create')->name('sliders.create');
        Route::post('/store', 'store')->name('sliders.store');
        Route::get('/{slider}/edit', 'edit')->name('sliders.edit');
        Route::put('/{slider}', 'update')->name('sliders.update');
        Route::delete('/{slider}', 'destroy')->name('sliders.destroy');
    });

    Route::controller(StoryController::class)->prefix('stories')->group(function () {
        Route::get('/', 'index')->name('stories');
        Route::post('/store', 'store')->name('stories.store');
        Route::put('/{story}', 'update')->name('stories.update');
        Route::delete('/{story}', 'destroy')->name('stories.destroy');
    });

    Route::controller(TreatmentTypeController::class)->prefix('treatment-types')->group(function () {
        Route::get('/', 'index')->name('treatment-types');
        Route::post('/store', 'store')->name('treatment-types.store');
        Route::put('/{treatmentType}', 'update')->name('treatment-types.update');
        Route::delete('/{treatmentType}', 'destroy')->name('treatment-types.destroy');
    });

    Route::controller(GalleryController::class)->prefix('gallery')->group(function () {
        Route::get('/', 'index')->name('gallery');
        Route::post('/store', 'store')->name('gallery.store');
        Route::put('/{gallery}', 'update')->name('gallery.update');
        Route::delete('/{gallery}', 'destroy')->name('gallery.destroy');
    });

    Route::controller(TestimonialController::class)->prefix('testimonials')->group(function () {
        Route::get('/', 'index')->name('testimonials');
        Route::post('/store', 'store')->name('testimonials.store');
        Route::put('/{testimonial}', 'update')->name('testimonials.update');
        Route::delete('/{testimonial}', 'destroy')->name('testimonials.destroy');
    });

    Route::controller(QuizController::class)->prefix('quiz')->group(function () {
        Route::get('/questions', 'index')->name('quiz.questions');
        Route::post('/questions', 'store')->name('quiz.questions.store');
        Route::put('/questions/{quizQuestion}', 'update')->name('quiz.questions.update');
        Route::delete('/questions/{quizQuestion}', 'destroy')->name('quiz.questions.destroy');
        Route::get('/submissions', 'submissions')->name('quiz.submissions');
        Route::get('/submissions/export', 'exportSubmissions')->name('quiz.submissions.export');
        Route::get('/submissions/{submission}/print', 'printSubmission')->name('quiz.submissions.print');
        Route::get('/submissions/{submission}', 'submissionDetails')->name('quiz.submissions.details');
        Route::delete('/submissions/{submission}', 'destroySubmission')->name('quiz.submissions.destroy');
    });

    Route::controller(BlogController::class)->prefix('blogs')->group(function () {
        Route::get('/', 'index')->name('blogs');
        Route::get('/create', 'create')->name('blogs.create');
        Route::post('/store', 'store')->name('blogs.store');
        Route::get('/{blog}/edit', 'edit')->name('blogs.edit');
        Route::put('/{blog}', 'update')->name('blogs.update');
        Route::delete('/{blog}', 'destroy')->name('blogs.destroy');
    });

    Route::controller(CategoryController::class)->prefix('categories')->group(function () {
        Route::get('/', 'index')->name('categories');
        Route::post('/store', 'store')->name('categories.store');
        Route::put('/{category}', 'update')->name('categories.update');
        Route::delete('/{category}', 'destroy')->name('categories.destroy');
    });

    Route::controller(ContactFieldController::class)->prefix('contact-fields')->group(function () {
        Route::get('/', 'index')->name('contact.fields');
        Route::post('/', 'store')->name('contact.fields.store');
        Route::put('/{contactField}', 'update')->name('contact.fields.update');
        Route::delete('/{contactField}', 'destroy')->name('contact.fields.destroy');
    });

    Route::controller(ServiceController::class)->prefix('services')->group(function () {
        Route::get('/', 'index')->name('services');
        Route::get('/create', 'create')->name('services.create');
        Route::post('/store', 'store')->name('services.store');
        Route::get('/{service}/edit', 'edit')->name('services.edit');
        Route::put('/{service}', 'update')->name('services.update');
        Route::delete('/{service}', 'destroy')->name('services.destroy');
    });

    Route::controller(ServiceCategoryController::class)->prefix('service-categories')->group(function () {
        Route::get('/', 'index')->name('service.categories');
        Route::post('/store', 'store')->name('service.categories.store');
        Route::put('/{serviceCategory}', 'update')->name('service.categories.update');
        Route::delete('/{serviceCategory}', 'destroy')->name('service.categories.destroy');
    });

    Route::controller(NotificationController::class)->prefix('notifications')->group(function () {
        Route::get('/', 'index')->name('notifications');
        Route::get('/mark-read/{type}/{id}', 'markAsRead')->name('notifications.markRead');
        Route::get('/mark-all-read', 'markAllAsRead')->name('notifications.markAllRead');
    });
});

// Authentication
Route::prefix('authentication')->group(function () {
    Route::controller(AuthenticationController::class)->group(function () {
        Route::get('/signin', 'signin')->name('signin');
        Route::post('/login', 'login')->name('admin.login.post');
        Route::post('/logout', 'logout')->name('admin.logout');
        Route::get('/signup', 'signup')->name('signup');
        
        // Password Reset
        Route::get('/forgot-password', 'forgotPassword')->name('password.request');
        Route::post('/forgot-password', 'sendResetLink')->name('password.email');
        Route::get('/reset-password/{token}', 'resetPassword')->name('password.reset');
        Route::post('/reset-password', 'updatePassword')->name('password.update');
    });
});
