@extends('layouts.customer')

@section('title', 'Team Settings')
@section('breadcrumb', 'Team Settings')

@section('content')
<div class="max-w-4xl">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Team Settings</h2>

    <!-- Team Information -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Team Information</h3>
        <form method="POST" action="{{ route('customer.teams.update-settings') }}">
            @csrf
            @method('PATCH')

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Team Name</label>
                    <input type="text" name="team_name" value="{{ $team->name ?? 'Personal Team' }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="3" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $team->description ?? '' }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition-colors">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Team Members -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Team Members ({{ $team->used_licenses }}/{{ $team->total_licenses }})</h3>
            <button onclick="document.getElementById('inviteModal').classList.remove('hidden')" 
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Member
            </button>
        </div>

        <div class="divide-y divide-gray-200">
            @forelse($members ?? [] as $member)
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
                            {{ ucfirst($member->role ?? 'user') }}
                        </span>
                        @if($member->role != 'owner')
                            <form method="POST" action="{{ route('customer.teams.remove-member', $member) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 text-sm" onclick="return confirm('Remove this member?')">
                                    Remove
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <p class="py-4 text-gray-600 text-center">No team members yet. Invite someone to join your team!</p>
            @endforelse
        </div>
    </div>

    <!-- Pending Invitations -->
    @if($team->pendingInvitations->count() > 0)
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Pending Invitations ({{ $team->pending_invitations }})</h3>
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
                            <p class="text-sm text-gray-600">Invited {{ $invitation->created_at->diffForHumans() }} • Expires {{ $invitation->expires_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                            {{ ucfirst($invitation->role) }}
                        </span>
                        <form method="POST" action="{{ route('customer.teams.cancel-invitation', $invitation) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 text-sm" onclick="return confirm('Cancel this invitation?')">
                                Cancel
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Danger Zone -->
    <div class="bg-white rounded-lg shadow-sm p-6 border-2 border-red-200">
        <h3 class="text-lg font-semibold text-red-900 mb-4">Danger Zone</h3>
        <p class="text-sm text-gray-600 mb-4">Once you delete a team, there is no going back. Please be certain.</p>
        <form method="POST" action="{{ route('customer.teams.destroy', $team ?? 1) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors" 
                onclick="return confirm('Are you absolutely sure? This action cannot be undone.')">
                Delete Team
            </button>
        </form>
    </div>
</div>

<!-- Invite Modal -->
<div id="inviteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Invite Team Member</h3>
            <button onclick="document.getElementById('inviteModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form method="POST" action="{{ route('customer.teams.invite') }}">
            @csrf
            <input type="hidden" name="team_id" value="{{ $team->id }}">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="colleague@example.com">
                    <p class="text-xs text-gray-500 mt-1">Please provide the email address of the person you would like to add to this team.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="user">User - User's have the ability to read only.</option>
                        <option value="manager">Manager - Manager's have the ability to read, create, and update.</option>
                        <option value="administrator">Administrator - Administrator's can perform any action.</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('inviteModal').classList.add('hidden')" 
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors">
                        Send Invitation
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
