<div
    <?php echo e($attributes
            ->merge([
                'id' => $getId(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)); ?>

>
    <?php echo e($getChildComponentContainer()); ?>

</div>
<?php /**PATH C:\xampp\htdocs\23g_laravel_karangtaruna_go\vendor\filament\forms\resources\views/components/group.blade.php ENDPATH**/ ?>