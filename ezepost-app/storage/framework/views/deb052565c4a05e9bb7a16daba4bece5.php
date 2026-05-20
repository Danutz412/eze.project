<?php $__env->startSection('title', 'Billing Portal'); ?>

<?php $__env->startSection('breadcrumb', 'Billing Portal'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Billing Portal</h1>
        
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-blue-600 mr-4 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h3 class="text-lg font-semibold text-blue-900 mb-2">Stripe Integration Required</h3>
                    <p class="text-blue-800 mb-4">
                        The Stripe billing portal integration is not yet configured. To enable the self-service billing portal, you need to:
                    </p>
                    <ol class="list-decimal list-inside text-blue-800 space-y-2 mb-4">
                        <li>Set up your Stripe account and API keys</li>
                        <li>Configure Stripe products and prices</li>
                        <li>Implement the Stripe billing portal session creation</li>
                        <li>Set up webhooks for subscription events</li>
                    </ol>
                    <p class="text-sm text-blue-600">
                        For now, you can manage your subscription through the subscription page or contact support for billing changes.
                    </p>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <a href="<?php echo e(route('customer.subscription')); ?>" class="block bg-gray-50 hover:bg-gray-100 rounded-lg p-6 transition-colors">
                <div class="flex items-center mb-4">
                    <svg class="w-8 h-8 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">View Subscription</h3>
                </div>
                <p class="text-gray-600">Check your current plan and billing details</p>
            </a>

            <a href="<?php echo e(route('customer.invoices.index')); ?>" class="block bg-gray-50 hover:bg-gray-100 rounded-lg p-6 transition-colors">
                <div class="flex items-center mb-4">
                    <svg class="w-8 h-8 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">View Invoices</h3>
                </div>
                <p class="text-gray-600">Access your payment history and invoices</p>
            </a>

            <a href="<?php echo e(route('pricing')); ?>" class="block bg-gray-50 hover:bg-gray-100 rounded-lg p-6 transition-colors">
                <div class="flex items-center mb-4">
                    <svg class="w-8 h-8 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">View Plans</h3>
                </div>
                <p class="text-gray-600">Explore available subscription plans</p>
            </a>

            <a href="<?php echo e(route('profile.edit')); ?>" class="block bg-gray-50 hover:bg-gray-100 rounded-lg p-6 transition-colors">
                <div class="flex items-center mb-4">
                    <svg class="w-8 h-8 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">Contact Support</h3>
                </div>
                <p class="text-gray-600">Get help with billing or subscription changes</p>
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/emilvaklinov/Desktop/eze.project/ezepost-app/resources/views/customer/subscription/portal.blade.php ENDPATH**/ ?>