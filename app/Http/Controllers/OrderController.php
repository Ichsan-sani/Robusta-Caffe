<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Order;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index()
    {
        $tanggal = request('tanggal');
        $query = Order::with('user');

        if ($tanggal) {
            $query->whereDate('created_at', $tanggal);
        }

        $orders = $query->orderBy('created_at', "DESC")->simplePaginate(10);

        return view('orders.kasir.index', compact('orders', 'tanggal'));
    }

    public function create()
    {
        $items = Product::all();
        return view("orders.kasir.create", compact("items"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_customer' => 'required',
            'items' => 'required|array'
        ]);

        $arrayDistinct = array_count_values($request->items);
        $arrayAssocitems = [];
        $totalPrice = 0;

        foreach ($arrayDistinct as $id => $count) {
            $item = Product::findOrFail($id);

            if ($item->stock < $count) {
                return redirect()->back()
                    ->with('failed', "Stok obat {$item->name} : {$item->stock}. tidak mencukupi.")
                    ->withInput($request->all());
            }

            $subPrice = $item->price * $count;
            $totalPrice += $subPrice;

            $arrayAssocitems[] = [
                'id' => $id,
                'name_item' => $item->name,
                'qty' => $count,
                'price' => $item->price,
                'sub_price' => $subPrice
            ];
        }

        $priceWithPPN = $totalPrice + ($totalPrice * 0.1);

        $order = Order::create([
            'user_id' => Auth::id(),
            'items' => $arrayAssocitems,
            'name_customer' => $request->name_customer,
            'price' => $totalPrice,
            'total_price' => $priceWithPPN
        ]);

        foreach ($arrayAssocitems as $itemData) {
            $product = Product::find($itemData['id']);
            $product->stock -= $itemData['qty'];
            $product->save();
        }

        return redirect()->route('orders.print', $order->id)
            ->with('success', 'Pembelian berhasil dibuat');
    }

    public function show($id)
    {
        $order = Order::find($id);
        return view('orders.kasir.print', compact('order'));
    }

    public function downloadPDF($id)
    {
        $order = Order::find($id)->toArray();
        view()->share('order', $order);
        $pdf = Pdf::loadView('orders.kasir.download-pdf', compact('order'));
        return $pdf->download('struk_pembelian.pdf');
    }

    public function data()
    {
        $tanggal = request('tanggal');
        $query = Order::with('user');

        if ($tanggal) {
            $query->whereDate('created_at', $tanggal);
        }

        $orders = $query->orderBy('created_at', "DESC")->simplePaginate(10);

        return view('orders.admin.index', compact('orders', 'tanggal'));
    }

    public function exportExcel()
    {
        $file_name = 'Laporan Pembelian Obat.xlsx';
        return Excel::download(new OrdersExport, $file_name);
    }
}
