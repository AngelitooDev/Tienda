@extends('layouts.app')

@section('content')
    <h1>Nuevo Seguimiento</h1>
    <form action="{{ route('trackings.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Nombre del producto" required>
        <button type="submit">Crear</button>
    </form>
@endsection
