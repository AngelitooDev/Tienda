@extends('layouts.app')

@section('content')
    <h1>Seguimientos</h1>
    <a href="{{ route('trackings.create') }}" class="btn btn-primary">Crear Seguimiento</a>

    <ul>
        @foreach($trackings as $tracking)
            <li>
                <a href="{{ route('trackings.show', $tracking) }}">{{ $tracking->title }}</a>
            </li>
        @endforeach
    </ul>
@endsection
