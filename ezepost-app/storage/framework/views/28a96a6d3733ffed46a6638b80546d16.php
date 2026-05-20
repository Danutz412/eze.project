<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Invoice #<?php echo e($invoice->invoice_no); ?></h1>
        <div class="flex gap-2">
            <a href="<?php echo e(route('customer.invoices.download', $invoice)); ?>" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                Download PDF
            </a>
            <?php if($invoice->payment_status === 'pending'): ?>
                <form action="<?php echo e(route('customer.invoices.destroy', $invoice)); ?>" method="POST" onsubmit="return confirm('Are you sure?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                        Delete
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-8">
        <div class="flex justify-between mb-8">
            <div>
                <h2 class="text-xl font-bold text-gray-900">EZePost</h2>
                <p class="text-gray-600">Secure File Transfer Service</p>
            </div>
            <div class="text-right">
                <p class="text-gray-600">Invoice #<?php echo e($invoice->invoice_no); ?></p>
                <p class="text-gray-600">Date: <?php echo e($invoice->issued_at ? $invoice->issued_at->format('M d, Y') : $invoice->created_at->format('M d, Y')); ?></p>
                <?php if($invoice->stripe_invoice_id): ?>
                    <p class="text-gray-600">Stripe Invoice: <?php echo e($invoice->stripe_invoice_id); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-8 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Bill To</h3>
            <p class="text-gray-700"><?php echo e($invoice->user->name); ?></p>
            <p class="text-gray-600"><?php echo e($invoice->user->email); ?></p>
        </div>

        <div class="border-t border-gray-200 pt-8 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Invoice Details</h3>
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="text-left py-3 text-gray-600">Description</th>
                        <th class="text-right py-3 text-gray-600">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-200">
                        <td class="py-4">
                            <p class="font-medium text-gray-900">Service Fee</p>
                        </td>
                        <td class="py-4 text-right text-gray-900">
                            <?php echo e($invoice->currency); ?><?php echo e(number_format($invoice->amount, 2)); ?>

                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="py-4 text-right font-semibold text-gray-900">Total:</td>
                        <td class="py-4 text-right font-bold text-xl text-gray-900">
                            <?php echo e($invoice->currency); ?><?php echo e(number_format($invoice->amount, 2)); ?>

                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="border-t border-gray-200 pt-8">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-600">Status:</p>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        <?php echo e($invoice->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 
                           ($invoice->payment_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                           'bg-red-100 text-red-800')); ?>">
                        <?php echo e(ucfirst($invoice->payment_status)); ?>

                    </span>
                </div>
                <?php if($invoice->hosted_invoice_url): ?>
                    <div class="text-right">
                        <a href="<?php echo e($invoice->hosted_invoice_url); ?>" target="_blank" class="text-red-600 hover:text-red-700">
                            View on Stripe →
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/emilvaklinov/Desktop/eze.project/ezepost-app/resources/views/customer/invoices/show.blade.php ENDPATH**/ ?>