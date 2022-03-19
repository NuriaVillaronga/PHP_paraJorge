 

<?php $__env->startSection('titulo'); ?>
    <?php echo e($titulo); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('encabezado'); ?>
    <?php echo e($encabezado); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('contenido'); ?>
    <table class="table table-striped">
        <thead>
            <tr class="text-center">
                <th scope="col">Código</th>
                <th scope="col">Nombre</th>
                <th scope="col">Nombre Corto</th>
                <th scope="col">Precio</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $listaProductos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                <tr class="text-center">
                    <th scope="row"><?php echo e($producto->id); ?></th>
                    <td><?php echo e($producto->nombre); ?></td>
                    <td><?php echo e($producto->nombre_corto); ?></td>
                    <?php if($producto->pvp>100): ?>
                        <th class='text-danger'><?php echo e($producto->pvp); ?> €</th>
                    <?php else: ?>
                        <th class='text-success'><?php echo e($producto->pvp); ?> €</th>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <center>
        <form class="form">
            <p>
                <br><button type="submit" class="btn btn-primary" formaction="../public/portada.php">Volver ao inicio</button>
            </p>
        </form>
    </center>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.plantillaEstructura', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/5.5.BLADE/views/vistaProductos.blade.php ENDPATH**/ ?>