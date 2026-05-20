<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registration Information - {{ config('app.name', 'EzePost') }}</title>
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

        <!-- Right Side - Information -->
        <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl w-full space-y-6 bg-white p-10 rounded-lg">
                <!-- Header -->
                <div class="flex justify-between items-center">
                    <div class="lg:hidden">
                        <div class="text-3xl font-bold">
                            <span class="text-gray-600">E</span><span class="text-orange-500">Z</span><span class="text-gray-600">E</span>
                            <span class="text-gray-600 text-xl ml-1">POST</span>
                        </div>
                    </div>
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 font-medium">Login</a>
                </div>

                <!-- Title -->
                <div class="text-center">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Registration Information</h1>
                    <p class="text-gray-600">Learn about EzePost before you register</p>
                </div>

                <!-- Information Sections -->
                <div class="space-y-6">
                    <!-- What is EzePost -->
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold text-gray-900 mb-3">What is EzePost?</h2>
                        <p class="text-gray-700">
                            EzePost is a secure file transfer service that allows you to send and receive files with end-to-end encryption. 
                            Our platform ensures your data remains private and secure during transit.
                        </p>
                    </div>

                    <!-- Key Features -->
                    <div class="bg-green-50 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold text-gray-900 mb-3">Key Features</h2>
                        <ul class="space-y-2 text-gray-700">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Secure file transfer with encryption</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Track file delivery and viewing status</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Send files to any email address</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Proof of delivery for important transfers</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Team collaboration features</span>
                            </li>
                        </ul>
                    </div>

                    <!-- How it Works -->
                    <div class="bg-purple-50 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold text-gray-900 mb-3">How it Works</h2>
                        <ol class="space-y-2 text-gray-700 list-decimal list-inside">
                            <li>Create your free account</li>
                            <li>Upload files you want to send</li>
                            <li>Enter recipient's email address</li>
                            <li>Set delivery options and expiration</li>
                            <li>Track when files are viewed and downloaded</li>
                        </ol>
                    </div>

                    <!-- Subscription Plans -->
                    <div class="bg-orange-50 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold text-gray-900 mb-3">Subscription Plans</h2>
                        <p class="text-gray-700 mb-3">
                            Choose the plan that fits your needs:
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white p-4 rounded-lg text-center">
                                <h3 class="font-semibold text-gray-900">Free</h3>
                                <p class="text-sm text-gray-600">Basic file transfer</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg text-center">
                                <h3 class="font-semibold text-gray-900">Premium</h3>
                                <p class="text-sm text-gray-600">Advanced features</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg text-center">
                                <h3 class="font-semibold text-gray-900">Business</h3>
                                <p class="text-sm text-gray-600">Team collaboration</p>
                            </div>
                        </div>
                    </div>

                    <!-- Security -->
                    <div class="bg-red-50 p-6 rounded-lg">
                        <h2 class="text-xl font-semibold text-gray-900 mb-3">Security & Privacy</h2>
                        <p class="text-gray-700">
                            Your files are encrypted during transfer and storage. We use industry-standard security measures 
                            to protect your data. Your files are automatically deleted after the expiration period you set.
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Already have an account?
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-lg text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Continue to Registration
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
