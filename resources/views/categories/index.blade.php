<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categorías') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- ERRORES --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- MENSAJES --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @auth
                        {{-- FORM CREAR CATEGORÍA --}}
                        <form action="{{ route('categories.store') }}" method="POST" class="mb-6">
                            @csrf

                            <div class="mb-4">
                                <label class="block text-sm font-medium">Nombre</label>
                                <input type="text" name="name"
                                    class="mt-1 block w-full rounded-md dark:bg-gray-700"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium">Descripción</label>
                                <textarea name="description" rows="3"
                                    class="mt-1 block w-full rounded-md dark:bg-gray-700"></textarea>
                            </div>

                            <button
                                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                Crear categoría
                            </button>
                        </form>
                    @endauth

                    {{-- TABLA --}}
                    <x-category-table :categories="$categories" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
