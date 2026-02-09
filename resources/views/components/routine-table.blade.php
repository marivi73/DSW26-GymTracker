@props(['routines'])

<table class="min-w-full border border-gray-200 dark:border-gray-700">
    <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
            <th class="px-4 py-2 text-left">Nombre</th>
            <th class="px-4 py-2 text-left">Descripción</th>
            <th class="px-4 py-2 text-left">Acciones</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($routines as $routine)
            <tr class="border-t dark:border-gray-600">
                <td class="px-4 py-2 font-semibold">
                    {{ $routine->name }}
                </td>
                <td class="px-4 py-2">
                    {{ $routine->description ?? '—' }}
                </td>
                <td class="px-4 py-2">
                    <a href="{{ route('routines.show', $routine) }}"
                       class="text-indigo-600 hover:underline">
                        Ver detalle
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                    No hay rutinas disponibles
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
