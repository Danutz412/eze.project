<?php $__env->startSection('title', 'Sent Today'); ?>
<?php $__env->startSection('breadcrumb', 'Sent Today'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-2xl font-bold text-gray-900">Sent Today</h2>
        <p class="text-sm text-gray-600 mt-1">Files sent today: <?php echo e($transfers->total()); ?></p>
    </div>

    <div class="divide-y divide-gray-200">
        <?php $__empty_1 = true; $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex items-center flex-1">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900"><?php echo e($transfer->file_name); ?></h3>
                            <p class="text-sm text-gray-600">To: <?php echo e($transfer->receiverUser->displayname ?? 'Unknown'); ?></p>
                        </div>
                    </div>
                    <div class="text-right mr-6">
                        <p class="text-sm font-medium text-gray-900"><?php echo e($transfer->created_at->format('H:i:s')); ?></p>
                        <p class="text-sm text-gray-600"><?php echo e($transfer->file_size_formatted); ?></p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="<?php echo e(route('customer.transfers.download', $transfer)); ?>" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3 3m0 0l-3-3m3 3V10"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No files sent today</h3>
                <p class="text-gray-600">You haven't sent any files today.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php if($transfers->hasPages()): ?>
        <div class="p-6 border-t border-gray-200"><?php echo e($transfers->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/emilvaklinov/Desktop/eze.project/ezepost-app/resources/views/customer/transfers/sent-today.blade.php ENDPATH**/ ?>