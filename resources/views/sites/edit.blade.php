@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Site: {{ $site->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('sites.update', $site) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Site Name *</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $site->name) }}" required
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Domain --}}
                        <div class="mb-4">
                            <label for="domain" class="block text-sm font-medium text-gray-700 mb-2">Domain *</label>
                            <input type="text" name="domain" id="domain" value="{{ old('domain', $site->domain) }}" required
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('domain')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" id="description" rows="4"
                                      class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $site->description) }}</textarea>
                            @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="mb-6">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" id="status"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="active" {{ old('status', $site->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="suspended" {{ old('status', $site->status) === 'suspended' ? 'selected' : '' }}>Suspended</option>
                                <option value="archived" {{ old('status', $site->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                            @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('sites.show', $site) }}" class="text-gray-600 hover:text-gray-900">Cancel</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                Update Site
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

