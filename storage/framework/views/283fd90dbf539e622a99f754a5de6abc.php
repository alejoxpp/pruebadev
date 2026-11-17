<?php
    $editando = isset($contribuyente);
?>
<link rel="stylesheet" href="<?php echo e(asset('/style/form.css')); ?>">
<h1><?php echo e($editando ? 'Editar contribuyente' : 'Nuevo contribuyente'); ?></h1>
<?php if($errors->any()): ?>
    <div>
        <p>Error, por favor corrija:</p>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<form method="POST"
    action="<?php echo e($editando
        ? route('contribuyentes.update', $contribuyente)
        : route('contribuyentes.store')); ?>">

    <?php echo csrf_field(); ?>
    <?php if($editando): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>

    <?php if(! $editando): ?>
        <label for="role">Rol de la cuenta</label>
    <select id="role" name="role" required>
        <?php $__currentLoopData = [
            'usuario' => 'Usuario',
            'administrador' => 'Administrador',
            'super_usuario' => 'Súper Usuario',
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valor => $etiqueta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($valor); ?>" <?php if(old('role', 'usuario') === $valor): echo 'selected'; endif; ?>>
                <?php echo e($etiqueta); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php endif; ?>
    <?php
        $tiposDocumento = [
            'CC' => 'CC - Cédula de ciudadanía',
            'TI' => 'TI - Tarjeta de identidad',
            'CE' => 'CE - Cédula de extranjería',
            'NIT' => 'NIT',
            'Pasaporte' => 'Pasaporte',
        ];

        $tipoActual = old('tipo_documento', $contribuyente->tipo_documento ?? '');
    ?>

    <label for="tipo_documento">Tipo de documento</label>
    <select id="tipo_documento" name="tipo_documento" required>
        <option value="" disabled <?php if($tipoActual === ''): echo 'selected'; endif; ?>>Seleccione...</option>

        <?php if($tipoActual !== '' && ! array_key_exists($tipoActual, $tiposDocumento)): ?>
            <option value="<?php echo e($tipoActual); ?>" selected><?php echo e($tipoActual); ?></option>
        <?php endif; ?>

        <?php $__currentLoopData = $tiposDocumento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valor => $etiqueta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($valor); ?>" <?php if($tipoActual === $valor): echo 'selected'; endif; ?>>
                <?php echo e($etiqueta); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <label>Documento</label>
    <input name="documento"
        value="<?php echo e(old('documento', $contribuyente->documento ?? '')); ?>" required>

    <div id="persona-fields">
        <label>Nombres</label>
        <input name="nombre" value="<?php echo e(old('nombre', $contribuyente->nombre ?? '')); ?>">

        <label>Apellidos</label>
        <input name="apellidos" value="<?php echo e(old('apellidos', $contribuyente->apellidos ?? '')); ?>">
    </div>

    <div id="nit-fields" hidden>
        <label>Razón social</label>
        <input id="razon_social" name="razon_social"
            value="<?php echo e(old('razon_social', trim(($contribuyente->nombre ?? '') . ' ' . ($contribuyente->apellidos ?? '')))); ?>">
    </div>

    <label>Dirección</label>
    <input name="direccion" value="<?php echo e(old('direccion', $contribuyente->direccion ?? '')); ?>" required>

    <label>Teléfono</label>
    <input name="telefono" value="<?php echo e(old('telefono', $contribuyente->telefono ?? '')); ?>" required>

    <label>Celular</label>
    <input name="celular" value="<?php echo e(old('celular', $contribuyente->celular ?? '')); ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?php echo e(old('email', $contribuyente->email ?? '')); ?>" required>

    <label>Usuario</label>
    <input name="usuario" value="<?php echo e(old('usuario', $contribuyente->usuario ?? '')); ?>" required>

    <?php if(! $editando): ?>
    <label>Contraseña temporal</label>
    <input type="password" name="password"
        autocomplete="new-password" minlength="8" required>

    <label>Confirmar contraseña</label>
    <input type="password" name="password_confirmation"
        autocomplete="new-password" minlength="8" required>
    <?php endif; ?>

    <button type="submit"><?php echo e($editando ? 'Actualizar' : 'Guardar'); ?></button>
</form>
<a href="<?php echo e(route('contribuyentes.index')); ?>">Volver al listado</a>

<script>
    const tipoDocumento = document.getElementById('tipo_documento');
    const personaFields = document.getElementById('persona-fields');
    const nitFields = document.getElementById('nit-fields');
    const razonSocial = document.getElementById('razon_social');

    function actualizarCampos() {
        const esNit = tipoDocumento.value.trim().toUpperCase() === 'NIT';

        personaFields.hidden = esNit;
        nitFields.hidden = !esNit;
        personaFields.querySelectorAll('input').forEach(input => input.disabled = esNit);
        razonSocial.disabled = !esNit;
    }

    tipoDocumento.addEventListener('change', actualizarCampos);
</script><?php /**PATH C:\laragon\www\pruebadev\resources\views/contribuyentes/form.blade.php ENDPATH**/ ?>