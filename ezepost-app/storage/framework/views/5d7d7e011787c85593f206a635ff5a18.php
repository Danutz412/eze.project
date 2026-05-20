<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Admin - <?php echo e(config('app.name', 'EzePost')); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white">
            <div class="p-6 border-b border-gray-800">
                <h1 class="text-2xl font-bold text-blue-400">EzePost Admin</h1>
            </div>
            
            <!-- Customer Panel Switcher -->
            <div class="px-4 py-3 bg-gray-800 border-b border-gray-700">
                <a href="<?php echo e(route('customer.dashboard')); ?>" class="flex items-center justify-between px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 rounded-lg transition-colors">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Switch to Customer Panel
                    </span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            
            <nav class="mt-6">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="block px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-gray-800 border-l-4 border-blue-500' : ''); ?>">
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="<?php echo e(route('admin.customers.index')); ?>" class="block px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('admin.customers.*') ? 'bg-gray-800 border-l-4 border-blue-500' : ''); ?>">
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Customers
                </a>
                <a href="<?php echo e(route('admin.transfers.index')); ?>" class="block px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('admin.transfers.*') ? 'bg-gray-800 border-l-4 border-blue-500' : ''); ?>">
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    Transfers
                </a>
                <a href="<?php echo e(route('admin.plans.index')); ?>" class="block px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('admin.plans.*') ? 'bg-gray-800 border-l-4 border-blue-500' : ''); ?>">
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Plans
                </a>
                <a href="<?php echo e(route('admin.teams.index')); ?>" class="block px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('admin.teams.*') ? 'bg-gray-800 border-l-4 border-blue-500' : ''); ?>">
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Teams
                </a>
                <a href="<?php echo e(route('admin.invoices.index')); ?>" class="block px-6 py-3 hover:bg-gray-800 <?php echo e(request()->routeIs('admin.invoices.*') ? 'bg-gray-800 border-l-4 border-blue-500' : ''); ?>">
                    <svg class="w-5 h-5 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Invoices
                </a>
            </nav>
            <div class="absolute bottom-0 w-64 p-6 border-t border-gray-800">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center">
                        <span class="text-white font-bold"><?php echo e(substr(auth()->user()->name, 0, 1)); ?></span>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium"><?php echo e(auth()->user()->name); ?></p>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-xs text-gray-400 hover:text-white">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Bar -->
            <header class="bg-white shadow">
                <div class="px-6 py-4 flex justify-between items-center">
                    <h2 class="text-2xl font-bold text-gray-800"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></h2>
                    <a href="<?php echo e(route('home')); ?>" class="text-blue-600 hover:text-blue-800">
                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Website
                    </a>
                </div>
            </header>

            <!-- Content -->
            <main class="p-6">
                <?php if(session('success')): ?>
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>
</body>
</html>
<?php /**PATH /Users/emilvaklinov/Desktop/eze.project/ezepost-app/resources/views/layouts/admin.blade.php ENDPATH**/ ?>