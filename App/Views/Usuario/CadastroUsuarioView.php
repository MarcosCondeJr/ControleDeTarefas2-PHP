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
            <form action="<?= BASE_URL ?>/create-usuario" id="formUsuario" method="POST">
                <h1 class="mb-4">Cadastro de Usuário</h1>
                <div class="row mb-3">
                    <div class="col-sm-1">
                        <label for="" class="form-label">Código</label>
                        <input style="background-color:rgb(232, 231, 231)" type="text" class="form-control" name="cd_usuario" value="<?= $_POST['cd_usuario'] ?? $codigo ?>" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="" class="form-label required">Nome Usuário</label>
                        <input type="text" class="form-control" name="nm_usuario">
                    </div>
                    <div class="col">
                        <label for="" class="form-label required">Nome Completo</label>
                        <input type="text" class="form-control" name="nm_completo">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="" class="form-label required">Email</label>
                        <input type="email" class="form-control" name="email_usuario">
                    </div>
                    <div class="col">
                        <label for="" class="form-label required">Telefone</label>
                        <input type="text" class="form-control" name="telefone_usuario" maxlength="15" id="telefone">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="" class="form-label required">Tipo Usuário</label>
                        <select class="form-select" name="id_tipousuario">
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
                        <input type="password" class="form-control" name="senha" id="senha" maxlength="8">
                    </div>
                    <div class="col">
                        <label for="" class="form-label required">Confirmar Senha</label>
                        <input type="password" class="form-control" name="confirmar_senha" id="confirmarSenha" maxlength="8">
                        <div class="invalid-feedback">
                            As senhas não coincidem.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="" class="form-label">Descrição</label>
                        <textarea class="form-control" name="ds_usuario"></textarea>
                    </div>
                </div>
                <input type="hidden" name="id_usuario">
                <button type="submit" class="btn btn-success" id="cad-categoria-btn">Salvar</button>
            </form>
        </div>
    </div>

    <script>
        //Verifica se o confirmar senha é igual ao da senha
        document.getElementById('formUsuario').addEventListener('submit', function (event) {
            const senha = document.getElementById('senha');
            const confirmarSenha = document.getElementById('confirmarSenha');

            if (senha.value !== confirmarSenha.value) {
                event.preventDefault();
                confirmarSenha.classList.add('is-invalid');
            } else {
                confirmarSenha.classList.remove('is-invalid');
            }
        });

        document.getElementById('confirmarSenha').addEventListener('input', function () {
            this.classList.remove('is-invalid');
        });

        // Mascara de input telefone
        function aplicarMascaraTelefone(event) {
            var input = event.target;
            var valor = input.value.replace(/\D/g, '');

            if (valor.length <= 2) {
                input.value = '(' + valor;
            } else if (valor.length <= 6) {
                input.value = '(' + valor.slice(0, 2) + ') ' + valor.slice(2);
            } else {
                input.value = '(' + valor.slice(0, 2) + ') ' + valor.slice(2, 7) + '-' + valor.slice(7, 11);
            }
        }
        document.getElementById('telefone').addEventListener('input', aplicarMascaraTelefone);
    </script>
</body>
</html>