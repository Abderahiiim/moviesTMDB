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
                        <a href="{{ route('admin.edit', $movie->id) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
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
@endsection
