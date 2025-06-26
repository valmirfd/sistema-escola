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
                    <a class="btn btn-sm me-2" href="<?= route_to('parents.web'); ?>">
                        <i class="fas fa-arrow-left text-primary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Voltar"></i>
                    </a>

                    <?= form_open(
                        action: route_to('parents.destroy', Encrypt($parent->id)),
                        attributes: ['class' => 'form-floating d-inline', 'onsubmit' => 'return confirm("Deseja proceguir?")'],
                        hidden: ['_method' => 'DELETE']
                    ); ?>

                    <button class="btn btn-sm float-end" type="submit"><i class="fas fa-trash text-danger text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Excluir"></i></button>

                    <?= form_close(); ?>

                    <a class="btn btn-sm  me-2 float-end" href="<?= route_to('parents.edit', Encrypt($parent->id)); ?>">
                        <i class="fas fa-user-edit text-info text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body p-3">

            <hr class="horizontal gray-light my-4">
            <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nome completo:</strong> &nbsp; <?= $parent->name; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Celular:</strong> &nbsp; <?= $parent->phone; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?= $parent->email; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">CPF:</strong> &nbsp; <?= $parent->cpf; ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Desde:</strong> &nbsp; <?= $parent->created_at->humanize(); ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Atualizado:</strong> &nbsp; <?= $parent->updated_at->humanize(); ?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Endereço:</strong> &nbsp; <?= $parent->address->getFullAddress(); ?></li>
              
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js'); ?>

<?= $this->endSection() ?>