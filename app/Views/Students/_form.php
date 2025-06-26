<div class="row">
    <h6>Dados pessoais</h6>
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

<div class="row">
    <h6>Dados de endereço</h6>

    <div class="col-md-2">
        <div class="form-floating mb-3">
            <input type="text"
                class="form-control cep"
                name="postalcode"
                id="postalcode"
                placeholder="CEP válido"
                value="<?= old('postalcode', $student->address->postalcode) ?>">
            <label for="postalcode">CEP válido</label>
            <?= display_error('postalcode', $errors) ?>
        </div>
    </div>

    <div class="col-md-8">
        <div class="form-floating mb-3">
            <input type="text"
                class="form-control"
                name="street"
                id="street"
                placeholder="Rua"
                value="<?= old('street', $student->address->street) ?>">
            <label for="street">Rua</label>
            <?= display_error('street', $errors) ?>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-floating mb-3">
            <input type="text"
                class="form-control cep"
                name="number"
                id="number"
                placeholder="Número"
                value="<?= old('number', $student->address->number) ?>">
            <label for="number">Número</label>
        </div>
    </div>

    <div class="col-md">
        <div class="form-floating mb-3">
            <input type="text"
                class="form-control"
                name="city"
                id="city"
                placeholder="Cidade"
                value="<?= old('city', $student->address->city) ?>">
            <label for="city">Cidade</label>
            <?= display_error('city', $errors) ?>
        </div>
    </div>

    <div class="col-md">
        <div class="form-floating mb-3">
            <input type="text"
                class="form-control"
                name="district"
                id="district"
                placeholder="Bairro"
                value="<?= old('district', $student->address->district) ?>">
            <label for="district">Bairro</label>
            <?= display_error('district', $errors) ?>
        </div>
    </div>

    <div class="col-md">
        <div class="form-floating mb-3">
            <input type="text"
                class="form-control uf"
                name="state"
                id="state"
                placeholder="Estado"
                value="<?= old('state', $student->address->state) ?>">
            <label for="state">Estado</label>
            <?= display_error('state', $errors) ?>
        </div>
    </div>



</div>

<div class="row mt-3">
    <div class="col-md-12">
        <button type="submit" class="btn bg-gradient-success"><i class="fa-solid fa-floppy-disk fa-2x me-2"></i>Salvar</button>
    </div>
</div>

<?= $this->section('js'); ?>

<script src="<?= base_url('assets/'); ?>jquery/jquery.min.js"></script>

<script src="<?= base_url('assets/mask/jquery.mask.min.js'); ?>"></script>
<script src="<?= base_url('assets/mask/app.js'); ?>"></script>

<script>
    document.getElementById('postalcode').addEventListener('change', function() {

        const postalcode = this.value;

        if (postalcode.length === 9) {

            fetch(`https://viacep.com.br/ws/${postalcode}/json/`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('street').value = data.logradouro ?? '';
                    document.getElementById('city').value = data.localidade ?? '';
                    document.getElementById('district').value = data.bairro ?? '';
                    document.getElementById('state').value = data.uf ?? '';
                })
                .catch(error => {
                    console.log(`Erro ao consultar o CEP: ${error}`);
                });
        }

    });
</script>

<?= $this->endSection() ?>