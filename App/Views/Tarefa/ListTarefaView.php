<?php include 'App/Views/navbar.php'; 
    var_dump($tipoHorario);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarefas</title>
</head>
<body>
    <div class="container">
        <button type="submit" class="btn mt-3 ps-1 fs-5" onclick="window.location.href='<?= BASE_URL ?>#'">
            <i class="bi bi-arrow-left-circle"></i>
            Voltar
        </button>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h1>Lista de Tarefas</h1>
        </div>
        <div class="form-group d-flex align-items-center mt-4">
            <form action="<?= BASE_URL ?>/#" method="GET" class="d-flex align-items-center">
                <input type="text" class="form-control me-1" name="filtro" value="<?= '' ?? '' ?>" placeholder="Consulta">
                <button type="button" class="btn btn-danger d-flex align-items-center" onclick="window.location.href='<?= BASE_URL ?>#'"><i class="bi bi-eraser-fill"></i></button>
                <button type="submit" class="btn btn-primary d-flex align-items-center ms-1">
                    Pesquisar
                    <i class="bi bi-search ms-1"></i>
                </button>
            </form>
            <button class="btn btn-success ms-2" onclick="window.location.href='<?= BASE_URL ?>/cadastro-tarefa'">
                Cadastrar
                <i class="bi bi-plus-circle ms-1"></i>
            </button>
        </div>
        <div class="mt-3">
            <table class="table table-striped border">
                <thead class="text-center">
                    <tr>
                        <th>Código</th>
                        <th>Titulo</th>
                        <th>Responsável</th>
                        <th>Categoria</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if (!empty($tarefas)): ?>
                        <?php foreach($tarefas as $taf) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($taf['cd_tarefa']) ?></td>
                                <td><?php echo htmlspecialchars($taf['titulo_tarefa']) ?></td>
                                <td><?php echo htmlspecialchars($taf['nm_usuario']) ?></td>
                                <td><?php echo htmlspecialchars($taf['nm_categoria']) ?></td>
                                <td><?php echo htmlspecialchars($taf['nm_situacao']) ?></td>
                                <td>
                                    <form action="" style ="display: inline-flex; align-items: center;">
                                        <div class="dropdown">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Ação
                                            </a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="#"></a><?php echo $tipoHorario[1] ?></li>
                                                    <li><a class="dropdown-item" href="#"></a><?php echo $tipoHorario[2] ?></li>
                                                    <li><a class="dropdown-item" href="#"></a><?php echo $tipoHorario[3] ?></li>
                                                    <li><a class="dropdown-item" href="#"></a><?php echo $tipoHorario[4] ?></li>
                                                </ul>
                                        </div>
                                    </form>
                                    <form action="<?= BASE_URL ?>#" method="GET" style ="display: inline-flex">
                                        <input type="hidden" name="id_usuario" value="">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </form>
                                    <form action="<?= BASE_URL ?>#" method="GET" id="deleteForm" style ="display: inline-flex">
                                        <input type="hidden" name="id_usuario" value="">
                                        <button type="submit" class="btn btn-danger deleteButton">
                                            <i class="bi bi-trash"></i>
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
</body>
</html>