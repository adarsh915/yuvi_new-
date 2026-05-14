<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $settings = \App\Models\SiteSetting::all()->pluck('value', 'key')->toArray();
            $view->with('siteSettings', $settings);
        });

        View::composer('frontend.*', function ($view) {
            $currentRoute = \Route::currentRouteName();
            $identifier = str_replace('frontend.', '', $currentRoute);
            
            // Map specific naming differences if any
            $map = [
                'index' => 'home',
                'blogDetails' => 'blog', // Default to blog SEO for details if not set
                'serviceDetail' => 'services',
            ];
            
            $identifier = $map[$identifier] ?? $identifier;
            
            $seo = \App\Models\SeoSetting::where('page_identifier', $identifier)->first();
            
            $data = $view->getData();
            $settings = $data['siteSettings'] ?? [];
            $siteName = $settings['site_title'] ?? 'Dr. Yuvraj Jadeja';
            
            $defaultDescription = 'Ethical, evidence-based fertility and women\'s health care in Ahmedabad.';
            $defaultKeywords = 'fertility, IVF, Ahmedabad, Dr. Yuvraj Jadeja';
            
            // Priority: 1. Manually passed data in controller, 2. SEO Setting DB, 3. Default Site Settings
            $metaTitle = $data['meta_title'] ?? ($seo->meta_title ?? null);
            $metaDescription = $data['meta_description'] ?? ($seo->meta_description ?? $defaultDescription);
            $metaKeywords = $data['meta_keywords'] ?? ($seo->meta_keywords ?? $defaultKeywords);
            $ogImage = $data['og_image'] ?? ($seo->og_image ?? ($settings['og_image'] ?? null));

            $view->with([
                'seoTitle' => $metaTitle ? "$metaTitle | $siteName" : $siteName,
                'seoDescription' => $metaDescription,
                'seoKeywords' => $metaKeywords,
            ]);
        });
    }
}
