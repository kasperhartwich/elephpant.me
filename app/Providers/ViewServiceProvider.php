<?php

namespace App\Providers;

use App\Queries\CountriesQuery;
use App\Queries\UsersCountryQuery;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer(['auth.register', 'profile.edit'], function ($view) {
            $view->with('countries', (new CountriesQuery())->fetchAll());
        });

        View::composer(['ranking.index', 'trade._user', 'herd.show', 'trade.index'], function ($view) {
            $userCountryCodes = (new UsersCountryQuery())->fetchAll()
                ->pluck('country_code')
                ->unique()
                ->all();

            $countries = (new CountriesQuery())->fetchAll()
                ->filter(fn ($country) => in_array($country->get('cca3'), $userCountryCodes, true));

            $view->with('countries', $countries);
        });
    }
}
