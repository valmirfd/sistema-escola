<div class="row">
    <h6>Dados pessoais</h6>

    <?= form_hidden('parent_code', $student->parent->code); ?>

    <div class="col-md-12">
        <div class="form-floating mb-3">
            <input type="text"
                class="form-control"
                value="<?= $student->parent->name; ?> - CPF: <?= $student->parent->cpf; ?>" disabled>
            <label for="name">Responsável</label>
            <?= display_error('name', $errors) ?>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="text"
                class="form-control"
                name="name"
                id="name"
                placeholder="Nome completo"
                value="<?= old('name', $student->name) ?>">
            <label for="name">Nome competo</label>
            <?= display_error('name', $errors) ?>
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="email"
                class="form-control"
                name="email"
                id="email"
                placeholder="Email válido"
                value="<?= old('email', $student->email) ?>">
            <label for="email">Email válido</label>
            <?= display_error('email', $errors) ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="tel"
                class="form-control phone"
                name="phone"
                id="phone"
                placeholder="Celular"
                value="<?= old('phone', $student->phone) ?>">
            <label for="phone">Celular</label>
            <?= display_error('phone', $errors) ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="text"
                class="form-control cpf"
                name="cpf"
                id="cpf"
                placeholder="CPF"
                value="<?= old('cpf', $student->cpf) ?>">
            <label for="cpf">CPF válido</label>
            <?= display_error('cpf', $errors) ?>
        </div>
    </div>

</div>

<hr>



<div class="row mt-3">
    <div class="col-md-12">
        <button type="submit" class="btn bg-gradient-success"><i class="fa-solid fa-floppy-disk fa-2x me-2"></i>Salvar</button>
    </div>
</div>

<?= $this->section('js'); ?>

<script src="<?= base_url('assets/'); ?>jquery/jquery.min.js"></script>

<script src="<?= base_url('assets/mask/jquery.mask.min.js'); ?>"></script>
<script src="<?= base_url('assets/mask/app.js'); ?>"></script>



<?= $this->endSection() ?>