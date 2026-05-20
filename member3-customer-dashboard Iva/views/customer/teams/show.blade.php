<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Team Details - {{ config('app.name', 'EzePost') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('customer.dashboard') }}" class="text-2xl font-bold">
                            <span class="text-gray-600">E</span><span class="text-orange-500">Z</span><span class="text-gray-600">E</span>
                            <span class="text-gray-600 text-lg ml-1">POST</span>
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('customer.teams.index') }}" class="text-gray-600 hover:text-gray-900">Back to Teams</a>
                        <a href="{{ route('customer.teams.settings') }}" class="text-gray-600 hover:text-gray-900">Settings</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Team Header -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $team->name }}</h1>
                        @if($team->description)
                            <p class="text-gray-600 mt-2">{{ $team->description }}</p>
                        @endif
                        <div class="flex items-center mt-4 space-x-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium @if($team->is_personal) bg-blue-100 text-blue-800 @else bg-green-100 text-green-800 @endif">
                                @if($team->is_personal) Personal Team @else Business Team @endif
                            </span>
                            <span class="text-sm text-gray-500">
                                Created {{ $team->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    @if(auth()->id() === $team->owner_id)
                        <div class="flex space-x-2">
                            <a href="{{ route('customer.teams.edit', $team) }}" class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 text-sm">
                                Edit
                            </a>
                        </div>
                    @endif
                </div>

                <!-- License Info -->
                <div class="mt-6 grid grid-cols-3 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold text-gray-900">{{ $team->total_licenses }}</p>
                        <p class="text-sm text-gray-600">Total Licenses</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold text-gray-900">{{ $team->used_licenses }}</p>
                        <p class="text-sm text-gray-600">Used Licenses</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold text-gray-900">{{ $team->total_licenses - $team->used_licenses }}</p>
                        <p class="text-sm text-gray-600">Available Licenses</p>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Team Members -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-900">Team Members</h2>
                        @if(auth()->id() === $team->owner_id)
                            <span class="text-sm text-gray-500">{{ $team->members->count() }} members</span>
                        @endif
                    </div>
                    <div class="space-y-3">
                        @forelse($team->members as $member)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-gray-600 font-semibold">{{ strtoupper(substr($member->user->name, 0, 1)) }}</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $member->user->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $member->user->email }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 text-xs rounded-full @if($member->role === 'owner') bg-purple-100 text-purple-700 @elseif($member->role === 'admin') bg-blue-100 text-blue-700 @else bg-gray-100 text-gray-700 @endif">
                                        {{ ucfirst($member->role) }}
                                    </span>
                                    @if(auth()->id() === $team->owner_id && $member->role !== 'owner')
                                        <form method="POST" action="{{ route('customer.teams.remove-member', $member) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Remove</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No team members yet</p>
                        @endforelse
                    </div>
                </div>

                <!-- Pending Invitations -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-gray-900">Pending Invitations</h2>
                        @if(auth()->id() === $team->owner_id)
                            <span class="text-sm text-gray-500">{{ $team->pendingInvitations->count() }} pending</span>
                        @endif
                    </div>
                    <div class="space-y-3">
                        @forelse($team->pendingInvitations as $invitation)
                            <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $invitation->email }}</p>
                                    <p class="text-sm text-gray-500">Expires {{ $invitation->expires_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                        {{ ucfirst($invitation->role) }}
                                    </span>
                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                        {{ ucfirst($invitation->status) }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No pending invitations</p>
                        @endforelse
                    </div>

                    @if(auth()->id() === $team->owner_id)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <h3 class="font-medium text-gray-900 mb-3">Invite New Member</h3>
                            <form method="POST" action="{{ route('customer.teams.invite') }}" class="space-y-3">
                                @csrf
                                <input type="hidden" name="team_id" value="{{ $team->id }}">
                                <div>
                                    <input type="email" name="email" required placeholder="Email address"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <select name="role" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="member">Member</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                @if($team->total_licenses - $team->used_licenses <= 0)
                                    <p class="text-sm text-red-600">No available licenses. Please upgrade your plan.</p>
                                @else
                                    <button type="submit" class="w-full px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900">
                                        Send Invitation
                                    </button>
                                @endif
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
