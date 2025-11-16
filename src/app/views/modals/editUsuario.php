<div id="side-to-edit" class="sidebar">
    <div id="edit-form">
        <div class="d-flex align-itens-center">
            <form method="POST" action="<?= route('parametrizacao.usuario.update') ?>" id="formCadastroUsuario">
              <input type="hidden" class="form-control form-control-sm" id="inputId" name="id"
                            value="<?= $usuario->id ?>" readonly>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="inputMatricula" class="form-label">Matrícula <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="inputMatricula" name="matricula"
                            value="<?= $usuario->matricula ?>" readonly>
                    </div>
                    <div class="col-md-8">
                        <label for="inputNome" class="form-label">Nome <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="inputNome" name="nome"
                            value="<?= $usuario->nome ?>" readOnly>
                    </div>
                    <div class="col-md-8">
                        <label for="inputArea" class="form-label">Área</label>
                        <input type="text" class="form-control form-control-sm" id="inputArea" name="area"
                            value="<?= $usuario->area ?>" readOnly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="inputEmail" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control form-control-sm" id="inputEmail" name="email"
                            value="<?= $usuario->email ?>" readOnly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="selectPerfil" class="form-label">Perfil <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="selectPerfil" name="role" required>
                            <option value="">Selecione...</option>
                            <option value="COMUM" <?= isSelect($usuario->role, 'COMUM') ?>>Comum</option>
                            <option value="LIDER DE PROJETO" <?= isSelect($usuario->role, 'LIDER DE PROJETO') ?>>Líder
                                de Projeto</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="inputSenha" class="form-label">Senha <span class="text-danger">*</span></label>
                        <input type="password" class="form-control form-control-sm" id="inputSenha" name="senha"
                            required>
                    </div>
                    <div class="col-md-4">
                        <label for="selectStatus" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select form-select-sm" id="selectStatus" name="status" required>
                            <option selected value="ATIVO">Ativo</option>
                            <option value="INATIVO">Inativo</option>
                        </select>
                    </div>
                </div>


                <div class="buttonsDiv d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-company">Registrar</button>
                    <a class="btn btn-secondary" id="cancelForm" onclick="closeSidebar()">Cancelar</a>
                </div>
            </form>



        </div>
    </div>
</div>

<style>
#side-to-edit {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 40%;
    height: 50%;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    padding: 20px;
    transition: opacity 0.4s ease-in-out, visibility 0.4s ease-in-out;
    z-index: 9999;
    overflow-y: auto;

    opacity: 0;
    visibility: hidden;
        display: flex;
    align-items: center;
    justify-content: center;

}

#side-to-edit.open {
    opacity: 1;
    visibility: visible;
}
</style>