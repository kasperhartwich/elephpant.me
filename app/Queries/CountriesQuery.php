<?php

declare(strict_types=1);

namespace App\Queries;

use Illuminate\Support\Collection;
use Rinvex\Country\CountryLoader;

final class CountriesQuery
{
    public function fetchAll(): Collection
    {
        return collect(CountryLoader::countries())
            ->mapWithKeys(fn (array $country): array => [
                $country['iso_3166_1_alpha3'] => collect([
                    'cca3' => $country['iso_3166_1_alpha3'],
                    'cca2' => $country['iso_3166_1_alpha2'],
                    'name' => $country['name'],
                    'flag' => 'fi fi-'.strtolower($country['iso_3166_1_alpha2']),
                ]),
            ])
            ->sortBy(fn (Collection $country): string => $country->get('name'));
    }
}
