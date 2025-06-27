<?= $this->extend('Layouts/main'); ?>

<?= $this->section('title') ?>
<?php echo $title ?? ''; ?>
<?php echo $this->endSection() ?>

<?= $this->section('css'); ?>


<?= $this->endSection() ?>

<?= $this->section('content') ?>


<div class="col-8">
    <div class="card h-100">
        <div class="card-header pb-0 p-3">
            <div class="row">
                <div class="col-md-12 text-start">
                    <a class="btn btn-sm me-2" href="<?= route_to('students.web'); ?>">
                        <i class="fas fa-arrow-left text-primary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Voltar"></i>
                    </a>

                    <?= form_open(
                        action: route_to('students.destroy', Encrypt($student->id)),
                        attributes: ['class' => 'form-floating d-inline', 'onsubmit' => 'return confirm("Deseja proceguir?")'],
                        hidden: ['_method' => 'DELETE']
                    ); ?>

                    <button class="btn btn-sm float-end" type="submit"><i class="fas fa-trash text-danger text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir"></i></button>

                    <?= form_close(); ?>

                    <a class="btn btn-sm  me-2 float-end" href="<?= route_to('students.edit', Encrypt($student->id)); ?>">
                        <i class="fas fa-user-edit text-info text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body p-3">

            <hr class="horizontal gray-light my-4">
            <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nome completo:</strong> &nbsp; <?= $student->name; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Celular:</strong> &nbsp; <?= $student->phone; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?= $student->email; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">CPF:</strong> &nbsp; <?= $student->cpf; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Desde:</strong> &nbsp; <?= $student->created_at->humanize(); ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Atualizado:</strong> &nbsp; <?= $student->updated_at->humanize(); ?></li>

            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js'); ?>

<?= $this->endSection() ?>