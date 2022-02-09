<?php $__env->startSection('content'); ?>
    <div class="message-info">
        <?php if(Session::has('error')): ?>
            <div class="alert alert-danger"><?php echo e(Session::pull('error')); ?></div>
        <?php endif; ?>
    </div>
    <table id="currency_table"

    >
        <thead>
            <tr>
                <th data-sortable="true" data-field="_id">ID</th>
                <th data-sortable="true" data-field="name">Name</th>
                <th data-sortable="true" data-field="code">Country Code</th>
                <th data-sortable="true" data-field="rate">Rate</th>

            </tr>
        </thead>
    </table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/curency/resources/views/content.blade.php ENDPATH**/ ?>