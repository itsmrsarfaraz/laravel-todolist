<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Todos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('todos.create') }}"
                   class="mb-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
                    + New Todo
                </a>

                @forelse($todos as $todo)
                    <div class="border p-4 mb-2 rounded flex justify-between items-center">
                        <div class="flex items-center space-x-4">
                            <!-- Quick Toggle Form -->
                            <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="checkbox" 
                                    onchange="this.form.submit()" 
                                    {{ $todo->is_completed ? 'checked' : '' }} 
                                    class="rounded border-gray-300 text-blue-600 shadow-sm">
                            </form>

                            <div>
                                <h3 class="font-bold {{ $todo->is_completed ? 'line-through text-gray-400' : '' }}">
                                    {{ $todo->title }}
                                </h3>
                                <p class="text-gray-600 text-sm">{{ $todo->description }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('todos.edit', $todo) }}" class="text-blue-500">Edit</a>
                            
                            <form action="{{ route('todos.destroy', $todo) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">No todos yet. Create one!</p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>