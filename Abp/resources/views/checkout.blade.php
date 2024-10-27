@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    <h2>Gracias por su compra</h2>
    <p>Su pago ha sido procesado exitosamente.</p>
</div>
@endsection
