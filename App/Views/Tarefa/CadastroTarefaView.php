<?php include 'App/Views/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro Tarefa</title>
</head>
<body>
    <div class="container">
        <button type="submit" class="btn mt-3 ps-1 fs-5" onclick="window.location.href='<?= BASE_URL ?>/tarefas'">
            <i class="bi bi-arrow-left-circle"></i>
            Voltar
        </button>
        <form action="<?= BASE_URL ?>/create-tarefa" method="POST">
            <h1 class="mt-3 mb-3">Cadastro de Tarefa</h1>
            <div class="row">
                <div class="col-sm-1 mb-3">
                    <label for="codigo_tarefa" class="form-label">Código</label>
                    <input style="background-color:rgb(232, 231, 231)" type="text" class="form-control" name="cd_categoria" value="<?= $_POST['cd_categoria'] ?? '' ?>" readonly>
                </div>
                <div class="col-sm-5 mb-3">
                    <label for="titulo_tarefa" class="form-label required">Titulo</label>
                    <input type="text" class="form-control" name="titulo_categoria" value="<?= $_POST['titulo_categoria'] ?? '' ?>">
                </div>
                <div class="col">
                        <label for="" class="form-label required">Responsável</label>
                        <select class="form-select" name="id_usuario">
                            <option></option>
                                    <option value="">
                        </select>
                </div>
                <div class="col">
                        <label for="" class="form-label required">Categoria</label>
                        <select class="form-select" name="id_usuario">
                            <option></option>
                                    <option value="">
                        </select>
                </div>
            </div>
            <div class="row">
                <div class="col mb-4">
                    <label for="ds_categoria" class="form-label">Descrição</label>
                    <textarea id="" class="form-control" name="ds_categoria"><?= $_POST['ds_categoria'] ?? '' ?></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-success" id="cad-categoria-btn">Salvar</button>
        </form>
    </div>
</body>
</html>