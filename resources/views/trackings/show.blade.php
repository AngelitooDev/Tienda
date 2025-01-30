@extends('layouts.app')

@section('content')
    <h1>{{ $tracking->title }}</h1>
    <h2>Precios Guardados</h2>
    <ul>
        @foreach($tracking->prices as $price)
            <li>{{ $price->url }} - {{ $price->price ? '$' . $price->price : 'No disponible' }}</li>
        @endforeach
    </ul>

    <h3>Agregar URL</h3>
    <form action="{{ route('prices.store', $tracking) }}" method="POST">
        @csrf
        <input type="url" name="url" placeholder="URL del producto" required>
        <button type="submit">Agregar</button>
    </form>
@endsection
