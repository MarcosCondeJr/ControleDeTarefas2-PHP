const cadUsuarioForm = document.getElementById("cad-categoria-form");

if(cadUsuarioForm){
    cadUsuarioForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const dadosForm = new FormData(cad-categoria-form);

        const dados = await fetch("App/Controllers/CategoriaController.php", {
            method: "POST",
            body: dadosForm
        })

        const resposta = await dados.json();
    })

    if(resposta['status']){

    } else {
        Swal.fire({
            title: "Good job!",
            text: resposta["status"],
            icon: "success"
          });
    }
}