<?php

namespace App\Console\Commands;

use App\Models\Population;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FindPopulations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populations:find';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find Populations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $headers = [
            'x-rapidapi-host' => 'world-population.p.rapidapi.com',
            'x-rapidapi-key' => 'ed74e2be46msha0be35e5f345febp17ac10jsn4262a33cbe07'
        ];

        $countriesNameUri = 'https://world-population.p.rapidapi.com/allcountriesname';
        $countryPopulationUri = 'https://world-population.p.rapidapi.com/population';

        $response = Http::withHeaders($headers)->get($countriesNameUri);
        $countries = $response->json('body.countries');

        foreach ($countries as $country) {
            $response = Http::withHeaders($headers)->get($countryPopulationUri, ['country_name' => $country]);
            Population::query()->create($response->json('body'));
        }
    }
}
