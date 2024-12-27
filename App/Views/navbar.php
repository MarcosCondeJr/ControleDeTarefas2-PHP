<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="public/css/styleNavbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar bg-dark navbar-dark navbar-expand-sm">
        <div class="container-fluid">
            <a href="" class="navbar-brand d-flex align-items-center" id="navbar-brand">Controle de Tarefas</a>
            <button class="navbar-toggler" type="button" 
                data-bs-toggle="collapse" 
                data-bs-target="#menuNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menuNavbar">
                <div class="navbar-nav">
                    <a href="#" class="nav-link">Tarefas</a>
                    <a href="#" class="nav-link">Usuários</a>
                    <a href="<?= BASE_URL ?>/cadastro-categoria" class="nav-link">Categorias</a>
                </div>
                <div class="navbar-nav ms-auto">
                    <div class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle"
                                data-bs-toggle="dropdown">
                            <i class="bi bi-person" id="person"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="#" class="dropdown-item">Meu Perfil</a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>