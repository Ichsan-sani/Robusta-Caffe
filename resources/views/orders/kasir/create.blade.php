@extends('templates.app')
@section('content')
    <div class="container mx-auto my-8 px-4">
        <form action="{{ route('orders.store') }}" method="POST"
            class="card bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-auto">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::get('failed'))
                <div class="alert alert-danger bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                    {!! nl2br(e(Session::get('failed'))) !!}
                </div>
            @endif

            <p class="text-lg font-semibold mb-4">Penanggung jawab: <b>{{ Auth::user()->name }}</b></p>

            <div class="mb-6">
                <label for="name_customer" class="block text-sm font-medium text-gray-700">Nama Pembeli</label>
                <input type="text" id="name_customer" name="name_customer"
                    class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    value="{{ old('name_customer') }}" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Obat</label>
                <div id="items-container">
                    <div class="item-row mb-4">
                        <select name="items[]" class="form-select w-full p-2 border border-gray-300 rounded-md" required>
                            <option value="">Pilih Obat</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}" data-stock="{{ $item->stock }}"
                                    data-price="{{ $item->price }}">
                                    {{ $item->name }} (Stok: {{ $item->stock }}, Harga:
                                    {{ number_format($item->price) }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="additional-items"></div>
                    <button type="button" id="add-item"
                        class="mt-2 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none">+
                        Tambah Pesanan</button>
                </div>
            </div>

            <button type="submit"
                class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none transition-all">Konfirmasi
                Pembelian</button>
        </form>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            let itemCount = 1;

            $('#add-item').click(function() {
                itemCount++;
                let newItemRow = `
                    <div class="item-row relative mb-4">
                        <select name="items[]" class="form-select w-full p-2 border border-gray-300 rounded-md" required>
                            <option value="">Pilih Obat</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}" data-stock="{{ $item->stock }}" data-price="{{ $item->price }}">
                                    {{ $item->name }} (Stok: {{ $item->stock }}, Harga: {{ number_format($item->price) }})
                                </option>
                            @endforeach
                        </select>
                        <button type="button" class="remove-item absolute top-0 right-0 mt-2 mr-2 bg-red-600 text-white px-2 py-1 rounded-full text-xs hover:bg-red-700 focus:outline-none">X</button>
                    </div>
                `;
                $('#additional-items').append(newItemRow);
            });

            $(document).on('click', '.remove-item', function() {
                $(this).closest('.item-row').remove();
            });
        });
    </script>
@endpush
