<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\Price;
use App\Services\ScraperService;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function store(Request $request, Tracking $tracking, ScraperService $scraper)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $price = $scraper->scrapePrice($request->url, '.product-price');

        $tracking->prices()->create([
            'url' => $request->url,
            'price' => $price,
        ]);

        return redirect()->route('trackings.show', $tracking)->with('success', 'URL agregada correctamente.');
    }
}
