<?php $__env->startSection('title', 'Send File'); ?>
<?php $__env->startSection('breadcrumb', 'Send File'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Send File</h1>

        <form action="<?php echo e(route('customer.transfers.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <!-- Recipient Email -->
            <div class="mb-6">
                <label for="recipient_email" class="block text-sm font-medium text-gray-700 mb-2">
                    Recipient Email <span class="text-red-600">*</span>
                </label>
                <input type="email" name="recipient_email" id="recipient_email" required
                    value="<?php echo e(old('recipient_email')); ?>"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    placeholder="recipient@example.com">
                <?php $__errorArgs = ['recipient_email'];
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

            <!-- File Upload -->
            <div class="mb-6">
                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                    File <span class="text-red-600">*</span>
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-red-500 transition-colors">
                    <input type="file" name="file" id="file" required
                        class="hidden"
                        onchange="updateFileName(this)">
                    <label for="file" class="cursor-pointer">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3 3m0 0l-3-3m3 3V10"></path>
                        </svg>
                        <p class="text-gray-600 mb-1">
                            <span class="text-red-600 font-medium">Click to upload</span> or drag and drop
                        </p>
                        <p class="text-sm text-gray-500">Maximum file size: 100MB</p>
                        <p id="file-name" class="mt-2 text-sm font-medium text-gray-900"></p>
                    </label>
                </div>
                <?php $__errorArgs = ['file'];
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

            <!-- Message (Optional) -->
            <div class="mb-6">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                    Message (Optional)
                </label>
                <textarea name="message" id="message" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    placeholder="Add a message for the recipient..."><?php echo e(old('message')); ?></textarea>
                <?php $__errorArgs = ['message'];
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

            <!-- Delivery Options -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Delivery Options</label>
                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="checkbox" name="notify_recipient" value="1" checked
                            class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                        <span class="ml-2 text-sm text-gray-700">Notify recipient by email</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="require_password" value="1"
                            class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                        <span class="ml-2 text-sm text-gray-700">Require password to download</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="track_download" value="1" checked
                            class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                        <span class="ml-2 text-sm text-gray-700">Track when file is downloaded</span>
                    </label>
                </div>
            </div>

            <!-- Expiration -->
            <div class="mb-6">
                <label for="expiration" class="block text-sm font-medium text-gray-700 mb-2">
                    Link Expiration
                </label>
                <select name="expiration" id="expiration"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <option value="24">24 hours</option>
                    <option value="72">3 days</option>
                    <option value="168" selected>7 days</option>
                    <option value="720">30 days</option>
                    <option value="0">Never</option>
                </select>
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Send File
                </button>
                <a href="<?php echo e(route('customer.transfers.sent')); ?>" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function updateFileName(input) {
    const fileName = input.files[0]?.name;
    const fileNameDisplay = document.getElementById('file-name');
    if (fileName) {
        fileNameDisplay.textContent = `Selected: ${fileName}`;
    } else {
        fileNameDisplay.textContent = '';
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.customer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/emilvaklinov/Desktop/eze.project/ezepost-app/resources/views/customer/transfers/create.blade.php ENDPATH**/ ?>