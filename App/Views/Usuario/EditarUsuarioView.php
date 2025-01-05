<?php include 'App/Views/navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
    <div class="container">
        <button type="submit" class="btn mt-3 ps-1 fs-5" onclick="window.location.href='<?= BASE_URL ?>/usuarios'">
            <i class="bi bi-arrow-left-circle"></i>
            Voltar
        </button>
        <div class="mt-4">
            <form action="<?= BASE_URL ?>/update-usuario" id="formUsuario" method="POST">
                <h1 class="mb-4">Editar Usuário</h1>
                <div class="row mb-3">
                    <div class="col-sm-1">
                        <label for="" class="form-label">Código</label>
                        <input style="background-color:rgb(232, 231, 231)" type="text" class="form-control" name="cd_usuario" value="<?= $_POST['cd_usuario'] ?? $perfil['cd_usuario'] ?>" readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="" class="form-label required">Nome Usuário</label>
                        <input type="text" class="form-control" name="nm_usuario" value="<?= $_POST['nm_usuario'] ?? $usuario['nm_usuario'] ?>">
                    </div>
                    <div class="col">
                        <label for="" class="form-label required">Nome Completo</label>
                        <input type="text" class="form-control" name="nm_completo" value="<?= $_POST['nm_completo'] ?? $perfil['nm_completo'] ?>"> 
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="" class="form-label required">Email</label>
                        <input type="email" class="form-control" name="email_usuario" value="<?= $_POST['email_usuario'] ?? $usuario['email_usuario'] ?>">
                    </div>
                    <div class="col">
                        <label for="" class="form-label required">Telefone</label>
                        <input type="text" class="form-control" name="telefone_usuario" maxlength="15" id="telefone" value="<?= $_POST['telefone_usuario'] ?? $perfil['telefone_usuario'] ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="" class="form-label required">Tipo Usuário</label>
                        <select class="form-select" name="id_tipousuario">
                            <option>Selecione o tipo</option>
                            <?php foreach ($tipoUsuario as $tipo): ?>
                                    <option value="<?= $tipo['id_tipousuario'] ?>"
                                        <?php if ($tipo['id_tipousuario'] == $usuario['id_tipousuario']) echo 'selected'; ?>>
                                        <?= $tipo['nm_tipo'] ?>
                                    </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="" class="form-label required">Senha</label>
                        <input type="password" class="form-control" name="senha" id="senha" maxlength="8" value="<?= $_POST['senha'] ?? '' ?>">
                    </div>
                    <div class="col">
                        <label for="" class="form-label required">Confirmar Senha</label>
                        <input type="password" class="form-control" name="confirmar_senha" id="confirmarSenha" maxlength="8" value="<?= $_POST['confirmar_senha'] ?? '' ?>">
                        <div class="invalid-feedback">
                            As senhas não coincidem.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="" class="form-label">Descrição</label>
                        <textarea class="form-control" name="ds_usuario"><?= $_POST['ds_usuario'] ?? $perfil['ds_usuario'] ?></textarea>
                    </div>
                </div>
                <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?? $_POST['id_usuario'] ?>">
                <button type="button" class="btn btn-danger" id="cancelarButton">Cancelar</button>
                <button type="submit" class="btn btn-success" id="cad-categoria-btn">Salvar</button>
            </form>
        </div>
    </div>

    <script src="public/js/sweetAlert2.js"></script>
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

        // document.getElementById('confirmarSenha').addEventListener('input', function () {
        //     this.classList.remove('is-invalid');
        // });

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

    <!-- Alert de Sucesso -->
    <?php if (isset($sucesso)): ?>
        <script>
            window.onload = function() {
                Swal.fire({
                title: "Sucesso!",
                text: "Usuário Atualizado!",
                icon: "success",
                confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?= BASE_URL ?>/usuarios';
                    } else {
                        window.location.href = '<?= BASE_URL ?>/usuarios';
                    }
                });
            }
        </script>
    <?php endif; ?>

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

    <!-- Alert de Cancelar edição -->
    <script>
        document.getElementById('cancelarButton').addEventListener('click', function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Cancelar edição?',
                text: "Todas as alterações não salvas serão perdidas.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                confirmButtonColor: '#0d6efd',
                cancelButtonText: 'Não',
                cancelButtonColor: '#d33',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?= BASE_URL ?>/usuarios";
                }
            });
        });
    </script>
</body>
</html>