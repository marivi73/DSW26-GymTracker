@props(['exercises'])

<table class="min-w-full border border-gray-200 dark:border-gray-700">
    <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
            <th class="px-4 py-2 text-left">Nombre</th>
            <th class="px-4 py-2 text-left">Categoría</th>
            <th class="px-4 py-2 text-left">Descripción</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($exercises as $exercise)
            <tr class="border-t dark:border-gray-600">
                <td class="px-4 py-2 font-semibold">
                    {{ $exercise->name }}
                </td>
                <td class="px-4 py-2">
                    {{ $exercise->category->name ?? '—' }}
                </td>
                <td class="px-4 py-2">
                    {{ $exercise->description ?? '—' }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                    No hay ejercicios disponibles
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
