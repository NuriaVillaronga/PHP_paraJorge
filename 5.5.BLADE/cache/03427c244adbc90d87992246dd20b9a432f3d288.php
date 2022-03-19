<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title><?php echo $__env->yieldContent('titulo'); ?></title>
</head>

<body>

    <div class="container mt-3">
        <h3 class="text-center mt-3 mb-3"><?php echo $__env->yieldContent('encabezado'); ?></h3>
        <?php echo $__env->yieldContent('contenido'); ?>
    </div>

</body>
</html><?php /**PATH /var/www/html/5.5.BLADE/views/plantillas/plantillaEstructura.blade.php ENDPATH**/ ?>