const inputMatricula = document.getElementById("inputMatricula");

inputMatricula.addEventListener("blur", async () => {
  const matricula = inputMatricula.value;
  const response = await fetch(
    route(`dispositivos/usuarios/consulta?matricula=${matricula}`)
  );
  const data = await response.json();


  //bad scene
  if (response.status !== 200) {
    console.error("Erro na requisição:", error);

    document.getElementById("inputNome").value = "";
    document.getElementById("inputNome").value = "";
    document.getElementById("inputArea").value = "";
    document.getElementById("inputEmail").value = "";

    notificationsToast(
      "error",
      "Erro de rede ou servidor ao consultar o usuário."
    );
    return;
  }

  //good scene
  const funcionarioData = data.data;
  if (!funcionarioData) {
    document.getElementById("inputMatricula").value = "";
    document.getElementById("inputNome").value = "";
    document.getElementById("inputArea").value = "";
    document.getElementById("inputEmail").value = "";
    notificationsToast("warning", "Usuário não encontrado.");
  }

  document.getElementById("inputNome").value = funcionarioData.nome;
  document.getElementById("inputArea").value = funcionarioData.area;
  document.getElementById("inputEmail").value = funcionarioData.email;
  notificationsToast("success", "Usuário encontrado!");
});
