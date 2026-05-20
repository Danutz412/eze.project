<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Corporate Registration - {{ config('app.name', 'EzePost') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200 py-4">
            <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
                <div class="text-3xl font-bold">
                    <span class="text-gray-600">E</span><span class="text-orange-500">Z</span><span class="text-gray-600">E</span>
                    <span class="text-gray-600 text-xl ml-1">POST</span>
                </div>
                <h1 class="text-xl font-semibold text-gray-700">Corporate Registration</h1>
            </div>
        </header>

        <!-- Progress Steps -->
        <div class="bg-white border-b border-gray-200 py-6">
            <div class="max-w-4xl mx-auto px-6">
                <div class="flex items-center justify-center space-x-4">
                    <!-- Step 1 -->
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full {{ session('registration_step', 1) >= 1 ? 'bg-green-600 text-white' : 'bg-gray-300 text-gray-600' }} font-semibold">
                            1
                        </div>
                        <span class="ml-2 text-sm font-medium {{ session('registration_step', 1) >= 1 ? 'text-gray-900' : 'text-gray-500' }}">Personal Details</span>
                    </div>
                    <span class="text-gray-400">»</span>

                    <!-- Step 2 -->
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full {{ session('registration_step', 1) >= 2 ? 'bg-green-600 text-white' : 'bg-gray-300 text-gray-600' }} font-semibold">
                            2
                        </div>
                        <span class="ml-2 text-sm font-medium {{ session('registration_step', 1) >= 2 ? 'text-gray-900' : 'text-gray-500' }}">Login Details</span>
                    </div>
                    <span class="text-gray-400">»</span>

                    <!-- Step 3 -->
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full {{ session('registration_step', 1) >= 3 ? 'bg-green-600 text-white' : 'bg-gray-300 text-gray-600' }} font-semibold">
                            3
                        </div>
                        <span class="ml-2 text-sm font-medium {{ session('registration_step', 1) >= 3 ? 'text-gray-900' : 'text-gray-500' }}">Company Details</span>
                    </div>
                    <span class="text-gray-400">»</span>

                    <!-- Step 4 -->
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full {{ session('registration_step', 1) >= 4 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }} font-semibold">
                            4
                        </div>
                        <span class="ml-2 text-sm font-medium {{ session('registration_step', 1) >= 4 ? 'text-blue-600' : 'text-gray-500' }}">Subscription Details</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex">
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
            <div class="flex-1 flex items-center justify-center px-6 py-12">
                <div class="max-w-2xl w-full">
                    <div class="text-right mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Subscription Details</h2>
                    </div>

                    <form method="POST" action="{{ route('register.corporate.subscription') }}" class="bg-white rounded-lg shadow-sm p-8">
                        @csrf

                        <!-- Subscription Plans -->
                        <div class="mb-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-6 text-center">Subscription Plans</h3>
                            
                            <div class="grid grid-cols-3 gap-4">
                                @foreach(['Business Starter' => 15.99, 'Business Premium' => 20.99, 'Business Premium Plus' => 25.99] as $planName => $price)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="plan" value="{{ $planName }}" class="hidden peer" {{ $loop->iteration == 2 ? 'checked' : '' }}>
                                        <div class="border-2 border-gray-200 rounded-lg p-6 text-center peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:border-gray-300 transition-all">
                                            <h4 class="font-semibold text-gray-900 mb-2">{{ $planName }}</h4>
                                            <p class="text-3xl font-bold text-gray-900 mb-1">£{{ $price }}</p>
                                            <p class="text-sm text-gray-600">/person</p>
                                            <p class="text-sm text-gray-600 mt-4">Best option for personal use & for your next project.</p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Licenses and Subscription Type -->
                        <div class="grid grid-cols-2 gap-6 mb-8">
                            <!-- Licenses -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Licences</label>
                                <input type="number" name="licenses" value="5" min="1" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <!-- Subscription Type -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Choose subscription type</label>
                                <select name="subscription_type" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                </select>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-between">
                            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">
                                Already registered?
                            </a>
                            <button type="submit" 
                                class="bg-gray-800 hover:bg-gray-900 text-white px-8 py-3 rounded-lg font-medium transition-colors">
                                NEXT
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
