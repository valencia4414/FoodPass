<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platillo;

class CartController extends Controller
{
    public function show(Request $request)
    {
        $cart = $request->session()->get('cart', []);

        // compute subtotal per item and total
        $total = 0;
        foreach ($cart as $key => $item) {
            $cart[$key]['subtotal'] = $item['precio'] * $item['cantidad'];
            $total += $cart[$key]['subtotal'];
        }

        return view('cart.show', [
            'cart' => $cart,
            'total' => $total,
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'platillo_id' => 'required|integer|exists:platillos,id',
            'cantidad' => 'nullable|integer|min:1',
        ]);

        $platillo = Platillo::find($request->platillo_id);
        $cantidad = $request->input('cantidad', 1);

        $cart = $request->session()->get('cart', []);

        if (isset($cart[$platillo->id])) {
            $cart[$platillo->id]['cantidad'] += $cantidad;
        } else {
            $cart[$platillo->id] = [
                'id' => $platillo->id,
                'nombre' => $platillo->nombre,
                'precio' => (float) $platillo->precio,
                'cantidad' => $cantidad,
            ];
        }

        $request->session()->put('cart', $cart);

        return back()->with('success', 'Producto añadido al carrito.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'platillo_id' => 'required|integer',
            'cantidad' => 'required|integer|min:1',
        ]);

        $cart = $request->session()->get('cart', []);
        $id = $request->platillo_id;
        $cantidad = $request->cantidad;

        if (isset($cart[$id])) {
            $cart[$id]['cantidad'] = $cantidad;
            $request->session()->put('cart', $cart);
            return back()->with('success', 'Cantidad actualizada.');
        }

        return back()->with('error', 'Producto no encontrado en el carrito.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'platillo_id' => 'required|integer',
        ]);

        $cart = $request->session()->get('cart', []);
        $id = $request->platillo_id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $request->session()->put('cart', $cart);
            return back()->with('success', 'Producto eliminado del carrito.');
        }

        return back()->with('error', 'Producto no encontrado en el carrito.');
    }
}
