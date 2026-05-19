@extends('layouts.customer')

@section('title', 'My Teams')
@section('breadcrumb', 'My Teams')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">My Teams</h2>
            <p class="text-gray-600 mt-1">Manage your teams and team members</p>
        </div>
        <a href="{{ route('customer.teams.create') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors">
            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Team
        </a>
    </div>
</div>

<!-- Teams Grid -->
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($teams as $team)
        <div class="bg-white rounded-lg shadow-sm p-6 hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $team->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $team->members_count }} members</p>
                    </div>
                </div>
                @if($team->is_owner)
                    <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">Owner</span>
                @endif
            </div>

            <p class="text-sm text-gray-600 mb-4">{{ $team->description ?? 'No description' }}</p>

            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <a href="{{ route('customer.teams.show', $team) }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                    View Details →
                </a>
                @if($team->is_owner)
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('customer.teams.edit', $team) }}" class="p-1 text-gray-600 hover:text-gray-900">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('customer.teams.destroy', $team) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1 text-red-600 hover:text-red-700" onclick="return confirm('Are you sure?')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full bg-white rounded-lg shadow-sm p-12 text-center">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No teams yet</h3>
            <p class="text-gray-600 mb-6">Create your first team to collaborate with others.</p>
            <a href="{{ route('customer.teams.create') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors">
                Create Your First Team
            </a>
        </div>
    @endforelse
</div>

@if(isset($teams) && $teams->hasPages())
    <div class="mt-6">
        {{ $teams->links() }}
    </div>
@endif
@endsection
