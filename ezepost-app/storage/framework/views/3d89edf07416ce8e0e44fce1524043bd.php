<?php $__env->startSection('title', 'Viewed Items'); ?>
<?php $__env->startSection('breadcrumb', 'Viewed Items'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-lg shadow-sm">
    <!-- Header with Search -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-900">Viewed Items</h2>
            <div class="flex items-center space-x-3">
                <form method="GET" action="<?php echo e(route('customer.transfers.viewed')); ?>" class="flex items-center space-x-3">
                    <input type="text" name="search" placeholder="Search for files..." value="<?php echo e(request('search')); ?>"
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-64">
                    <button type="submit" class="p-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Transfer List -->
    <div class="divide-y divide-gray-200">
        <?php $__empty_1 = true; $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="p-6 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <!-- File Icon & Info -->
                    <div class="flex items-center flex-1">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900"><?php echo e($transfer->file_name); ?></h3>
                            <p class="text-sm text-gray-600">
                                <?php if($transfer->sender_ezepost_user_id == auth()->user()->ezepostUser?->id): ?>
                                    Sent to: <span class="font-medium"><?php echo e($transfer->receiverUser->displayname ?? 'Unknown'); ?></span>
                                <?php else: ?>
                                    From: <span class="font-medium"><?php echo e($transfer->senderUser->displayname ?? 'Unknown'); ?></span>
                                <?php endif; ?>
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                Viewed: <?php echo e($transfer->viewed_at ? $transfer->viewed_at->diffForHumans() : 'Recently'); ?>

                            </p>
                        </div>
                    </div>

                    <!-- Date & Size -->
                    <div class="text-right mr-6">
                        <p class="text-sm font-medium text-gray-900"><?php echo e($transfer->created_at->format('Y-m-d H:i:s')); ?></p>
                        <p class="text-sm text-gray-600">File Size: <?php echo e($transfer->file_size_formatted); ?></p>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center space-x-2">
                        <a href="<?php echo e(route('customer.transfers.download', $transfer->id)); ?>" 
                           class="p-2 text-purple-600 hover:bg-purple-50 rounded-lg transition-colors" title="Download">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3 3m0 0l-3-3m3 3V10"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <!-- Empty State -->
            <div class="p-12 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No viewed items</h3>
                <p class="text-gray-600">No files have been viewed yet.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if($transfers->hasPages()): ?>
        <div class="p-6 border-t border-gray-200">
            <?php echo e($transfers->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/emilvaklinov/Desktop/eze.project/ezepost-app/resources/views/customer/transfers/viewed.blade.php ENDPATH**/ ?>