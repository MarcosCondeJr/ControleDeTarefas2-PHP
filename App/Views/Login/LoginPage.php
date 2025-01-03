<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body class="text-center">
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form action="<?= BASE_URL ?>/" method="POST">
            <h1 class="h3 mb-4 fw-normal">Login</h1>
            <div class="form-floating">
                <input type="text" class="form-control mb-2" id="email" placeholder="Enter email" name="email">
                <label for="email">Email</label>
            </div>
                <div class="form-floating">
                <input type="text" class="form-control mb-2" id="pwd" placeholder="Enter password" name="pswd">
                <label for="pwd">Senha</label>
            </div>
            <div class="form-group form-check mb-3">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Lembrar usuário Salvo</label>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>
</body>
</html>