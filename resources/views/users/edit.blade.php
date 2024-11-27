@extends('templates.app')

@section('content')
    <div class="container mx-auto my-10 p-8 bg-white shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Edit User</h2>

        @if (Session::get('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 fade-in" role="alert">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update_user', $user['id']) }}" method="POST" class="space-y-6">
            @method('PATCH')
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama User</label>
                <input type="text" name="name" id="name"
                    class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Masukkan Nama Produk" value="{{ old('name', $user['name']) }}">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Gmail</label>
                <input type="email" name="email" id="email"
                    class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Masukkan Email" value="{{ old('email', $user['email']) }}">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password"
                    class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Masukkan Password">
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select name="role" id="role"
                    class="mt-2 p-3 w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option selected disabled hidden>Pilih Role</option>
                    <option value="admin" {{ old('role', $user['role']) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="kasir" {{ old('role', $user['role']) == 'kasir' ? 'selected' : '' }}>Kasir</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary text-white font-bold py-2 px-6 rounded">
                    Update User
                </button>
            </div>
        </form>
    </div>

    @push('style')
        <style>
            .fade-in {
                animation: fadeIn 0.5s ease-out forwards;
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

            .btn-primary {
                background-color: #176a1e;
                transition: background-color 0.3s ease;
            }

            .btn-primary:hover {
                background-color: #149d20;
            }

            .form-control:focus {
                box-shadow: none;
                border: 1px solid #0d6efd;
            }

            .form-control {
                transition: all 0.3s ease;
            }

            .form-control:hover {
                background-color: #f1f5f8;
            }
        </style>
    @endpush
@endsection
