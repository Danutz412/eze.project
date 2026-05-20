<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Login - <?php echo e(config('app.name', 'EzePost')); ?></title>
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
                    <a href="<?php echo e(route('register')); ?>" class="text-gray-600 hover:text-gray-900 font-medium">Register</a>
                </div>

                <!-- Session Status -->
                <?php if(session('status')): ?>
                    <div class="mb-4 font-medium text-sm text-green-600">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>

                <!-- Form -->
                <form method="POST" action="<?php echo e(route('login')); ?>" class="mt-8 space-y-6">
                    <?php echo csrf_field(); ?>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input id="email" name="email" type="email" required autofocus
                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                            value="<?php echo e(old('email')); ?>">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input id="password" name="password" type="password" required
                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm">
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-between">
                        <?php if(Route::has('password.request')): ?>
                            <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-gray-600 hover:text-gray-900">
                                Forgot password?
                            </a>
                        <?php endif; ?>
                        <button type="submit"
                            class="group relative flex justify-center py-3 px-8 border border-transparent text-sm font-medium rounded-lg text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            LOGIN
                        </button>
                    </div>

                    <div class="text-center">
                        <a href="<?php echo e(route('register')); ?>" class="text-sm text-gray-600 hover:text-gray-900">
                            Don't have an account? <span class="font-medium">Register</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /Users/emilvaklinov/Desktop/eze.project/ezepost-app/resources/views/auth/login.blade.php ENDPATH**/ ?>