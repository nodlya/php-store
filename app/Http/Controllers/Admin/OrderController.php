<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::orderBy('status', 'asc')->paginate(5);
        $statuses = Order::STATUSES;
        return view('admin.order.index',compact('orders', 'statuses'));
    }
    /* ... */
    public function show(Order $order) {
        $statuses = Order::STATUSES;
        return view('admin.order.show', compact('order', 'statuses'));
    }
    /* ... */
    public function edit(Order $order) {
        $statuses = Order::STATUSES;
        return view('admin.order.edit', compact('order', 'statuses'));
    }

    /**
     * Обновляет заказ покупателя
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order) {
        $order->update($request->all());
        return redirect()
            ->route('admin.order.show', ['order' => $order->id])
            ->with('success', 'Заказ был успешно обновлен');
    }


}
