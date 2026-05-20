<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Team - {{ config('app.name', 'EzePost') }}</title>
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
                        <a href="{{ route('customer.teams.show', $team) }}" class="text-gray-600 hover:text-gray-900">Back to Team</a>
                        <a href="{{ route('customer.teams.index') }}" class="text-gray-600 hover:text-gray-900">All Teams</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-lg shadow-sm p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Team</h1>

                <form method="POST" action="{{ route('customer.teams.update', $team) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Team Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Team Name</label>
                        <input type="text" name="name" id="name" required
                            value="{{ old('name', $team->name) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $team->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- License Information -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-3">License Information</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="total_licenses" class="block text-sm font-medium text-gray-700 mb-2">Total Licenses</label>
                                <input type="number" name="total_licenses" id="total_licenses" required min="1"
                                    value="{{ old('total_licenses', $team->total_licenses) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('total_licenses')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-gray-900">{{ $team->used_licenses }}</p>
                                    <p class="text-sm text-gray-600">Used Licenses</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-gray-900">{{ $team->pending_invitations }}</p>
                                    <p class="text-sm text-gray-600">Pending Invitations</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-gray-900">{{ $team->total_licenses - $team->used_licenses }}</p>
                                    <p class="text-sm text-gray-600">Available Licenses</p>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500">Total licenses must be greater than or equal to used licenses ({{ $team->used_licenses }})</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between">
                        <a href="{{ route('customer.teams.show', $team) }}" class="text-gray-600 hover:text-gray-900">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-900 font-medium">
                            Update Team
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
