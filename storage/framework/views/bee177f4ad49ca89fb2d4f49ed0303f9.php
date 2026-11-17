<h1>Contribuyentes</h1>

<?php if(auth()->user()->role === 'super_usuario'): ?>
    <a href="<?php echo e(route('contribuyentes.create')); ?>">Nuevo contribuyente</a>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('logout')); ?>">
    <?php echo csrf_field(); ?>
    <button type="submit">Cerrar sesión</button>
</form>

<?php if(session('success')): ?>

    <p><?php echo e(session('success')); ?></p>
<?php endif; ?>


<form method="GET" action="<?php echo e(route('contribuyentes.index')); ?>">
    <input name="tipo_documento" placeholder="Tipo de documento"
        value="<?php echo e(request('tipo_documento')); ?>">
    <input name="documento" placeholder="Documento"
        value="<?php echo e(request('documento')); ?>">
    <input name="nombre" placeholder="Nombres"
        value="<?php echo e(request('nombre')); ?>">
    <input name="apellidos" placeholder="Apellidos"
        value="<?php echo e(request('apellidos')); ?>">
    <input name="telefono" placeholder="Teléfono"
        value="<?php echo e(request('telefono')); ?>">

    <button type="submit">Filtrar</button>
    <a href="<?php echo e(route('contribuyentes.index')); ?>">Limpiar</a>
</form>



<table>
    <thead>
        <tr>
            <th>Tipo de documento</th>
            <th>Documento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <?php if(auth()->user()->role === 'super_usuario'): ?>
                <th>Acciones</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $contribuyentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contribuyente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($contribuyente->tipo_documento); ?></td>
                <td><?php echo e($contribuyente->documento); ?></td>
                <td><?php echo e($contribuyente->nombre); ?></td>
                <td><?php echo e($contribuyente->apellidos); ?></td>
                <td><?php echo e($contribuyente->telefono); ?></td>

                <td>
                    <?php if(auth()->user()->role === 'super_usuario'): ?>
                    <a href="<?php echo e(route('contribuyentes.show', $contribuyente)); ?>">Ver</a>
                    <a href="<?php echo e(route('contribuyentes.edit', $contribuyente)); ?>">Editar</a>
                    <form action="<?php echo e(route('contribuyentes.destroy', $contribuyente)); ?>"
                        method="POST"
                        style="display: inline"
                        onsubmit="return confirm('¿Eliminar este contribuyente?')">
                    <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit">Eliminar</button>
                    </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="6">No hay contribuyentes registrados.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php echo e($contribuyentes->links()); ?><?php /**PATH C:\laragon\www\pruebadev\resources\views/index.blade.php ENDPATH**/ ?>