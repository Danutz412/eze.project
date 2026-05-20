<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Generate Invoice</h2>

        <form action="<?php echo e(route('customer.invoices.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-6">
                <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                <input type="number" name="amount" id="amount" step="0.01" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    value="<?php echo e(old('amount', '0.00')); ?>">
                <?php $__errorArgs = ['amount'];
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

            <div class="mb-6">
                <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">Currency</label>
                <select name="currency" id="currency" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <option value="GBP" <?php echo e(old('currency', 'GBP') == 'GBP' ? 'selected' : ''); ?>>GBP (£)</option>
                    <option value="USD" <?php echo e(old('currency') == 'USD' ? 'selected' : ''); ?>>USD ($)</option>
                    <option value="EUR" <?php echo e(old('currency') == 'EUR' ? 'selected' : ''); ?>>EUR (€)</option>
                </select>
                <?php $__errorArgs = ['currency'];
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

            <div class="flex gap-4">
                <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Generate Invoice
                </button>
                <a href="<?php echo e(route('customer.invoices.index')); ?>" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/emilvaklinov/Desktop/eze.project/ezepost-app/resources/views/customer/invoices/create.blade.php ENDPATH**/ ?>