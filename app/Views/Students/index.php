<?= $this->extend('Layouts/main'); ?>

<?= $this->section('title') ?>
<?php echo $title ?? ''; ?>
<?php echo $this->endSection() ?>

<?= $this->section('css'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.24.1/dist/bootstrap-table.min.css">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control cpf"
                                name="cpf"
                                id="cpf"
                                placeholder="CPF do responsável">
                            <label for="cpf">CPF do responsável para incluir um novo aluno</label>
                            <?= display_error('cpf', $errors) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-4">
                    <table class="table align-items-center justify-content-center mb-0" id="table">
                        <thead>
                            <tr>
                                <th class="text-secondary text-xxs font-weight-bolder opacity-7">Ações</th>
                                <th class="text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nome</th>
                                <th class="text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                <th class="text-secondary text-xxs font-weight-bolder opacity-7 ps-2">CPF</th>
                                <th class="text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Celular</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($students as $student): ?>
                                <tr>
                                    <td class="align-middle pb-0">
                                        <a class="btn bg-gradient-info btn-sm" href="<?= route_to('students.show', Encrypt($student->id)); ?>">
                                            <i class="fa-solid fa-eye me-2" style="font-size: 16px;"></i>Detalhes
                                        </a>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-start justify-content-start">
                                            <div>
                                                <h6 class="mb-0 text-sm"><?= $student->name; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-start justify-content-start">
                                            <div>
                                                <h6 class="mb-0 text-sm"><?= $student->email; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-start justify-content-start">
                                            <div>
                                                <h6 class="mb-0 text-sm"><?= $student->cpf; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-start justify-content-start">
                                            <div>
                                                <h6 class="mb-0 text-sm"><?= $student->phone; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js'); ?>

<script>
    // buscamos o responsável quando preenchido o campo de cpf e renderizamos a view para criação de novo aluno
    document.addEventListener("DOMContentLoaded", function() {
        const cpfInput = document.getElementById("cpf");
        const btnSearchParent = document.getElementById("btnSearchParent");
        const boxBtnNewParent = document.getElementById("boxBtnNewParent");

        btnSearchParent.addEventListener("click", function() {

            // ocultamos o botão para criar o responsável
            boxBtnNewParent.className = 'd-none';

            const cpf = cpfInput.value;

            if (!cpf) {

                return;
            }

            btnSearchParent.disabled = true;
            btnSearchParent.textContent = "Aguarde...";

            // podemos buscar o responsável...

            const url = `<?php echo route_to('api.fetch.parent.by.cpf') ?>?cpf=${cpf}`;

            fetch(url)
                .then(response => response.json())
                .then(data => {

                    btnSearchParent.disabled = false;
                    btnSearchParent.textContent = "Buscar responsável";

                    if (data.parent === null) {

                        // exibimos o botão para criar o responsável
                        boxBtnNewParent.className = 'd-block';

                        Toastify({
                            text: "Responsável não encontrado",
                            duration: 10000,
                            close: true,
                            gravity: "top",
                            position: "left",
                        }).showToast();

                        return;

                    }

                    const parentCode = data.parent.code;

                    window.location.href = '<?php echo route_to('students.new'); ?>?parent_code=' + parentCode;
                })
                .catch(error => {
                    console.error('Erro ao enviar requisição:', error);

                    Toastify({
                        text: "Erro ao buscar responsável",
                        duration: 10000, // um pouco maior a duração
                        close: true,
                        gravity: "bottom",
                        position: "right",
                        backgroundColor: "#dc3545",
                    }).showToast();
                });
        });
    });
</script>


<script src="<?= base_url('assets/'); ?>jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.24.1/dist/bootstrap-table.min.js"></script>

<script>
    $('#table').bootstrapTable({
        search: true,
        pagination: true,
        pageSize: 10,
        paginationHAlign: 'left',
        paginationParts: ['pageList'],
        columns: [{
                field: 'actions',
                title: 'Ações',
                sortable: false,
            },
            {
                field: 'name',
                title: 'Nome',
                sortable: true,
            },
            {
                field: 'email',
                title: 'Email',
                sortable: true,
            },
            {
                field: 'cpf',
                title: 'CPF',
                sortable: true,
            },
            {
                field: 'phone',
                title: 'Celular',
                sortable: true,
            },
        ],


    });
</script>

<?= $this->endSection() ?>