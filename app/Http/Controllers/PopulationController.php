<?php

namespace App\Http\Controllers;

use App\Models\Population;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PopulationController extends Controller
{
    public function index(Request $request)
    {
        $builder = Population::query();

        if ($request->has('country')) {
            $builder->where('country_name', $request->query('country'));
        }

        $populations = $builder->paginate(10);
        $worldPopulation = Population::query()->sum('population');
        $largestCountries = Population::query()->orderBy('ranking')->limit(20)->get();

        return view('index', compact('populations', 'worldPopulation', 'largestCountries'));
    }

    public function countries(Request $request): Collection
    {
        return Population::query()
            ->where('country_name', 'LIKE', "%{$request->query('q')}%")
            ->get('country_name')->pluck('country_name');
    }
}
