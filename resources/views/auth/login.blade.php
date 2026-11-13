<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap">
    <link rel="stylesheet" href="{{ asset('style/login.css') }}">
</head>


<body>
    <div class="content">
        <form method ="POST" action="{{ route('login.authenticate') }}" class="login-form">
          @csrf
          @if ($errors->any())
          <div class="alert-error" role="alert">
              @foreach ($errors->all() as $error)
                  <p>{{ $error }}</p>
              @endforeach
          </div>
          @endif
            <div class="form-header">
                <h2>Bienvenido</h2>
                <p>Por favor ingrese sus credenciales</p>
            </div>

            <div class="field-group">
                <label for="username">Email</label>
                <div class="input-box">
                    <i class="ri-user-line input-icon"></i>
                      <input type="email" id="email" name="email"
                      placeholder="Ingrese su email" autocomplete="username" required>
                </div>
            </div>

            <div class="field-group">
                <label for="password">Password</label>
                <div class="input-box">
                    <i class="ri-lock-line input-icon"></i>
                    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" 
                        autocomplete="current-password" required>
                    <i class="ri-eye-off-line toggle-password" id="togglePassword"></i>
                </div>
            </div>

          <!-- Boton de recordar y enlace de contraseña olvidada comentados
            <div class="remember">
                <label class="remember-label">
                    <input type="checkbox" id="remember" name="remember" />
                    <span>Recordarme</span>
                </label>
                <a href="#" class="forgot-link">¿Olvidaste tu contraseña?</a>
            </div>
          -->

            <button type="submit" class="btn">Ingresar</button>

            <div class="divider">
                <span>O continua con</span>
            </div>

            <div class="social-buttons">
                <a href="#" class="social-btn google-btn">
                    <i class="ri-google-fill google-icon"></i>
                    <div class="social-info">
                        <span class="social-name">Google</span>
                        <span class="social-sub">Ingresa con Google</span>
                    </div>
                </a>
                <a href="#" class="social-btn facebook-btn">
                    <i class="ri-facebook-fill facebook-icon"></i>
                    <div class="social-info">
                        <span class="social-name">Facebook</span>
                        <span class="social-sub">Ingresa con Facebook</span>
                    </div>
                </a>
            </div>
        </form>
    </div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function() {
        // Toggle the type attribute using getAttribute() method
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Toggle the eye icon
        this.classList.toggle('ri-eye-line');
    });
</script>

</body>

</html>
