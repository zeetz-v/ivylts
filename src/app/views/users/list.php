<?php
$this->layout("templates/base", [
    "webTitle" => "Usuários",
    "cardTitle" => "Controle de usuários",
    "styles" => [
        'https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css'
    ],
    "js" => [
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


<form method="POST" action="<?= route('users.store'); ?>" id="form-create">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="id" class="form-label fw-bold">Id <span class="text-danger"></span></label>
            <input type="text" class="form-control form-control-sm" id="id" placeholder="Gerado automaticamente">
        </div>
        <div class="col-md-4">
            <label for="name" class="form-label fw-bold">Nome <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm <?= isWrong('name') ? 'is-invalid' : '' ?>" id="name"
                name="name" value="<?= old('name') ?>" required>
            <small class="text-muted"><?= isWrongText('name') ?></small>
        </div>
        <div class="col-md-4">
            <label for="email" class="form-label fw-bold">E-mail <span class="text-danger">*</span></label>
            <input type="email" class="form-control form-control-sm <?= isWrong('email') ? 'is-invalid' : '' ?>"
                id="email" name="email" value="<?= old('email') ?>" required>
            <small class="text-muted"><?= isWrongText('email') ?></small>
        </div>
    </div>


    <div class="buttonsDiv">
        <button type="submit" class="btn btn-company" onclick="loading('show', true);">Salvar <i
                class="ph ph-floppy-disk"></i></button>
        <a class="btn btn-secondary" id="cancelForm">Cancelar</a>
    </div>
</form>
<hr>

<table id="list">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Nome</th>
            <th class="text-center">E-mail</th>
            <th class="text-center">Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php if (isset($users) && count($users) > 0) { ?>
            <?php foreach ($users as $user_key => $u) { ?>
                <tr>
                    <td class="text-center <?= $u->deleted_at ? 'text-decoration-line-through' : '' ?>">
                        <?= $u->id ?>
                    </td>
                    <td class="text-center <?= $u->deleted_at ? 'text-decoration-line-through' : '' ?>">
                        <?= $u->name ?>
                    </td>
                    <td class="text-center <?= $u->deleted_at ? 'text-decoration-line-through' : '' ?>"><?= $u->email ?></td>
                    <td>
                        <button class="btn btn-sm btn-danger" onclick="dialog_red_show(this);" popovertarget="dialog-red"
                            data-dc-title="Exclusão de usuário"
                            data-dc-description="Essa ação é irreversível. Os posts e demais informações relacionadas ao usuário sumirão. Tem certeza que deseja continuar?"
                            data-dc-href="<?= route("users.delete", ["uuid" => $u->uuid]) ?>" data-dc-href-title="Excluir"><i
                                class="ph ph-trash"></i></button>
                        <a class="btn btn-sm btn-primary" href="<?= route('users.edit', ['uuid' => $u->uuid]) ?>"
                            onclick="loading('show', true);"><i class="ph ph-pencil"></i></a>
                        <?php $enableOrDisable = $u->deleted_at ? 'Habilitar' : 'Desabilitar' ?>
                        <button class="btn btn-sm btn-company" onclick="dialog_green_show(this);" popovertarget="dialog-green"
                            data-dc-title="Mudança de status"
                            data-dc-description="<p class='mb-0'>Realmente deseja <b><?= $enableOrDisable ?></b>  usuário?</p> <p>Essa ação pode ser revertida posteriormente.</p>"
                            data-dc-href="<?= route("users.status.change", ["uuid" => $u->uuid], ["status" => $u->deleted_at ? 'habilitar' : 'desabilitar']) ?>"
                            data-dc-href-title="Atualizar"><i class="ph ph-arrow-clockwise"></i></button>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>

</table>


<dialog id="dialog-red" popover>
    <h3 id="dc-title"></h3>
    <p id="dc-description"></p>
    <a class="btn btn-sm btn-danger" id="dc-href">Delete</a>
    <button class="btn btn-sm btn-secondary" popovertarget="dialog-red" popovertargetaction="hide">Cancelar</button>
</dialog>


<dialog id="dialog-green" popover>
    <h3 id="dc-title"></h3>
    <p id="dc-description"></p>
    <a class="btn btn-sm btn-success" id="dc-href">Delete</a>
    <button class="btn btn-sm btn-secondary" popovertarget="dialog-green" popovertargetaction="hide">Cancelar</button>
</dialog>


<script>
    function dialog_red_show(trigger_button) {
        dialog_show(trigger_button, 'dialog-red')
    }

    function dialog_green_show(trigger_button) {
        dialog_show(trigger_button, 'dialog-green')
    }


    function dialog_show(trigger_button, dialog) {
        const dialog_red = document.getElementById(dialog);
        const dialog_title = dialog_red.querySelector('#dc-title');
        const dialog_description = dialog_red.querySelector('#dc-description');
        const dialog_href = dialog_red.querySelector('#dc-href');

        if (!dialog_title
            || !dialog_description
            || !dialog_href
        )
            return;

        dialog_title.innerHTML = trigger_button.dataset.dcTitle;
        dialog_description.innerHTML = trigger_button.dataset.dcDescription;
        dialog_href.href = trigger_button.dataset.dcHref;
        dialog_href.innerHTML = trigger_button.dataset.dcHrefTitle;
    }
</script>