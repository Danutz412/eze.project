<?php $__env->startSection('title', 'Team Management'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6 flex justify-between items-center">
    <div>
        <h3 class="text-2xl font-bold">All Teams</h3>
        <p class="text-gray-600">Manage teams and their licenses</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Team Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Owner</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Members</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Licenses</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            <?php $__empty_1 = true; $__currentLoopData = $teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $team): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo e($team->id); ?></td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="font-medium text-gray-900"><?php echo e($team->name); ?></div>
                    <?php if($team->description): ?>
                        <div class="text-sm text-gray-500"><?php echo e(Str::limit($team->description, 40)); ?></div>
                    <?php endif; ?>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <?php echo e($team->owner->name ?? 'N/A'); ?>

                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <?php echo e($team->members_count); ?>

                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm">
                        <span class="font-medium"><?php echo e($team->used_licenses); ?>/<?php echo e($team->total_licenses); ?></span>
                        <?php if($team->pending_invitations > 0): ?>
                            <span class="text-yellow-600 text-xs">(+<?php echo e($team->pending_invitations); ?> pending)</span>
                        <?php endif; ?>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs rounded-full <?php echo e($team->is_personal ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800'); ?>">
                        <?php echo e($team->is_personal ? 'Personal' : 'Business'); ?>

                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <?php echo e($team->created_at->format('M d, Y')); ?>

                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <a href="<?php echo e(route('admin.teams.show', $team)); ?>" class="text-blue-600 hover:text-blue-800">
                        View Details
                    </a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <p class="font-medium">No teams found</p>
                    <p class="text-sm">Teams will appear here once created</p>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="mt-6">
    <?php echo e($teams->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/emilvaklinov/Desktop/eze.project/ezepost-app/resources/views/admin/teams/index.blade.php ENDPATH**/ ?>