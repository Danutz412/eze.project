<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Login - <?php echo e(config('app.name', 'EzePost')); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <div class="bg-white border-b border-gray-200 px-6 py-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <div class="text-2xl font-bold">
                        <span class="text-gray-600">E</span><span class="text-orange-500">Z</span><span class="text-gray-600">E</span>
                    </div>
                    <div class="text-xl font-bold text-gray-600">POST</div>
                </div>
                <a href="<?php echo e(route('register')); ?>" class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex items-center justify-center px-4 py-12">
            <div class="max-w-6xl w-full">
                <h1 class="text-3xl font-semibold text-gray-900 mb-12 text-center">Login to your account</h1>
                
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Personal Account -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Personal Account</h2>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed to help you build your web application using a development environment that is simple, powerful, and enjoyable. We believe you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel ecosystem to be a breath of fresh air. We hope you love it.
                        </p>
                        <a href="<?php echo e(route('login.form')); ?>?type=personal" 
                           class="block w-full text-center bg-gray-800 hover:bg-gray-900 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                            Login
                        </a>
                    </div>

                    <!-- Corporate Account -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                        <h2 class="text-2xl font-semibold text-gray-900 mb-4">Corporate Account</h2>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is designed to help you build your web application using a development environment that is simple, powerful, and enjoyable. We believe you should love expressing your creativity through programming, so we have spent time carefully crafting the Laravel ecosystem to be a breath of fresh air. We hope you love it.
                        </p>
                        <a href="<?php echo e(route('login.form')); ?>?type=corporate" 
                           class="block w-full text-center bg-gray-800 hover:bg-gray-900 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /Users/emilvaklinov/Desktop/eze.project/ezepost-app/resources/views/auth/login-select.blade.php ENDPATH**/ ?>