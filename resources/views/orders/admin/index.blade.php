@extends('templates.app')

@section('content')
    <div class="container mx-auto mt-5 p-6 bg-white shadow-md rounded-lg">
        @if (Session::get('deleted'))
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 fade-in" role="alert">
                {{ Session::get('deleted') }}
                <button type="button" class="close" aria-label="Close" onclick="this.parentElement.style.display='none';">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="flex justify-between mb-4">
            <form action="{{ url()->current() }}" method="GET" class="flex space-x-3">
                <input type="date" class="border border-gray-300 rounded-lg p-2" id="tanggal" name="tanggal"
                    value="{{ request('tanggal') }}">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Cari</button>
                <a href="{{ url()->current() }}"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400">Clear</a>
            </form>
            <a href="{{ route('orders.export-excel') }}"
                class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">Export Data (Excel)</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-center py-3 px-4 text-gray-700">No</th>
                        <th class="py-3 px-4 text-gray-700">Pembeli</th>
                        <th class="py-3 px-4 text-gray-700">Menu</th>
                        <th class="py-3 px-4 text-gray-700">Total Bayar</th>
                        <th class="py-3 px-4 text-gray-700">Kasir</th>
                        <th class="py-3 px-4 text-gray-700">Tanggal Beli</th>
                        <th class="py-3 px-4 text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($orders as $index => $item)
                        <tr>
                            <td class="text-center py-3 px-4">
                                {{ ($orders->currentPage() - 1) * $orders->perPage() + ($index + 1) }}</td>
                            <td class="py-3 px-4">{{ $item['name_customer'] }}</td>
                            <td class="py-3 px-4">
                                <ul>
                                    @foreach ($item['items'] as $product)
                                        <li>
                                            {{ $product['name_item'] }}
                                            ({{ number_format($product['price'], 0, ',', '.') }})
                                            : Rp {{ number_format($product['sub_price'], 0, ',', '.') }}
                                            <small class="text-gray-500">qty {{ $product['qty'] }}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="py-3 px-4">Rp {{ number_format($item['total_price'], 0, ',', '.') }}</td>
                            <td class="py-3 px-4">{{ $item['user']['name'] }}</td>
                            <td class="py-3 px-4">
                                {{ \Carbon\Carbon::parse($item->created_at)->timezone('Asia/Jakarta')->format('d F Y H:i:s') }}
                            </td>
                            <td class="text-center py-3 px-4">
                                <a href="{{ route('orders.download', $item['id']) }}"
                                    class="bg-gray-300 text-gray-700 px-2 py-1 rounded-lg hover:bg-gray-400">Download
                                    Struk</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-end my-3">
            @if ($orders->count())
                {{ $orders->links() }}
            @endif
        </div>
    </div>
@endsection

@push('style')
    <style>
        .fade-in {
            animation: fade In 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-responsive {
            margin-top: 20px;
        }
    </style>
@endpush
