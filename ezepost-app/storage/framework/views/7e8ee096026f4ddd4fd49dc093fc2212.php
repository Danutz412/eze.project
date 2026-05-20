<?php $__env->startSection('content'); ?>
<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="text-center mb-16">
        <h1 class="text-5xl font-bold mb-6">About EzePost</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            We provide secure, reliable file transfer solutions for businesses and individuals worldwide.
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-12 mb-16">
        <div>
            <h2 class="text-3xl font-bold mb-4">Our Mission</h2>
            <p class="text-gray-600 leading-relaxed">
                At EzePost, we believe in making file transfers simple, secure, and accessible to everyone. 
                Our platform combines cutting-edge security with an intuitive user experience to deliver 
                the best file transfer solution in the market.
            </p>
        </div>
        <div>
            <h2 class="text-3xl font-bold mb-4">Why Choose Us</h2>
            <ul class="space-y-3 text-gray-600">
                <li class="flex items-start">
                    <svg class="w-6 h-6 text-blue-700 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>End-to-end encryption for all transfers</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-6 h-6 text-blue-700 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Real-time tracking and notifications</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-6 h-6 text-blue-700 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>PDF receipts for all transactions</span>
                </li>
                <li class="flex items-start">
                    <svg class="w-6 h-6 text-blue-700 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>24/7 customer support</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="bg-blue-50 rounded-2xl p-12 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to get started?</h2>
        <p class="text-gray-600 mb-8">Join thousands of satisfied customers using EzePost today.</p>
        <a href="<?php echo e(route('pricing')); ?>" class="inline-block bg-blue-700 text-white px-8 py-3 rounded-lg hover:bg-blue-800">
            View Pricing Plans
        </a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/emilvaklinov/Desktop/eze.project/ezepost-app/resources/views/public/about.blade.php ENDPATH**/ ?>