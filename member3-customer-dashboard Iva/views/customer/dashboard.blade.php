@extends('layouts.customer')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<!-- Ezepost Address Card -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ezepost address</h3>
    <p class="text-sm text-gray-600 mb-3">You need this address to send and receive files or packages using our desktop application.</p>
    <div class="flex items-center justify-between bg-gray-50 rounded-lg p-4">
        <div class="flex items-center">
            <div class="text-3xl font-bold mr-4">
                <span class="text-gray-600">E</span><span class="text-orange-500">Z</span><span class="text-gray-600">E</span>
                <span class="text-gray-600 text-sm ml-1">POST</span>
            </div>
            <div>
                <p class="text-sm text-gray-500">Your Ezepost address</p>
                <p class="text-lg font-semibold text-red-600">
                    @if(auth()->user()->ezepostUser && auth()->user()->ezepostUser->vepost_addr)
                        {{ auth()->user()->ezepostUser->vepost_addr }}
                    @else
                        {{ strtolower(str_replace(' ', '', auth()->user()->name)) }}@example.com#ezepost
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Subscription Status Warning -->
<div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-6">
    <div class="flex items-start">
        <svg class="w-6 h-6 text-red-600 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
        </svg>
        <div class="flex-1">
            <h4 class="text-lg font-semibold text-red-900 mb-2">Subscription Status</h4>
            <p class="text-red-800 mb-3">Active subscription required.</p>
            <div class="bg-white rounded-lg p-4 mb-4">
                <div class="text-center py-8">
                    <div class="text-4xl font-bold mb-4">
                        <span class="text-gray-600">E</span><span class="text-orange-500">Z</span><span class="text-gray-600">E</span>
                        <span class="text-gray-600 text-xl ml-1">POST</span>
                    </div>
                    <p class="text-red-600 font-semibold mb-4">Complete Your Subscription.</p>
                    <p class="text-sm text-gray-600 mb-4">You Need To Complete Your Subscription To Use Our EZePost App.</p>
                    <a href="{{ route('pricing') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-8 rounded-lg transition-colors">
                        Complete Subscription
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Subscription Status & License(s) Section -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Subscription Status & Licence(s)</h3>
    <p class="text-sm text-gray-600 mb-4">All of the people that are part of this team.</p>
    
    <div class="grid md:grid-cols-2 gap-6">
        <!-- Subscription Card -->
        <div class="bg-gray-50 rounded-lg p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-semibold text-gray-900">Subscription</span>
                </div>
            </div>
            
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-2xl font-bold text-gray-900">Business Premium</span>
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Active
                    </span>
                </div>
            </div>
        </div>

        <!-- License(s) Card -->
        <div class="bg-gray-50 rounded-lg p-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="font-semibold text-gray-900">Licence(s)</span>
                </div>
            </div>
            
            <div class="space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Used Licence(s)</span>
                    <span class="font-semibold text-gray-900">1</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-orange-600">Pending Invitation(s)</span>
                    <span class="font-semibold text-orange-600">1</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-red-600">Remaining Licence(s)</span>
                    <span class="font-semibold text-red-600">4</span>
                </div>
                <div class="flex justify-between text-sm pt-2 border-t border-gray-300">
                    <span class="font-semibold text-gray-900">Total Licence(s)</span>
                    <span class="font-bold text-gray-900">6</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- All Teams Section -->
<div class="bg-white rounded-lg shadow-sm p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">All Teams</h3>
    <p class="text-sm text-gray-600 mb-4">All teams in the system.</p>
    <div class="space-y-3">
        @forelse($teams ?? [] as $team)
            <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <div>
                        <span class="text-gray-700 font-medium">{{ $team->name }}</span>
                        @if($team->owner)
                            <span class="text-sm text-gray-500 ml-2">Owner: {{ $team->owner->name }}</span>
                        @endif
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-600">{{ $team->used_licenses }}/{{ $team->total_licenses }} licenses</span>
                    <a href="{{ route('customer.teams.show', $team) }}" class="text-sm text-blue-600 hover:text-blue-800">View</a>
                </div>
            </div>
        @empty
            <div class="text-center py-8 text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <p class="font-medium">No teams found</p>
                <p class="text-sm">Create a team to get started</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Statistics Grid -->
<div class="grid md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white border-2 border-gray-200 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Sent Transfers</h3>
                <svg class="w-8 h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
            </div>
            <p class="text-4xl font-bold text-blue-700">{{ $sent }}</p>
            <p class="text-sm text-gray-500 mt-2">Total files sent</p>
        </div>

        <div class="bg-white border-2 border-gray-200 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Received Transfers</h3>
                <svg class="w-8 h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
            </div>
            <p class="text-4xl font-bold text-green-700">{{ $received }}</p>
            <p class="text-sm text-gray-500 mt-2">Total files received</p>
        </div>

        <div class="bg-white border-2 border-gray-200 rounded-2xl p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Viewed Transfers</h3>
                <svg class="w-8 h-8 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </div>
            <p class="text-4xl font-bold text-purple-700">{{ $viewed }}</p>
            <p class="text-sm text-gray-500 mt-2">Transfers viewed</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white border-2 border-gray-200 rounded-2xl p-6">
            <h3 class="text-xl font-bold mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('customer.transfers.create') }}" class="block p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-blue-700 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-900">New Transfer</p>
                            <p class="text-sm text-gray-600">Send files to recipients</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('customer.transfers.sent') }}" class="block p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-green-700 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-900">View Transfers</p>
                            <p class="text-sm text-gray-600">Track your transfers</p>
                        </div>
                    </div>
                </a>
                <a href="{{ route('customer.teams.settings') }}" class="block p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-purple-700 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-gray-900">Team Settings</p>
                            <p class="text-sm text-gray-600">Manage team configuration</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="bg-white border-2 border-gray-200 rounded-2xl p-6">
            <h3 class="text-xl font-bold mb-4">Recent Activity</h3>
            <div class="space-y-4">
                @forelse($recentActivity ?? [] as $activity)
                    <div class="flex items-start space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            @if($activity->sender_user_id == auth()->id())
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $activity->file_name }}</p>
                            <p class="text-xs text-gray-600">
                                @if($activity->sender_user_id == auth()->id())
                                    Sent to {{ $activity->receiverUser->name ?? 'Unknown' }}
                                @else
                                    Received from {{ $activity->senderUser->name ?? 'Unknown' }}
                                @endif
                            </p>
                            <p class="text-xs text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full @if($activity->status == 'viewed') bg-purple-100 text-purple-700 @elseif($activity->status == 'received') bg-green-100 text-green-700 @else bg-blue-100 text-blue-700 @endif">
                            {{ ucfirst($activity->status) }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-500">
                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <p class="font-medium">No recent activity</p>
                        <p class="text-sm">Start by creating your first transfer</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
