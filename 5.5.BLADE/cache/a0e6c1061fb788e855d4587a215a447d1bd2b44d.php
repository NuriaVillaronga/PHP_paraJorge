<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('encabezado'); ?>
    <?php echo e($encabezado); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
    <center>
        <form class="form">
            <p>
                <br><button type="submit" class="btn btn-primary" formaction="../public/productos.php">Ver productos</button>
            </p>
            <p>
                <br><button type="submit" class="btn btn-primary" formaction="../public/familias.php">Ver familias</button>
            </p>
        </form>
    </center>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantillaEstructura', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/5.5.BLADE/views/vistaPortada.blade.php ENDPATH**/ ?>