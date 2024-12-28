<?php include 'App/Views/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Categoria</title>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mt-5">
            <h1>Lista de Categorias</h1>
           
        </div>
        <div class="form-group d-flex mt-5">
            <input type="text" class="form-control w-25" placeholder="Consulta">
            <button type="submit" class="btn btn-primary">
                Pesquisar
                <i class="bi bi-search"></i>
            </button>
            <button class="btn btn-success ms-2" onclick="window.location.href='<?= BASE_URL ?>/cadastro-categoria'">
                Cadastrar
                <i class="bi bi-plus-circle"></i>
            </button>
        </div>
        <div class="mt-3">
            <table class="table table-striped border">
                <thead class="text-center">
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if (!empty($categorias)): ?>
                        <?php foreach($categorias as $cat): ?>
                            <tr>
                                <td><?= htmlspecialchars($cat['cd_categoria']) ?></td>
                                <td><?= htmlspecialchars($cat['nm_categoria']) ?></td>
                                <td><?= htmlspecialchars($cat['ds_categoria']) ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                        Editar
                                    </a>
                                    <a href="#" class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                        Deletar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Nenhuma categoria encontrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>