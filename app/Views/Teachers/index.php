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
                <a class="btn bg-gradient-dark btn-sm mb-0 float-start" href="<?= route_to('teachers.new'); ?>">
                    <i class="fa-solid fa-user-plus me-2" style="font-size: 16px;"></i>Cadastrar
                </a>
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

                            <?php foreach ($teachers as $teacher): ?>
                                <tr>
                                    <td class="align-middle pb-0">
                                        <a class="btn bg-gradient-info btn-sm" href="<?= route_to('teachers.show', Encrypt($teacher->id)); ?>">
                                            <i class="fa-solid fa-eye me-2" style="font-size: 16px;"></i>Detalhes
                                        </a>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-start justify-content-start">
                                            <div>
                                                <h6 class="mb-0 text-sm"><?= $teacher->name; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-start justify-content-start">
                                            <div>
                                                <h6 class="mb-0 text-sm"><?= $teacher->email; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-start justify-content-start">
                                            <div>
                                                <h6 class="mb-0 text-sm"><?= $teacher->cpf; ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-start justify-content-start">
                                            <div>
                                                <h6 class="mb-0 text-sm"><?= $teacher->phone; ?></h6>
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