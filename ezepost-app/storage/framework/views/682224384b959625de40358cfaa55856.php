<?php $__env->startSection('content'); ?>
<section class="max-w-7xl mx-auto px-6 py-20">
    <!-- Toggle and Dropdown -->
    <div class="flex justify-center items-center gap-6 mb-12">
        <!-- Personal/Corporate Toggle -->
        <div class="inline-flex rounded-lg border border-gray-300 p-1 bg-white">
            <button onclick="showPlans('Personal')" id="personalBtn" 
                class="px-6 py-2 rounded-md text-sm font-medium transition-colors bg-gray-800 text-white">
                Personal
            </button>
            <button onclick="showPlans('Business')" id="businessBtn"
                class="px-6 py-2 rounded-md text-sm font-medium transition-colors text-gray-700 hover:text-gray-900">
                Corporate
            </button>
        </div>

        <!-- Subscription Type Dropdown -->
        <div class="relative">
            <label class="block text-sm font-medium text-gray-700 mb-2">Choose subscription type</label>
            <select id="periodSelect" onchange="updatePrices()"
                class="block w-48 px-4 py-2 pr-8 border border-gray-300 bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
        </div>
    </div>

    <!-- Plans Grid -->
    <?php
        $personalPlans = $plans->where('type', 'Personal');
        $businessPlans = $plans->where('type', 'Business');
    ?>

    <!-- Personal Plans -->
    <div id="personalPlans" class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
        <?php $__currentLoopData = $personalPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white border-2 <?php echo e($loop->iteration == 2 ? 'border-red-500' : 'border-gray-200'); ?> rounded-lg p-8 relative" data-plan-id="<?php echo e($plan->id); ?>">
                <?php if($loop->iteration == 2): ?>
                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-1 rounded-full text-xs font-bold">
                        POPULAR
                    </div>
                <?php endif; ?>
                
                <h3 class="text-2xl font-bold text-gray-900 mb-4"><?php echo e(str_replace('Personal ', '', $plan->name)); ?></h3>
                
                <div class="mb-6">
                    <span class="text-4xl font-bold text-gray-900 price-display" data-monthly="<?php echo e(number_format($plan->price_monthly, 2)); ?>" data-yearly="<?php echo e(number_format($plan->price_yearly, 2)); ?>">£<?php echo e(number_format($plan->price_monthly, 2)); ?></span>
                    <span class="text-gray-600 period-text">/person/month</span>
                </div>

                <p class="text-sm text-red-600 mb-6">You are not subscribed to any plan</p>

                <?php if(auth()->check()): ?>
                    <a href="<?php echo e(route('customer.subscription.checkout', ['plan' => $plan->id, 'period' => 'monthly'])); ?>" class="checkout-link block w-full py-3 px-4 rounded-lg font-medium text-center transition-colors <?php echo e($loop->iteration == 2 ? 'bg-red-600 hover:bg-red-700 text-white' : 'bg-gray-800 hover:bg-gray-900 text-white'); ?>" data-plan-id="<?php echo e($plan->id); ?>">
                        Subscribe
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('register')); ?>"
                        class="block w-full py-3 px-4 rounded-lg font-medium text-center transition-colors <?php echo e($loop->iteration == 2 ? 'bg-red-600 hover:bg-red-700 text-white' : 'bg-gray-800 hover:bg-gray-900 text-white'); ?>">
                        Subscribe
                    </a>
                <?php endif; ?>

                <div class="mt-8">
                    <p class="font-semibold text-gray-900 mb-4">WHAT'S INCLUDED</p>
                    <ul class="space-y-3">
                        <?php if($plan->options): ?>
                            <?php $__currentLoopData = json_decode($plan->options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-red-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-700 text-sm"><?php echo e($feature); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Business Plans -->
    <div id="businessPlans" class="hidden grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
        <?php $__currentLoopData = $businessPlans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white border-2 <?php echo e($loop->iteration == 2 ? 'border-red-500' : 'border-gray-200'); ?> rounded-lg p-8 relative" data-plan-id="<?php echo e($plan->id); ?>">
                <?php if($loop->iteration == 2): ?>
                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-1 rounded-full text-xs font-bold">
                        POPULAR
                    </div>
                <?php endif; ?>
                
                <h3 class="text-2xl font-bold text-gray-900 mb-4"><?php echo e(str_replace('Business ', '', $plan->name)); ?></h3>
                
                <div class="mb-6">
                    <span class="text-4xl font-bold text-gray-900 price-display" data-monthly="<?php echo e(number_format($plan->price_monthly, 2)); ?>" data-yearly="<?php echo e(number_format($plan->price_yearly, 2)); ?>">£<?php echo e(number_format($plan->price_monthly, 2)); ?></span>
                    <span class="text-gray-600 period-text">/person/month</span>
                </div>

                <p class="text-sm text-red-600 mb-6">You are not subscribed to any plan</p>

                <?php if(auth()->check()): ?>
                    <a href="<?php echo e(route('customer.subscription.checkout', ['plan' => $plan->id, 'period' => 'monthly'])); ?>" class="checkout-link block w-full py-3 px-4 rounded-lg font-medium text-center transition-colors <?php echo e($loop->iteration == 2 ? 'bg-red-600 hover:bg-red-700 text-white' : 'bg-gray-800 hover:bg-gray-900 text-white'); ?>" data-plan-id="<?php echo e($plan->id); ?>">
                        Subscribe
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('register')); ?>"
                        class="block w-full py-3 px-4 rounded-lg font-medium text-center transition-colors <?php echo e($loop->iteration == 2 ? 'bg-red-600 hover:bg-red-700 text-white' : 'bg-gray-800 hover:bg-gray-900 text-white'); ?>">
                        Subscribe
                    </a>
                <?php endif; ?>

                <div class="mt-8">
                    <p class="font-semibold text-gray-900 mb-4">WHAT'S INCLUDED</p>
                    <ul class="space-y-3">
                        <?php if($plan->options): ?>
                            <?php $__currentLoopData = json_decode($plan->options); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-red-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-700 text-sm"><?php echo e($feature); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<script>
function showPlans(type) {
    const personalBtn = document.getElementById('personalBtn');
    const businessBtn = document.getElementById('businessBtn');
    const personalPlans = document.getElementById('personalPlans');
    const businessPlans = document.getElementById('businessPlans');

    if (type === 'Personal') {
        personalBtn.classList.add('bg-gray-800', 'text-white');
        personalBtn.classList.remove('text-gray-700');
        businessBtn.classList.remove('bg-gray-800', 'text-white');
        businessBtn.classList.add('text-gray-700');
        personalPlans.classList.remove('hidden');
        businessPlans.classList.add('hidden');
    } else {
        businessBtn.classList.add('bg-gray-800', 'text-white');
        businessBtn.classList.remove('text-gray-700');
        personalBtn.classList.remove('bg-gray-800', 'text-white');
        personalBtn.classList.add('text-gray-700');
        businessPlans.classList.remove('hidden');
        personalPlans.classList.add('hidden');
    }
}

function updatePrices() {
    const period = document.getElementById('periodSelect').value;
    const priceDisplays = document.querySelectorAll('.price-display');
    const periodTexts = document.querySelectorAll('.period-text');
    const checkoutLinks = document.querySelectorAll('.checkout-link');

    priceDisplays.forEach((display) => {
        const monthlyPrice = display.getAttribute('data-monthly');
        const yearlyPrice = display.getAttribute('data-yearly');

        if (period === 'monthly') {
            display.textContent = '£' + monthlyPrice;
        } else {
            display.textContent = '£' + yearlyPrice;
        }
    });

    periodTexts.forEach((text) => {
        if (period === 'monthly') {
            text.textContent = '/person/month';
        } else {
            text.textContent = '/person/year';
        }
    });

    checkoutLinks.forEach((link) => {
        const planId = link.getAttribute('data-plan-id');
        const baseUrl = link.getAttribute('href').split('?')[0];
        link.href = baseUrl + '?plan=' + planId + '&period=' + period;
    });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/emilvaklinov/Desktop/eze.project/ezepost-app/resources/views/public/pricing.blade.php ENDPATH**/ ?>