<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - {{ config('app.name', 'EzePost') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Left Side - Logo -->
        <div class="hidden lg:flex lg:w-1/3 bg-gray-300 items-center justify-center">
            <div class="text-center">
                <div class="text-8xl font-bold mb-4">
                    <span class="text-gray-600">E</span><span class="text-orange-500">Z</span><span class="text-gray-600">E</span>
                </div>
                <div class="text-4xl font-bold text-gray-600 tracking-widest">POST</div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-lg">
                <!-- Header -->
                <div class="flex justify-between items-center">
                    <div class="lg:hidden">
                        <div class="text-3xl font-bold">
                            <span class="text-gray-600">E</span><span class="text-orange-500">Z</span><span class="text-gray-600">E</span>
                            <span class="text-gray-600 text-xl ml-1">POST</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('register.info') }}" class="text-gray-600 hover:text-gray-900 font-medium text-sm">
                            Learn More
                        </a>
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 font-medium">Login</a>
                    </div>
                </div>

                <!-- Info Banner -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm text-blue-800">
                                New to EzePost? <a href="{{ route('register.info') }}" class="font-semibold hover:underline">Learn about our features</a> before registering.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input id="name" name="name" type="text" required autofocus
                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                            value="{{ old('name') }}">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                        <input id="username" name="username" type="text"
                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                            value="{{ old('username') }}">
                        @error('username')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input id="email" name="email" type="email" required
                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                            value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Account Type -->
                    <div>
                        <label for="user_group" class="block text-sm font-medium text-gray-700 mb-2">Account Type</label>
                        <select id="user_group" name="user_group" required
                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                            <option value="0" {{ old('user_group') == '0' ? 'selected' : '' }}>Personal Account</option>
                            <option value="1" {{ old('user_group') == '1' ? 'selected' : '' }}>Business Account</option>
                        </select>
                        @error('user_group')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input id="password" name="password" type="password" required
                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                    </div>

                    <!-- Create Personal Team Checkbox -->
                    <div class="flex items-center">
                        <input id="create_team" name="create_team" type="checkbox" value="1"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="create_team" class="ml-2 block text-sm text-gray-700">
                            Create personal team
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between">
                        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">
                            Already registered?
                        </a>
                        <button type="submit"
                            class="group relative flex justify-center py-3 px-8 border border-transparent text-sm font-medium rounded-lg text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            REGISTER
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
