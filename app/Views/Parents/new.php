<?= $this->extend('Layouts/main'); ?>

<?= $this->section('title') ?>
<?php echo $title ?? ''; ?>
<?php echo $this->endSection() ?>

<?= $this->section('css'); ?>


<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <a class="btn bg-gradient-info btn-sm mb-2" href="<?= route_to('parents.web'); ?>">
                    <i class="fa-regular fa-circle-left me-2" style="font-size: 18px;"></i>Ver responsáveis
                </a>
            </div>
            <div class="card-body">

                <?= form_open(
                    action: route_to('parents.create'),
                    attributes: ['class' => 'form-floating']
                ); ?>

                <?= $this->include('Parents/_form'); ?>



                <?= form_close(); ?>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js'); ?>

<?= $this->endSection() ?>