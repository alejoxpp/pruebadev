<h1>Información del contribuyente</h1>

<dl>
    <dt>Tipo de documento</dt>
    <dd><?php echo e($contribuyente->tipo_documento); ?></dd>

    <dt>Documento</dt>
    <dd><?php echo e($contribuyente->documento); ?></dd>

    <dt>Nombre completo</dt>
    <dd><?php echo e($contribuyente->nombre_completo); ?></dd>

    <dt>Dirección</dt>
    <dd><?php echo e($contribuyente->direccion); ?></dd>

    <dt>Teléfono</dt>
    <dd><?php echo e($contribuyente->telefono); ?></dd>

    <dt>Celular</dt>
    <dd><?php echo e($contribuyente->celular); ?></dd>

    <dt>Email</dt>
    <dd><?php echo e($contribuyente->email); ?></dd>

    <dt>Usuario</dt>
    <dd><?php echo e($contribuyente->usuario); ?></dd>

    <dt>Fecha del sistema</dt>
    <dd><?php echo e($contribuyente->fecha_sistema); ?></dd>
</dl>

<a href="<?php echo e(route('contribuyentes.index')); ?>">Volver al listado</a><?php /**PATH C:\laragon\www\pruebadev\resources\views/contribuyentes/show.blade.php ENDPATH**/ ?>