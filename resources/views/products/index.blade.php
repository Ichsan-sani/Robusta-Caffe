@extends('templates.app')

@section('content')
    <div class="container mx-auto my-10 p-8 bg-white shadow-lg rounded-lg border border-gray-200">
        @if (Session::get('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 fade-in" role="alert">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-extrabold text-[#6b4226]">Menu Produk</h1>
            <a href="{{ route('products.create') }}"
                class="bg-[#6b4226] text-white font-bold py-3 px-6 rounded-full shadow-md hover:shadow-lg transition duration-300 ease-in-out">
                Tambah Produk
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-[#6b4226] text-white text-left">
                        <th class="py-3 px-4">Gambar</th>
                        <th class="py-3 px-4">Nama Produk</th>
                        <th class="py-3 px-4">Jenis</th>
                        <th class="py-3 px-4">Harga</th>
                        <th class="py-3 px-4">Stok</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($products->count() > 0)
                        @foreach ($products as $product)
                            <tr class="border-b hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="py-4 px-4">
                                    @php
                                        // dd($product['img']);
                                    @endphp
                                    <img src="{{ asset($product['img']) }}" alt="{{ $product['name'] }}"
                                        class="w-16 h-16 object-cover rounded-lg shadow">
                                </td>
                                <td class="py-4 px-4 text-gray-800 font-medium">{{ $product['name'] }}</td>
                                <td class="py-4 px-4 text-gray-600">{{ $product['type'] }}</td>
                                <td class="py-4 px-4 text-[#6b4226] font-semibold">
                                    Rp{{ number_format($product['price'], 0, ',', '.') }}</td>
                                <td class="py-4 px-4">
                                    <span
                                        class="py-1 px-3 rounded-full text-xs font-bold {{ $product['stock'] <= 3 ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-700' }}">
                                        {{ $product['stock'] <= 3 ? 'Stok Rendah' : 'Tersedia' }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 flex space-x-2">
                                    <a href="{{ route('products.edit', $product['id']) }}"
                                        class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out hover:bg-blue-600">
                                        Edit
                                    </a>
                                    <form action="{{ route('products.delete', $product['id']) }}" method="POST"
                                        class="inline-block">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                            class="bg-red-500 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center text-gray-600 py-4">Belum ada produk yang tersedia.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-center">
            {{ $products->links() }}
        </div>
    </div>
@endsection

@push('style')
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
