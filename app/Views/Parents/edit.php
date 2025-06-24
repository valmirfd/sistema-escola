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
                <a class="btn btn-sm mb-2" href="<?= route_to('parents.web'); ?>">
                    <i class="fa-solid fa-arrow-left text-primary me-2" style="font-size: 16px;"></i>
                </a>
            </div>
            <div class="card-body">
                <?= form_open(
                    action: route_to('parents.update', Encrypt($parent->id)),
                    attributes: ['class' => 'form-floating'],
                    hidden: ['_method' => 'PUT']
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