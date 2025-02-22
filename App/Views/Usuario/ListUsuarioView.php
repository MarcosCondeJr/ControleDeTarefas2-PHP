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
        <button type="submit" class="btn mt-3 ps-1 fs-5" onclick="window.location.href='<?= BASE_URL ?>/home'">
            <i class="bi bi-arrow-left-circle"></i>
            Voltar
        </button>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h1>Lista de Usuários</h1>
        </div>
        <div class="form-group d-flex align-items-center mt-4">
            <form action="<?= BASE_URL ?>/usuario-search" method="GET" class="d-flex align-items-center">
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
                        <th>Tipo Usuário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if (!empty($usuarios)): ?>
                        <?php foreach($usuarios as $usuario) : ?>
                            <tr>
                                <td><?php echo $usuario['cd_usuario'] ?></td>
                                <td><?php echo $usuario['nm_usuario'] ?></td>
                                <td><?php echo $usuario['email_usuario'] ?></td>
                                <td><?php echo $usuario['telefone_usuario'] ?></td>
                                <td><?php echo $usuario['nm_tipo']?></td>
                                <td>
                                    <form action="<?= BASE_URL ?>/editar-usuario" method="GET" style ="display: inline-flex">
                                        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']) ?>">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                            Editar
                                        </button>
                                    </form>
                                    <form action="<?= BASE_URL ?>/delete-usuario" method="GET" id="deleteForm" style ="display: inline-flex">
                                        <input type="hidden" name="id_usuario" value="<?= htmlspecialchars($usuario['id_usuario']) ?>">
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
                            <td colspan="6">Nenhum registro encontrado.</td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="public/js/sweetAlert2.js"></script>

    <script>
        const deleteButtons = document.querySelectorAll('.deleteButton');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                
                const form = this.closest('form');
                const formAction = form.action;

                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Você não poderá reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sim',
                    confirmButtonColor: '#0d6efd',
                    cancelButtonText: 'Cancelar',
                    cancelButtonColor: '#d33',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    } else {
                        
                    }
                });
            });
        });
    </script>

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
</body>
</html>