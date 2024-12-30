<?php include 'App/Views/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuario</title>
</head>
<body>
    <div class="container">
        <button type="submit" class="btn mt-3 ps-1 fs-5" onclick="window.location.href='<?= BASE_URL ?>/usuarios'">
            <i class="bi bi-arrow-left-circle"></i>
            Voltar
        </button>
        <div class="mt-4">
            <form action="">
                <h1 class="mb-4">Cadastro de Usuário</h1>
                <div class="row mb-3">
                    <div class="col-sm-1">
                        <label for="" class="form-label">Código</label>
                        <input style="background-color:rgb(232, 231, 231)" type="text" class="form-control" class="cd_usuario" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="" class="form-label required">Nome Usuário</label>
                        <input type="text" class="form-control" class="nm_usuario">
                    </div>
                    <div class="col">
                        <label for="" class="form-label required">Nome Completo</label>
                        <input type="text" class="form-control" class="nm_completo">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="" class="form-label required">Email</label>
                        <input type="email" class="form-control" class="email_usuario">
                    </div>
                    <div class="col">
                        <label for="" class="form-label required">Telefone</label>
                        <input type="text" class="form-control" class="telefone_usuario">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="" class="form-label required">Tipo Usuário</label>
                        <select class="form-select">
                            <option>Selecione o tipo</option>
                            <?php foreach ($tipoUsuario as $tipo): ?>
                                    <option value="<?= $tipo['id_tipousuario']?>">
                                        <?= $tipo['nm_tipo'] ?>
                                    </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="" class="form-label required">Senha</label>
                        <input type="password" class="form-control" class="senha_usuario">
                    </div>
                    <div class="col">
                        <label for="" class="form-label required">Confirmar Senha</label>
                        <input type="password" class="form-control" class="senha_usuario">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="" class="form-label">Descrição</label>
                        <textarea class="form-control" class="form-control"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-success" id="cad-categoria-btn">Salvar</button>
            </form>
        </div>
    </div>
</body>
</html>