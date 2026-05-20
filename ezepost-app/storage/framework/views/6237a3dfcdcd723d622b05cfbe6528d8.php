<?php $__env->startSection('content'); ?>
<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="text-center mb-16">
        <h1 class="text-5xl font-bold mb-6">Contact Us</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-12">
        <div>
            <h2 class="text-2xl font-bold mb-6">Get in Touch</h2>
            <form class="space-y-6">
                <?php echo csrf_field(); ?>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-700 focus:border-transparent" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-700 focus:border-transparent" required>
                </div>
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                    <input type="text" id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-700 focus:border-transparent" required>
                </div>
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-700 focus:border-transparent" required></textarea>
                </div>
                <button type="submit" class="w-full bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-800">
                    Send Message
                </button>
            </form>
        </div>

        <div>
            <h2 class="text-2xl font-bold mb-6">Contact Information</h2>
            <div class="space-y-6">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-blue-700 mr-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold mb-1">Email</h3>
                        <p class="text-gray-600">support@ezepost.com</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-blue-700 mr-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold mb-1">Phone</h3>
                        <p class="text-gray-600">+44 20 1234 5678</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-blue-700 mr-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold mb-1">Address</h3>
                        <p class="text-gray-600">123 Business Street<br>London, UK<br>EC1A 1BB</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-blue-700 mr-4 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h3 class="font-semibold mb-1">Business Hours</h3>
                        <p class="text-gray-600">Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday - Sunday: Closed</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/emilvaklinov/Desktop/eze.project/ezepost-app/resources/views/public/contact.blade.php ENDPATH**/ ?>