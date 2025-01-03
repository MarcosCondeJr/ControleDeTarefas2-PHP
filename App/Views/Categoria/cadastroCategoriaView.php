<?php include 'App/Views/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro Categoria</title>
</head>
<body>
    <div class="container">
        <button type="submit" class="btn mt-3 ps-1 fs-5" onclick="window.location.href='<?= BASE_URL ?>/categoria'">
            <i class="bi bi-arrow-left-circle"></i>
            Voltar
        </button>
        <form action="<?= BASE_URL ?>/create-categoria" method="POST">
            <h1 class="mt-3 mb-3">Cadastro de Categoria</h1>
            <div class="row">
                <div class="col-sm-2 mb-3">
                    <label for="codigoCategoria" class="form-label">Código</label>
                    <input style="background-color:rgb(232, 231, 231)" type="text" class="form-control" name="cd_categoria" value="<?= $_POST['cd_categoria'] ?? $codigo ?>">
                </div>
                <div class="col mb-3">
                    <label for="nomeCategoria" class="form-label required">Nome Categoria</label>
                    <input type="text" class="form-control" name="nm_categoria" value="<?= $_POST['nm_categoria'] ?? '' ?>">
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

    <script src="public/js/sweetAlert2.js"></script>

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

    <!-- Alert de Sucesso -->
    <?php if (isset($sucesso)): ?>
        <script>
            window.onload = function() {
                Swal.fire({
                title: "Sucesso!",
                text: "Categoria Cadastrada!",
                icon: "success",
                confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?= BASE_URL ?>/categoria';
                    } else {
                        window.location.href = '<?= BASE_URL ?>/categoria';
                    }
                });
            }
        </script>
    <?php endif; ?>
</body>
</html>