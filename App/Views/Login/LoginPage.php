<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body class="text-center">
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form action="<?= BASE_URL ?>/login" method="POST">
            <h1 class="h3 mb-4 fw-normal">Login</h1>
            <div class="form-floating">
                <input type="text" class="form-control mb-2" id="email_usuario" placeholder="Enter email" name="email_usuario" value="<?= $_POST['email_usuario'] ?? '' ?>">
                <label for="email_usuario">Email</label>
            </div>
                <div class="form-floating">
                <input type="password" class="form-control mb-2" id="senha_usuario" maxlength="8" placeholder="Enter password" name="senha_usuario" value="<?= $_POST['senha_usuario'] ?? '' ?>">
                <span class="position-absolute top-50 end-0 translate-middle-y me-3" onclick="togglePasswordVisibility()">
                    <i id="eye-icon" class="fas fa-eye"></i>
                </span>
                <label for="senha_usuario">Senha</label>
            </div>
            <!-- <div class="form-group form-check mb-3">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Lembrar usuário</label>
            </div> -->
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>

    <script src="public/js/sweetAlert2.js"></script>

    <script>
        function togglePasswordVisibility() {
            const senhaInput = document.getElementById('senha_usuario');
            const eyeIcon = document.getElementById('eye-icon');

            if (senhaInput.type === 'password') {
                senhaInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                senhaInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>

    <!-- Alert de Erro -->
    <?php if (isset($error)): ?>
        <script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Atenção',
                    text: '<?= $error ?>',
                    confirmButtonText: 'Ok'
                });
            }
        </script>
    <?php endif; ?>
</body>
</html>