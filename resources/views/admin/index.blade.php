@extends('layouts.app') <!-- Make sure the path matches -->

@section('title', 'Page Title')

@section('content')

<div class="container mx-auto p-4 mt-10">
    <h1 class="text-2xl font-bold mb-4 playwrite-cu">Movies List</h1>

    <!-- Search Form -->
    <form action="{{ route('admin.index') }}" method="GET" class="mb-6">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title..."
            class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Search</button>
    </form>

    <!-- Movies Table -->
    <table class="min-w-full divide-y divide-gray-200 border border-gray-500 mb-10">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-500">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-500">Release Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-500">Language</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-500">Rating</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-500">Vote Count</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-500">Popularity</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border border-gray-500">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($movies as $movie)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">{{ $movie->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $movie->release_date }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $movie->language }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ round($movie->vote_average) }}/10</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $movie->vote_count }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $movie->popularity }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.show', $movie->id) }}" class="text-blue-500 hover:text-blue-700">Show</a>
                        <button type="button" onclick="openEditModal({{ $movie }})" class="text-yellow-500 hover:text-yellow-700">Edit</button>
                        <form action="{{ route('admin.destroy', $movie->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this movie?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $movies->links() }}
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded-lg w-1/2">
        <h2 class="text-xl font-bold mb-4">Edit Movie</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="movieId">
            
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="editTitle" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label for="release_date" class="block text-sm font-medium text-gray-700">Release Date</label>
                <input type="date" name="release_date" id="editReleaseDate" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label for="language" class="block text-sm font-medium text-gray-700">Language</label>
                <input type="text" name="language" id="editLanguage" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label for="vote_average" class="block text-sm font-medium text-gray-700">Rating</label>
                <input type="number" step="0.1" name="vote_average" id="editVoteAverage" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label for="vote_count" class="block text-sm font-medium text-gray-700">Vote Count</label>
                <input type="number" name="vote_count" id="editVoteCount" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label for="popularity" class="block text-sm font-medium text-gray-700">Popularity</label>
                <input type="number" step="0.1" name="popularity" id="editPopularity" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            </div>

            <div class="flex justify-end">
                <button type="button" onclick="closeEditModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(movie) {
        // Populate the form inputs with movie data
        document.getElementById('movieId').value = movie.id;
        document.getElementById('editTitle').value = movie.title;
        document.getElementById('editReleaseDate').value = movie.release_date;
        document.getElementById('editLanguage').value = movie.language;
        document.getElementById('editVoteAverage').value = movie.vote_average;
        document.getElementById('editVoteCount').value = movie.vote_count;
        document.getElementById('editPopularity').value = movie.popularity;

        // Set the form action to the update route
        document.getElementById('editForm').action = `/admin/${movie.id}`;

        // Show the modal
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>

@endsection
