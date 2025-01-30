<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackingController extends Controller
{
    public function index()
    {
        $trackings = Tracking::where('user_id', Auth::id())->get();
        return view('trackings.index', compact('trackings'));
    }

    public function create()
    {
        return view('trackings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $tracking = Tracking::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
        ]);

        return redirect()->route('trackings.show', $tracking)->with('success', 'Seguimiento creado correctamente.');
    }

    public function show(Tracking $tracking)
    {
        return view('trackings.show', compact('tracking'));
    }

    public function destroy(Tracking $tracking)
    {
        $tracking->delete();
        return redirect()->route('trackings.index')->with('success', 'Seguimiento eliminado correctamente.');
    }
}
