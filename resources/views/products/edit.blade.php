@extends('templates.app')

@section('content')
    <div
        class="container mx-auto my-10 p-8 bg-gradient-to-br from-[#f9f9f9] via-[#f0f0f0] to-[#e0e0e0] shadow-xl rounded-lg">
        @if (Session::get('failed'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 fade-in" role="alert">
                <p>{{ Session::get('failed') }}</p>
            </div>
        @endif
        @if (Session::get('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 fade-in" role="alert">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        <h1 class="text-4xl font-extrabold text-[#6b4226] mb-8">Edit Produk</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-6">
                <label for="name" class="block text-lg font-semibold text-gray-700">Nama Produk</label>
                <input type="text" name="name" id="name"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-[#6b4226] focus:border-[#6b4226]"
                    placeholder="Masukkan Nama Produk" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="mb-6">
                <label for="description" class="block text-lg font-semibold text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-[#6b4226] focus:border-[#6b4226]"
                    placeholder="Masukkan Deskripsi Produk" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-6">
                <label for="price" class="block text-lg font-semibold text-gray-700">Harga</label>
                <input type="number" name="price" id="price"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-[#6b4226] focus:border-[#6b4226]"
                    placeholder="Masukkan Harga" value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="mb-6">
                <label for="stock" class="block text-lg font-semibold text-gray-700">Stok</label>
                <input type="number" name="stock" id="stock"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-[#6b4226] focus:border-[#6b4226]"
                    placeholder="Masukkan Stok" value="{{ old('stock', $product->stock) }}" required>
            </div>

            <div class="mb-6">
                <label for="type" class="block text-lg font-semibold text-gray-700">Tipe</label>
                <select name="type" id="type"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-[#6b4226] focus:border-[#6b4226]"
                    required>
                    <option value="Makanan" {{ old('type', $product->type) == 'Makanan' ? 'selected' : '' }}>Makanan
                    </option>
                    <option value="Minuman" {{ old('type', $product->type) == 'Minuman' ? 'selected' : '' }}>Minuman
                    </option>
                </select>
            </div>

            <div class="mb-6">
                <label for="img" class="block text-lg font-semibold text-gray-700">Gambar</label>
                <input type="file" name="img" id="img"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-[#6b4226] focus:border-[#6b4226]">
                @if ($product->img)
                    <div class="mt-4">
                        <p class="text-sm text-gray-500 mb-2">Gambar Saat Ini:</p>
                        <img src="{{ asset($product->img) }}" alt="Product Image"
                            class="rounded-lg shadow-md w-32 h-32 object-cover">
                    </div>
                @endif
            </div>

            <div class="text-right">
                <button type="submit" class="btn-primary text-white font-bold py-3 px-6 rounded-lg">
                    Update Produk
                </button>
            </div>
        </form>
    </div>
@endsection

@push('style')
    <style>
        .btn-primary {
            background-color: #6b4226;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #a0522d;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

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
