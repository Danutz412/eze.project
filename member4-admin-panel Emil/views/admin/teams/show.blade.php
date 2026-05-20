@extends('layouts.admin')

@section('title', 'Team Details')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.teams.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
            ← Back to Teams
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">{{ $team->name }}</h1>
        @if($team->description)
            <p class="text-gray-600 mt-1">{{ $team->description }}</p>
        @endif
    </div>

    <div class="grid md:grid-cols-2 gap-6 mb-6">
        <!-- Team Information -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Team Information</h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm text-gray-600">Owner</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $team->owner->name }} ({{ $team->owner->email }})</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-600">Type</dt>
                    <dd>
                        <span class="px-2 py-1 text-xs rounded-full {{ $team->is_personal ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                            {{ $team->is_personal ? 'Personal' : 'Business' }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-600">Created</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $team->created_at->format('F j, Y, g:i A') }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-600">Last Updated</dt>
                    <dd class="text-sm font-medium text-gray-900">{{ $team->updated_at->format('F j, Y, g:i A') }}</dd>
                </div>
            </dl>
        </div>

        <!-- License Management -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">License Management</h3>
            <dl class="space-y-3 mb-4">
                <div>
                    <dt class="text-sm text-gray-600">Total Licenses</dt>
                    <dd class="text-2xl font-bold text-gray-900">{{ $team->total_licenses }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-600">Used Licenses</dt>
                    <dd class="text-2xl font-bold text-green-600">{{ $team->used_licenses }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-600">Pending Invitations</dt>
                    <dd class="text-2xl font-bold text-yellow-600">{{ $team->pending_invitations }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-600">Available Licenses</dt>
                    <dd class="text-2xl font-bold text-blue-600">{{ $team->remaining_licenses }}</dd>
                </div>
            </dl>

            <form method="POST" action="{{ route('admin.teams.adjust-licenses', $team) }}" class="mt-4">
                @csrf
                <label class="block text-sm font-medium text-gray-700 mb-2">Adjust Total Licenses</label>
                <div class="flex gap-2">
                    <input type="number" name="total_licenses" value="{{ $team->total_licenses }}" min="{{ $team->used_licenses }}" 
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                        Update
                    </button>
                </div>
                <p class="text-xs text-gray-500 mt-1">Minimum: {{ $team->used_licenses }} (currently used)</p>
            </form>
        </div>
    </div>

    <!-- Team Members -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Team Members ({{ $team->members->count() }})</h3>
        <div class="divide-y divide-gray-200">
            @forelse($team->members as $member)
                <div class="py-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                            <span class="text-white font-medium">{{ strtoupper(substr($member->user->name ?? 'U', 0, 2)) }}</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $member->user->name ?? 'Unknown' }}</p>
                            <p class="text-sm text-gray-600">{{ $member->user->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 text-xs rounded-full {{ $member->role == 'owner' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ ucfirst($member->role) }}
                        </span>
                        <span class="text-sm text-gray-500">
                            Joined {{ $member->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="py-4 text-gray-600 text-center">No team members</p>
            @endforelse
        </div>
    </div>

    <!-- Pending Invitations -->
    @if($team->pendingInvitations->count() > 0)
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Pending Invitations ({{ $team->pendingInvitations->count() }})</h3>
        <div class="divide-y divide-gray-200">
            @foreach($team->pendingInvitations as $invitation)
                <div class="py-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $invitation->email }}</p>
                            <p class="text-sm text-gray-600">
                                Invited by {{ $invitation->invitedBy->name ?? 'Unknown' }} • 
                                {{ $invitation->created_at->diffForHumans() }} • 
                                Expires {{ $invitation->expires_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                        {{ ucfirst($invitation->role) }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
