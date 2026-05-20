<?php $__env->startSection('content'); ?>
<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="text-center mb-16">
        <h1 class="text-5xl font-bold mb-6">Download EzePost</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Get the EzePost application for your platform and start transferring files securely.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white border-2 border-gray-200 rounded-2xl p-8 hover:border-blue-700 transition-colors">
            <div class="text-center">
                <svg class="w-16 h-16 mx-auto mb-4 text-blue-700" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M5.5 2h13c.83 0 1.5.67 1.5 1.5v17c0 .83-.67 1.5-1.5 1.5h-13C4.67 22 4 21.33 4 20.5v-17C4 2.67 4.67 2 5.5 2zm0 2v16h13V4h-13z"/>
                </svg>
                <h3 class="text-2xl font-bold mb-2">Windows</h3>
                <p class="text-gray-600 mb-6">Windows 10 or later</p>
                <button class="w-full bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-800">
                    Download for Windows
                </button>
                <p class="text-sm text-gray-500 mt-4">Version 2.1.0 (64-bit)</p>
            </div>
        </div>

        <div class="bg-white border-2 border-gray-200 rounded-2xl p-8 hover:border-blue-700 transition-colors">
            <div class="text-center">
                <svg class="w-16 h-16 mx-auto mb-4 text-blue-700" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                </svg>
                <h3 class="text-2xl font-bold mb-2">macOS</h3>
                <p class="text-gray-600 mb-6">macOS 11 or later</p>
                <button class="w-full bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-800">
                    Download for Mac
                </button>
                <p class="text-sm text-gray-500 mt-4">Version 2.1.0 (Universal)</p>
            </div>
        </div>

        <div class="bg-white border-2 border-gray-200 rounded-2xl p-8 hover:border-blue-700 transition-colors">
            <div class="text-center">
                <svg class="w-16 h-16 mx-auto mb-4 text-blue-700" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M22.17 9.17c0-3.87-3.13-7-7-7h-.31c-1.77 0-3.4.81-4.5 2.2C9.27 3.98 7.64 3.17 5.86 3.17h-.31c-3.87 0-7 3.13-7 7 0 1.85.72 3.6 2.03 4.94l8.98 9.03c.39.39 1.02.39 1.41 0l8.98-9.03c1.31-1.34 2.03-3.09 2.03-4.94z"/>
                </svg>
                <h3 class="text-2xl font-bold mb-2">Linux</h3>
                <p class="text-gray-600 mb-6">Ubuntu 20.04 or later</p>
                <button class="w-full bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-800">
                    Download for Linux
                </button>
                <p class="text-sm text-gray-500 mt-4">Version 2.1.0 (.deb)</p>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 rounded-2xl p-12">
        <h2 class="text-3xl font-bold mb-8 text-center">Installation Instructions</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div>
                <div class="bg-blue-700 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mb-4">1</div>
                <h3 class="font-bold mb-2">Download</h3>
                <p class="text-gray-600">Click the download button for your operating system above.</p>
            </div>
            <div>
                <div class="bg-blue-700 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mb-4">2</div>
                <h3 class="font-bold mb-2">Install</h3>
                <p class="text-gray-600">Run the installer and follow the on-screen instructions.</p>
            </div>
            <div>
                <div class="bg-blue-700 text-white w-10 h-10 rounded-full flex items-center justify-center font-bold mb-4">3</div>
                <h3 class="font-bold mb-2">Start Using</h3>
                <p class="text-gray-600">Launch EzePost and log in with your account credentials.</p>
            </div>
        </div>
    </div>

    <div class="mt-16 text-center">
        <h2 class="text-2xl font-bold mb-4">Need Help?</h2>
        <p class="text-gray-600 mb-6">Check out our documentation or contact support.</p>
        <div class="space-x-4">
            <a href="#" class="inline-block border-2 border-blue-700 text-blue-700 px-6 py-3 rounded-lg hover:bg-blue-700 hover:text-white">
                View Documentation
            </a>
            <a href="<?php echo e(route('contact')); ?>" class="inline-block bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-800">
                Contact Support
            </a>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/emilvaklinov/Desktop/eze.project/ezepost-app/resources/views/public/download.blade.php ENDPATH**/ ?>