@extends('templates.app')
@section('content')
    <div class="container mx-auto mt-5 p-6 bg-white rounded-lg">
        @if (Session::get('deleted'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ Session::get('deleted') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="flex justify-between mb-6">
            <form action="{{ url()->current() }}" method="GET" class="flex gap-4">
                <div class="flex gap-2">
                    <input type="date" class="form-input p-2 border rounded-md" id="tanggal" name="tanggal"
                        value="{{ request('tanggal') }}">
                    <button type="submit"
                        class="btn btn-primary py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">Cari</button>
                    <a href="{{ url()->current() }}"
                        class="btn btn-secondary py-2 px-4 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none">Clear</a>
                </div>
            </form>
            <a href="{{ route('orders.create') }}"
                class="btn btn-primary py-2 px-6 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none">Pembelian
                Baru</a>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="py-3 px-6 text-center text-sm font-semibold">No</th>
                        <th class="py-3 px-6 text-sm font-semibold">Pembeli</th>
                        <th class="py-3 px-6 text-sm font-semibold">Obat</th>
                        <th class="py-3 px-6 text-sm font-semibold">Total Bayar</th>
                        <th class="py-3 px-6 text-sm font-semibold">Kasir</th>
                        <th class="py-3 px-6 text-sm font-semibold">Tanggal Beli</th>
                        <th class="py-3 px-6 text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $index => $item)
                        <tr class="border-t">
                            <td class="py-4 px-6 text-center">
                                {{ ($orders->currentPage() - 1) * $orders->perPage() + ($index + 1) }}</td>
                            <td class="py-4 px-6 text-sm">{{ $item['name_customer'] }}</td>
                            <td class="py-4 px-6 text-sm">
                                <ul class="list-disc pl-6">
                                    @foreach ($item['items'] as $product)
                                        <li>
                                            {{ $product['name_item'] }}
                                            ({{ number_format($product['price'], 0, ',', '.') }})
                                            : Rp {{ number_format($product['sub_price'], 0, ',', '.') }}
                                            <small>qty{{ $product['qty'] }}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="py-4 px-6 text-sm">Rp {{ number_format($item['total_price'], 0, ',', '.') }}</td>
                            <td class="py-4 px-6 text-sm">{{ $item['user']['name'] }}</td>
                            <td class="py-4 px-6 text-sm">
                                {{ \Carbon\Carbon::parse($item->created_at)->timezone('Asia/Jakarta')->Format('d F Y H:i:s') }}
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="{{ route('orders.download', $item['id']) }}"
                                    class="py-2 px-4 bg-gray-400 text-white rounded-md hover:bg-gray-500 focus:outline-none">Download
                                    Struk</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-end mt-6">
            @if ($orders->count())
                {{ $orders->links() }}
            @endif
        </div>
    </div>
@endsection
