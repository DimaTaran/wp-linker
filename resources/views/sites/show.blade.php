@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $site->name }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('sites.edit', $site) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Edit
                </a>
                <form action="{{ route('sites.destroy', $site) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                            onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Basic Info --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Basic Information</h3>
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Domain</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <a href="https://{{ $site->domain }}" target="_blank" class="text-blue-600 hover:text-blue-900">
                                    {{ $site->domain }}
                                </a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $site->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $site->status === 'suspended' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $site->status === 'archived' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{ ucfirst($site->status) }}
                                </span>
                            </dd>
                        </div>
                        @if($site->description)
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Description</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $site->description }}</dd>
                            </div>
                        @endif
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Created</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $site->created_at->format('M d, Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Updated</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $site->updated_at->format('M d, Y') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- WP Credentials --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">WordPress Credentials</h3>
                    @if($site->wpCredentials->count() > 0)
                        <div class="space-y-4">
                            @foreach($site->wpCredentials as $cred)
                                <div class="border rounded-lg p-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Admin URL</p>
                                            <a href="{{ $cred->admin_url }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-900">
                                                {{ $cred->admin_url }}
                                            </a>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Username</p>
                                            <p class="text-sm text-gray-900">{{ $cred->username }}</p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500">Role</p>
                                            <p class="text-sm text-gray-900">{{ $cred->role }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">No WordPress credentials added yet.</p>
                    @endif
                </div>
            </div>

            {{-- Servers --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Servers</h3>
                    @if($site->servers->count() > 0)
                        <div class="space-y-3">
                            @foreach($site->servers as $server)
                                <div class="flex items-center justify-between border rounded-lg p-4">
                                    <div class="flex-1">
                                        <p class="font-medium">{{ $server->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $server->ip_address }} | Role: {{ $server->pivot->server_role ?? 'N/A' }}</p>
                                        @if($server->pivot->is_primary)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 mt-1">
                                                Primary
                                            </span>
                                        @endif
                                    </div>
                                    <form action="{{ route('sites.detach-server', [$site, $server]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Remove</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">No servers attached yet.</p>
                    @endif
                </div>
            </div>

            {{-- CDNs --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">CDNs</h3>
                    @if($site->cdns->count() > 0)
                        <div class="space-y-3">
                            @foreach($site->cdns as $cdn)
                                <div class="flex items-center justify-between border rounded-lg p-4">
                                    <div class="flex-1">
                                        <p class="font-medium">{{ $cdn->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $cdn->provider }}</p>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium mt-1
                                            {{ $cdn->pivot->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $cdn->pivot->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                    <div class="flex gap-2">
                                        <form action="{{ route('sites.toggle-cdn', [$site, $cdn]) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-blue-600 hover:text-blue-900 text-sm">Toggle</button>
                                        </form>
                                        <form action="{{ route('sites.detach-cdn', [$site, $cdn]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Remove</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-sm">No CDNs attached yet.</p>
                    @endif
                </div>
            </div>

            {{-- Back Button --}}
            <div class="flex justify-start">
                <a href="{{ route('sites.index') }}" class="text-blue-600 hover:text-blue-900">
                    ← Back to Sites
                </a>
            </div>
        </div>
    </div>
@endsection

