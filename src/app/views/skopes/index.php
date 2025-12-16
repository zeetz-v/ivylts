<?php
$this->layout("templates/base", [
    "webTitle" => "Scopify",
    "cardTitle" => "Scopify",
    "styles" => [],
    "js" => [],
]);
?>

<style>
    .container {
        max-width: 72%;
    }

    .status {
        display: flex;
        align-items: center;
        gap: 6px;
        font-family: sans-serif;
    }

    /* PONTO BASE */
    .dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        position: relative;
        margin-right: 8px;
    }

    /* ========== PULSE ========== */
    .dot.aguardando {
        background-color: #5849e2ff;
        /* Verde */
    }

    .dot.aguardando::before,
    .dot.aguardando::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: #2308d1ff;
        opacity: 0.6;
        animation: pulse 2s infinite ease-out;
    }

    .dot.aguardando::after {
        animation-delay: .6s;
    }

    /* Animação do pulso */
    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 0.6;
        }

        70% {
            transform: scale(3);
            opacity: 0;
        }

        100% {
            transform: scale(3);
            opacity: 0;
        }
    }

    .dot.estimado {
        background-color: #2E8B57;
    }

    .container-table {
        max-height: 300px !important;
        overflow-x: scroll;
        overflow-x: hidden;
    }



    .container-table {
        --sb-track-color: #8e8e8e;
        --sb-thumb-color: #e0e0e0;
        --sb-size: 5px;
    }

    .container-table::-webkit-scrollbar {
        width: var(--sb-size)
    }

    .container-table::-webkit-scrollbar-track {
        background: var(--sb-track-color);
        border-radius: 3px;
    }

    .container-table::-webkit-scrollbar-thumb {
        background: var(--sb-thumb-color);
        border-radius: 3px;

    }

    #session {
        display: flex;
        align-items: center;
        justify-content: center;
        max-height: 300px;
        overflow: hidden;
    }

    #session img {
        height: 300px;
    }
</style>




<div class="container-table">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Status</th>
                <th>Title</th>
                <th>Analyst</th>
                <th>Developer</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($skopes as $skope_idx => $skope) { ?>
                <?php $estimated = mb_strtolower($skope["status"]) === "estimado"; ?>
                <tr>
                    <td><span><a href="#" class="t-gray">#SR<?= $skope["id"] ?></a></span></td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="status">
                                <div class="dot <?= $estimated ? 'estimado' : 'aguardando' ?>"></div>
                                <span><?= $estimated ? 'estimado' : 'aguardando' ?></span>
                            </div>
                        </div>
                    </td>
                    <td><?= $skope["title"] ?></td>
                    <td><?= $skope["analyst"] ?></td>
                    <td><?= $skope["developer"] ?></td>
                    <td>
                        <a href="#" class="btn btn-company">Start Session <i class="ph ph-arrow-right"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<hr>


<div id="session">
    <img src="<?= path()->images("404.svg") ?>" alt="404 not found">
</div>