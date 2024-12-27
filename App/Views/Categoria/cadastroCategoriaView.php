<?php include 'App/Views/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Categoria</title>
</head>
<body>
    <div class="container">
        <form action="">
            <h1 class="mt-5 mb-3">Cadastro de Categoria</h1>
            <div class="row">
                <div class="col-sm-2 mb-3">
                    <label for="codigoCategoria" class="form-label">Código</label>
                    <input style="background-color:rgb(232, 231, 231)" type="text" class="form-control" readonly>
                </div>
                <div class="col mb-3">
                    <label for="nomeCategoria" class="form-label">Nome Categoria</label>
                    <input type="text" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col mb-4">
                    <label for="ds_categoria" class="form-label">Descrição</label>
                    <textarea name="" id="" class="form-control"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
        </form>
    </div>
</body>
</html>