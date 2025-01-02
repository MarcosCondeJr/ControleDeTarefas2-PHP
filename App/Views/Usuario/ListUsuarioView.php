<?php include 'App/Views/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
</head>
<body>
    <div class="container">
        <button type="submit" class="btn mt-3 ps-1 fs-5" onclick="window.location.href='<?= BASE_URL ?>/'">
            <i class="bi bi-arrow-left-circle"></i>
            Voltar
        </button>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h1>Lista de Usuários</h1>
        </div>
        <div class="form-group d-flex align-items-center mt-4">
            <form action="#" method="GET" class="d-flex align-items-center">
                <input type="text" class="form-control me-1" name="filtro" value="<?= $_GET['filtro'] ?? '' ?>" placeholder="Consulta">
                <button type="button" class="btn btn-danger d-flex align-items-center" onclick="window.location.href='<?= BASE_URL ?>/usuarios'"><i class="bi bi-eraser-fill"></i></button>
                <button type="submit" class="btn btn-primary d-flex align-items-center ms-1">
                    Pesquisar
                    <i class="bi bi-search ms-1"></i>
                </button>
            </form>
            <button class="btn btn-success ms-2" onclick="window.location.href='<?= BASE_URL ?>/cadastro-usuario'">
                Cadastrar
                <i class="bi bi-plus-circle ms-1"></i>
            </button>
        </div>
        <div class="mt-3">
            <table class="table table-striped border">
                <thead class="text-center">
                    <tr>
                        <th>Código</th>
                        <th>Nome Usuario</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if (!empty($usuarios)): ?>
                        <?php foreach($usuarios as $usuario) : ?>
                            <tr>
                                <td><?php echo $usuario['cd_usuario'] ?></td>
                                <td><?= $usuario['nm_usuario'] ?></td>
                                <td><?= $usuario['email_usuario'] ?></td>
                                <td><?= $usuario['telefone_usuario'] ?></td>
                                <td>
                                    <form action="<?= BASE_URL ?>#" method="GET" style = "display: inline-flex">
                                        <input type="hidden" name="id_categoria" value="">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                            Editar
                                        </button>
                                    </form>
                                    <form action="<?= BASE_URL ?>#" method="POST" id="deleteForm" style = "display: inline-flex">
                                        <input type="hidden" name="id_categoria" value="">
                                        <button type="submit" class="btn btn-danger deleteButton">
                                            <i class="bi bi-trash"></i>
                                            Deletar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Nenhum registro encontrado.</td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>