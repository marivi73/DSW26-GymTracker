<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead>
            <tr>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Descripción</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($categories as $category)
                <tr>
                    <td class="px-4 py-2">{{ $category->name }}</td>
                    <td class="px-4 py-2">{{ $category->description }}</td>
                    <td class="px-4 py-2 flex gap-2">
                        <form action="{{ route('categories.destroy', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">
                                Borrar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>