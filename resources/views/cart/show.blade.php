@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Carrito de Pedidos</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif

    @if(empty($cart) || count($cart) === 0)
        <div class="p-6 bg-gray-50 rounded text-gray-600">Tu carrito está vacío.</div>
    @else
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3">Producto</th>
                        <th class="p-3">Precio</th>
                        <th class="p-3">Cantidad</th>
                        <th class="p-3">Subtotal</th>
                        <th class="p-3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        <tr class="border-t">
                            <td class="p-3 align-top">
                                <div class="font-semibold">{{ $item['nombre'] }}</div>
                            </td>
                            <td class="p-3 align-top">${{ number_format($item['precio'], 0, ',', '.') }}</td>
                            <td class="p-3 align-top">
                                <form method="post" action="{{ route('cart.update') }}" class="flex items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="platillo_id" value="{{ $item['id'] }}">
                                    <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" class="w-20 border rounded px-2 py-1">
                                    <button class="px-3 py-1 bg-fp-orange text-white rounded">Actualizar</button>
                                </form>
                            </td>
                            <td class="p-3 align-top">${{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                            <td class="p-3 align-top">
                                <form method="post" action="{{ route('cart.remove') }}">
                                    @csrf
                                    <input type="hidden" name="platillo_id" value="{{ $item['id'] }}">
                                    <button class="px-3 py-1 bg-red-500 text-white rounded">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4 bg-gray-50 flex justify-end items-center gap-4">
                <div class="text-lg font-bold">Total: <span class="text-fp-orange">${{ number_format($total, 0, ',', '.') }}</span></div>
            </div>
        </div>
    @endif

    <div class="mt-6">
        <a href="{{ route('menu-digital') }}" class="px-4 py-2 bg-gray-200 rounded">Seguir comprando</a>
    </div>
</div>
@endsection
