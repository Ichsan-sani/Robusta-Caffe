@extends('templates.app')

@section('content')
    <div class="container mx-auto my-10 p-8 bg-gradient-to-r from-white via-gray-100 to-gray-200 shadow-xl rounded-lg">
        @if (Session::get('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 fade-in" role="alert">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-4xl font-bold text-gray-700">Manajemen User</h2>
            <a href="{{ route('users.create_user') }}"
                class="btn-primary transition-all text-white font-bold py-3 px-6 rounded-full shadow-md hover:shadow-lg">
                + Tambah User
            </a>
        </div>

        <div class="overflow-hidden rounded-lg shadow">
            <table class="w-full table-auto bg-white">
                <thead>
                    <tr class="bg-gray-800 text-white uppercase text-sm leading-normal">
                        <th class="py-4 px-6 text-left">#</th>
                        <th class="py-4 px-6 text-left">Nama</th>
                        <th class="py-4 px-6 text-left">Email</th>
                        <th class="py-4 px-6 text-left">Role</th>
                        <th class="py-4 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-medium">
                    @if ($users->count() > 0)
                        @foreach ($users as $index => $user)
                            <tr class="hover:bg-gray-100 transition-all border-b border-gray-200">
                                <td class="py-4 px-6 text-left">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + ($index + 1) }}
                                </td>
                                <td class="py-4 px-6 text-left">{{ $user['name'] }}</td>
                                <td class="py-4 px-6 text-left">{{ $user['email'] }}</td>
                                <td class="py-4 px-6 text-left">{{ ucfirst($user['role']) }}</td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex justify-center items-center space-x-3">
                                        <a href="{{ route('users.edit_user', $user['id']) }}"
                                            class="btn-info text-white font-bold py-2 px-4 rounded-lg shadow hover:shadow-lg">
                                            Edit
                                        </a>
                                        <form action="{{ route('users.delete_user', $user['id']) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit"
                                                class="btn-danger text-white font-bold py-2 px-4 rounded-lg shadow hover:shadow-lg">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="py-4 px-6 text-center text-gray-500">Tidak ada user yang ditemukan.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end">
            {{ $users->links() }}
        </div>
    </div>
@endsection

@push('style')
    <style>
        .btn-primary {
            background-color: #1d4ed8;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            background-color: #2563eb;
            transform: scale(1.02);
        }

        .btn-info {
            background-color: #10b981;
        }

        .btn-info:hover {
            background-color: #059669;
        }

        .btn-danger {
            background-color: #ef4444;
        }

        .btn-danger:hover {
            background-color: #dc2626;
        }

        .fade-in {
            animation: fadeInUp 0.5s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach((row, i) => {
                row.style.animationDelay = `${i * 0.1}s`;
                row.classList.add('fade-in');
            });
        });
    </script>
@endpush
