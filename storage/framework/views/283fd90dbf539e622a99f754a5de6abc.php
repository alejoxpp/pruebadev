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
<form id="contribuyente-form"
    data-unicidad-url="<?php echo e(route('contribuyentes.validar-unicidad')); ?>"
    data-contribuyente-id="<?php echo e($contribuyente->id ?? ''); ?>"
    method="POST"
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
    <label for="documento">Documento</label>
    <input id="documento" name="documento" maxlength="25"
        value="<?php echo e(old('documento', $contribuyente->documento ?? '')); ?>" required>
        <small id="documento-feedback" aria-live="polite"></small>


    <div id="persona-fields">
        <label for="nombre">Nombres</label>
        <input id="nombre" name="nombre" value="<?php echo e(old('nombre', $contribuyente->nombre ?? '')); ?>">

        <label for="apellidos">Apellidos</label>
        <input id="apellidos" name="apellidos" value="<?php echo e(old('apellidos', $contribuyente->apellidos ?? '')); ?>">
    </div>

    <div id="nit-fields" hidden>
        <label for="razon_social">Razón social</label>
        <input id="razon_social" name="razon_social"
            value="<?php echo e(old('razon_social', trim(($contribuyente->nombre ?? '') . ' ' . ($contribuyente->apellidos ?? '')))); ?>">
    </div>

    <label for="direccion">Dirección</label>
    <input id="direccion" name="direccion" value="<?php echo e(old('direccion', $contribuyente->direccion ?? '')); ?>" required>

    <label for="telefono">Teléfono</label>
    <input id="telefono" name="telefono" value="<?php echo e(old('telefono', $contribuyente->telefono ?? '')); ?>" required>

    <label for="celular">Celular</label>
    <input id="celular" name="celular" value="<?php echo e(old('celular', $contribuyente->celular ?? '')); ?>" required>

    <label for="email">Email</label>
    <input id="email" type="email" name="email" maxlength="100" value="<?php echo e(old('email', $contribuyente->email ?? '')); ?>" required>
    <small id="email-feedback" aria-live="polite"></small>

    <label for="usuario">Usuario</label>
    <input id="usuario" name="usuario" maxlength="30" value="<?php echo e(old('usuario', $contribuyente->usuario ?? '')); ?>" required>
    <small id="usuario-feedback" aria-live="polite"></small>

    <?php if(! $editando): ?>
    <label for="password">Contraseña temporal</label>
    <input id="password" type="password" name="password"
        autocomplete="new-password" minlength="8" required>
    <label for="password_confirmation">Confirmar contraseña</label>
    <input id="password_confirmation" type="password" name="password_confirmation"
        autocomplete="new-password" minlength="8" required>
    <?php endif; ?>
    <small id="password-feedback" aria-live="polite"></small>

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
        personaFields.querySelectorAll('input').forEach(input => {
            input.disabled = esNit;
        });
        razonSocial.disabled = !esNit;
    }

    tipoDocumento.addEventListener('change', actualizarCampos);
    actualizarCampos();

    const formulario = document.getElementById('contribuyente-form');
    const controladores = {};
    const temporizadores = {};
    let verificandoEnvio = false;
    let enviarTrasVerificar = false;

    async function verificarUnicidad(campo, input, aviso) {
        const valor = input.value.trim();

        input.setCustomValidity('');

        if (!valor) {
            aviso.textContent = '';
            return true;
        }

        if (campo === 'email' && !input.checkValidity()) {
            aviso.textContent = 'Ingresa un email válido.';
            return false;
        }

        if (controladores[campo]) {
            controladores[campo].abort();
        }

        const controlador = new AbortController();
        controladores[campo] = controlador;
        aviso.textContent = 'Verificando...';

        const datos = new URLSearchParams({
            _token: formulario.querySelector('[name="_token"]').value,
            campo,
            valor,
        });

        if (formulario.dataset.contribuyenteId) {
            datos.set('contribuyente_id', formulario.dataset.contribuyenteId);
        }

        try {
            const respuesta = await fetch(formulario.dataset.unicidadUrl, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
                },
                body: datos,
                signal: controlador.signal,
            });

            if (input.value.trim() !== valor) {
                return true;
            }

            if (!respuesta.ok) {
                aviso.textContent =
                    'No se pudo verificar ahora; el servidor lo comprobará al guardar.';
                return true;
            }

            const resultado = await respuesta.json();

            if (!resultado.disponible) {
                const mensaje = campo === 'email'
                    ? 'Este email ya está registrado.'
                    : 'Este documento ya está registrado.';

                input.setCustomValidity(mensaje);
                aviso.textContent = mensaje;
                return false;
            }

            aviso.textContent = 'Disponible.';
            return true;
        } catch (error) {
            if (error.name === 'AbortError') {
                return true;
            }

            aviso.textContent =
                'No se pudo verificar ahora; el servidor lo comprobará al guardar.';
            return true;
        }
    }

    function prepararVerificacion(campo, input, aviso) {
        input.addEventListener('input', () => {
            input.setCustomValidity('');
            aviso.textContent = '';
            clearTimeout(temporizadores[campo]);

            temporizadores[campo] = setTimeout(() => {
                verificarUnicidad(campo, input, aviso);
            }, 400);
        });

        input.addEventListener('blur', () => {
            verificarUnicidad(campo, input, aviso);
        });
    }

    const documento = document.getElementById('documento');
    const email = document.getElementById('email');

    prepararVerificacion(
        'documento',
        documento,
        document.getElementById('documento-feedback')
    );

    prepararVerificacion(
        'email',
        email,
        document.getElementById('email-feedback')
    );

    const password = document.getElementById('password');
    const confirmacion = document.getElementById('password_confirmation');
    const avisoPassword = document.getElementById('password-feedback');

    function validarContrasenas() {
        if (!password || !confirmacion) {
            return true;
        }

        const noCoinciden =
            confirmacion.value !== '' && password.value !== confirmacion.value;

        const mensaje = noCoinciden ? 'Las contraseñas no coinciden.' : '';
        confirmacion.setCustomValidity(mensaje);
        avisoPassword.textContent = mensaje;

        return !noCoinciden;
    }

    if (password && confirmacion) {
        password.addEventListener('input', validarContrasenas);
        confirmacion.addEventListener('input', validarContrasenas);
    }

    formulario.addEventListener('submit', async event => {
        if (enviarTrasVerificar) {
            enviarTrasVerificar = false;
            return;
        }

        event.preventDefault();

        if (verificandoEnvio) {
            return;
        }

        verificandoEnvio = true;

        try {
            const contrasenasValidas = validarContrasenas();
            const [documentoDisponible, emailDisponible] = await Promise.all([
                verificarUnicidad(
                    'documento',
                    documento,
                    document.getElementById('documento-feedback')
                ),
                verificarUnicidad(
                    'email',
                    email,
                    document.getElementById('email-feedback')
                ),
            ]);

            if (
                contrasenasValidas &&
                documentoDisponible &&
                emailDisponible &&
                formulario.reportValidity()
            ) {
                enviarTrasVerificar = true;
                formulario.requestSubmit();
            }
        } finally {
            verificandoEnvio = false;
        }
    });
</script><?php /**PATH C:\laragon\www\pruebadev\resources\views/contribuyentes/form.blade.php ENDPATH**/ ?>