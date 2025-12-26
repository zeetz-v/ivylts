<?php
$this->layout("templates/base", [
    "webTitle" => "Scopify - Start Session",
    "cardTitle" => "Scopify - Start Session",
    "styles" => [
        path()->css("sessions/waiting.css"),
    ],
    "js" => [],
]);
?>


<!-- hidden info -->
<div class="hidden-info">
    <input type="text" id="skope_id" value="<?= $skope->id ?>">
    <input type="text" id="session_id" value="<?= $session->id ?>">
</div>


<!-- header/title -->
<div>
    <h1 class="">Waiting anothers participants</h1>

    <p class="session-project">
        <span class="name"><?= $skope->title; ?></span>
    </p>
</div>


<!-- status/contador -->
<div class="session-status">
    <div class="status-icon">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"
                fill="white"></path>
        </svg>
    </div>
    <div class="status-text" id="statusText">
        <span>Aguardando participantes...</span>
    </div>
</div>

<!-- lista de participantes -->
<div class="user-list">
</div>


<!-- loading -->
<div class="wait-loader mt-5">
    <p class="wait-heading">Loading</p>
    <div class="wait-loading">
        <div class="wait-load"></div>
        <div class="wait-load"></div>
        <div class="wait-load"></div>
        <div class="wait-load"></div>
    </div>
</div>



<!-- go to session (só é exibido para o host) -->
<?php if ($is_host) { ?>
    <div class="d-flex justify-content-center align-items-center flex-column mt-4">
        <small class="text-muted">Already? <a href="" class="">Go Now 🚀</a></small>
    </div>
<?php } ?>


<script>
    setInterval(async () => {
        await get_participants();
    }, 2000);



    async function get_participants() {
        const sessionId = document.getElementById('session_id').value;
        try {
            const endpoint = route(`session/${sessionId}/participants`);
            const response = await fetch(endpoint);
            const data = await response.json();
            await participants_quantities(data.participants.length);
            await users_fill(data.participants);
        } catch (error) {
            console.error('Error fetching participants:', error);
        }
    }

    async function users_fill(participants) {
        const userList = document.querySelector('.user-list');
        userList.innerHTML = '';
        participants.forEach(participant => {
            let content = `<div class="user-item selected">
                                    <img src="https://i.pravatar.cc/150?img=12" alt="Luiza Santos" class="user-avatar">
                                    <div class="user-info">
                                        <div class="user-name">${participant.user_name}</div>
                                        <div class="user-email">Entrou há ${getElapsedTime(participant.created_at)}</div>
                                    </div>
                                    <div class="user-action">
                                        <div class="check-icon">
                                            <i class="ph ph-check"></i>
                                        </div>
                                    </div>
                                </div>`;
            userList.innerHTML += content;
        });
    }

    async function participants_quantities(quantities) {
        const statusText = document.getElementById('statusText');
        statusText.innerHTML = quantities > 1 ?
            `<span>${quantities} participantes conectados</span>` :
            `<span>Aguardando participantes...</span>`;
    }

    function getElapsedTime(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diffMs = now - date;
        const diffSecs = Math.floor(diffMs / 1000);
        const diffMins = Math.floor(diffSecs / 60);
        const diffHours = Math.floor(diffMins / 60);
        const diffDays = Math.floor(diffHours / 24);

        if (diffSecs < 60) return `${diffSecs}s`;
        if (diffMins < 60) return `${diffMins}m`;
        if (diffHours < 24) return `${diffHours}h`;
        return `${diffDays}d`;
    }
</script>