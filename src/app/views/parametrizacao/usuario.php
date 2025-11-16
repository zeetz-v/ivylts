<?php
$this->layout("templates/base", [
  "webTitle" => "Dispositivos - Cadastro de usuário",
  "cardTitle" => "Cadastro de usuário",
  "styles"    => [
        'https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css'
    ],
  "js" => [
    path()->js("usuario.js"),
    path()->js("controle.js"),
  ],
]);
?>

<style>
.dt-search {
    input {
        text-align: center;
        margin-bottom: 12px;
    }
}
</style>


<form method="POST" action="<?= route('parametrizacao.usuario.store') ?>" id="formCadastroUsuario">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="inputMatricula" class="form-label">Matrícula <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm" id="inputMatricula" name="matricula" required>
        </div>
        <div class="col-md-4">
            <label for="inputNome" class="form-label">Nome <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm" id="inputNome" name="nome" required readOnly>
        </div>
        <div class="col-md-4">
            <label for="inputArea" class="form-label">Área</label>
            <input type="text" class="form-control form-control-sm" id="inputArea" name="area" readOnly>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="inputEmail" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control form-control-sm" id="inputEmail" name="email" required readOnly>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="selectPerfil" class="form-label">Perfil <span class="text-danger">*</span></label>
            <select class="form-select form-select-sm" id="selectPerfil" name="role" required>
                <option selected disabled value="">Selecione...</option>
                <option value="COMUM">Comum</option>
                <option value="LIDER DE PROJETO">Líder de Projeto</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="inputSenha" class="form-label">Senha <span class="text-danger">*</span></label>
            <input type="password" class="form-control form-control-sm" id="inputSenha" name="senha" required>
        </div>
        <div class="col-md-4">
            <label for="selectStatus" class="form-label">Status <span class="text-danger">*</span></label>
            <select class="form-select form-select-sm" id="selectStatus" name="status" required>
                <option selected value="ATIVO">Ativo</option>
                <option value="INATIVO">Inativo</option>
            </select>
        </div>
    </div>


    <div class="buttonsDiv">
        <button type="submit" class="btn btn-company">Registrar</button>
        <a class="btn btn-secondary" id="cancelForm">Cancelar</a>
    </div>
</form>
<hr>

<table id="list">
    <thead>
        <tr>
            <th class="text-center">Matricula</th>
            <th class="text-center">Nome</th>
            <th class="text-center">Área</th>
            <th class="text-center">Perfil</th>
            <th class="text-center">Status</th>
            <th class="text-center">Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php if (is_array($usuarios) || is_object($usuarios)): ?>
        <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td class="text-center"><?= $usuario->matricula ?></td>
            <td class="text-center"><?= $usuario->nome ?></td>
            <td class="text-center"><?= $usuario->area ?></td>
            <td class="text-center"><?= $usuario->role ?></td>
            <td class="text-center"><?= $usuario->status ?></td>
            <td>
                <a onclick="openModal('<?= $usuario->id ?>', 'delete')" class="btn btn-sm btn-danger"><i class="ph ph-trash"></i></a>
                <a  onclick="openModal('<?= $usuario->id ?>', 'edit')" class="btn btn-sm btn-primary"><i class="ph ph-pencil"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php else: ?>
        <tr>
            <td colspan="5" class="text-center">Nenhum usuário encontrado.</td>
        </tr>
        <?php endif; ?>
    </tbody>

</table>
<div id="edit-form" class="sidebar-content"></div>
<?= $this->insert('parametrizacao/dt'); ?>