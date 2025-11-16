<div id="side-to-edit" class="sidebar">
    <div id="edit-form">

        <div class="d-flex flex-column gap-3 mt-4 align-items-center">

            <h4 class="mb-0">Você está prestes a deletar o usuário <strong><?= $usuario->matricula?></strong> </h4>
            <h4 class="mb-0">Você tem certeza? </h4>

            <div class="d-flex gap-2">
                <a href="<?= route('parametrizacao.usuario.delete', ['id' => $usuario->id]) ?>" class="btn btn-danger">
                    Confirmar
                </a>

                <button type="button" class="btn btn-secondary" onclick="closeSidebar()">
                    Cancelar
                </button>
            </div>

        </div>

    </div>
</div>