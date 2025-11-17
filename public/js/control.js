

/**
 * Carrega o formulário de edição pelo UUID e abre a sidebar.
 *
 * @function openSidebar
 * @example
 * <!-- HTML -->
 * <button onclick="openSidebar('uuid')">
 *
 * @async
 * @param {string} uuid - Identificador único do item.
 * @returns {void}
 */
async function openModal(uuid, action) {
  let response;

  if (action == 'delete') {
    response = await fetch(route(`dispositivos/usuarios/modalConfirm/${uuid}`));
  } else {
    response = await fetch(route(`dispositivos/usuarios/modalEdit/${uuid}`));
  }

  if (!response.ok) {
    notificationsToast("error", "Menu not found");
    return;
  }

  let data = await response.text();

  document.getElementById("edit-form").innerHTML = data;
  document.getElementById("side-to-edit").classList.add("open");
}

/**
 * Fecha a sidebar de edição.
 *
 * @returns {void}
 */
function closeSidebar() {
  document.getElementById("side-to-edit").classList.remove("open");
}

/**
 * Verifica se há parâmetro de exibição na URL e aciona o gatilho correspondente.
 *
 * @returns {void}
 */
function isShowing() {
  if (getQuery().with)
    document.getElementById(`trigger-${getQuery().with}`).click();
}

isShowing();

function confirmDelete() {
  let btnWarning = document.getElementById("btnConfirm");
  let btnDelete = document.getElementById("btnDelete");
  if (btnWarning) btnWarning.classList.remove("d-none");
  if (btnDelete) btnDelete.classList.add("d-none");
}

window.onload = function (e) {
  let loadingWrapper = document.getElementById("loading-wrapper");
  if (loadingWrapper) loadingWrapper.style.display = "none";

  console.log(loadingWrapper);
};

async function initTable() {
  let translate = await fetch(
    'http://localhost:8080/public/js/dt/ptbr.json'
  );
  translate = await translate.json();
  let table = new DataTable("#list", {
    pageLength: 12,
    lengthChange: false,
    pagingType: "simple_numbers",
    info: false,
    language: translate,
  });

  document.getElementById("btnActives").addEventListener("click", function () {
    table.column(6).search("^active$", true, false).draw();
  });

  // botão - todos
  document.getElementById("btnAll").addEventListener("click", function () {
    table.column(6).search("").draw();
  });
}

initTable();
