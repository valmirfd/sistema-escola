                <div class="row">
                    <h6>Dados pessoais</h6>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control"
                                name="name"
                                id="nome"
                                placeholder="Nome completo"
                                value="<?= old('name', $parent->name) ?>">
                            <label for="name">Nome competo</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="email"
                                class="form-control"
                                name="email"
                                id="email"
                                placeholder="Email válido"
                                value="<?= old('email', $parent->email) ?>">
                            <label for="email">Email válido</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="tel"
                                class="form-control phone"
                                name="phone"
                                id="phone"
                                placeholder="Celular"
                                value="<?= old('phone', $parent->phone) ?>">
                            <label for="phone">Celular</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control cpf"
                                name="cpf"
                                id="cpf"
                                placeholder="CPF"
                                value="<?= old('cpf', $parent->cpf) ?>">
                            <label for="phone">CPF válido</label>
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
                                value="<?= old('postalcode', $parent->address->postalcode) ?>">
                            <label for="postalcode">CEP válido</label>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control"
                                name="street"
                                id="street"
                                placeholder="Rua"
                                value="<?= old('street', $parent->address->street) ?>">
                            <label for="street">Rua</label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control cep"
                                name="number"
                                id="number"
                                placeholder="Número"
                                value="<?= old('number', $parent->address->number) ?>">
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
                                value="<?= old('city', $parent->address->city) ?>">
                            <label for="city">Cidade</label>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control"
                                name="district"
                                id="district"
                                placeholder="Bairro"
                                value="<?= old('district', $parent->address->district) ?>">
                            <label for="district">Bairro</label>
                        </div>
                    </div>

                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control uf"
                                name="state"
                                id="state"
                                placeholder="Estado"
                                value="<?= old('state', $parent->address->state) ?>">
                            <label for="state">Estado</label>
                        </div>
                    </div>



                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn bg-gradient-success"><i class="fa-solid fa-floppy-disk fa-2x me-2"></i>Salvar</button>
                    </div>
                </div>