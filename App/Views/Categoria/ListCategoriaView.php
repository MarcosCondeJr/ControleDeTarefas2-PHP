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
        <div class="d-flex justify-content-between align-items-center mt-4">
            <h1>Lista de Categorias</h1>
            <button class="btn btn-primary ms-auto" onclick="window.location.href='<?= BASE_URL ?>/categoria/cadastro-categoria'">Cadastrar</button>
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
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="#" class="btn btn-warning">Editar</a>
                            <a href="#" class="btn btn-danger">Deletar</a>
                         </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>