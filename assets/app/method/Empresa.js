import Global from "../global.js"


/***
 * Ação responsável por receber os dados do formulário
 * e enviar os dados para API
 */
$("#adicionarEmpresa").on("submit", function(){

    // Não carrega
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o Botão
    $("#adicionarEmpresa").addClass("bloqueiaForm")

    // url
    var url = Global.config.urlApi + 'cliente/insert';

    // Faz o login
    Global.enviaApi("POST", url, form)
        .then(function (data){

            if(data.tipo == true)
            {
                // Avisa que deu certo
                Global.setSuccess(data.mensagem);

                // Libera o formulário
                setTimeout(() => {
                    $(this).removeClass("bloqueiaForm");
                    window.location.href = Global.config.url+'empresas';
                },3000);

            }


        })
        .catch(() =>{
            // Libera o formulário
            setTimeout(() => {
                $(this).removeClass("bloqueiaForm");
            },1000);
        });


});



/***
 * Ação responsável por receber os dados do formulário
 * e enviar os dados para API
 */
$("#editarEmpresa").on("submit", function(){

    // Não carrega
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o Botão
    $("#editarEmpresa").addClass("bloqueiaForm")

    //Pergando o id do usuario
    var id = form.get('id_cliente');

    // url
    var url = Global.config.urlApi + 'cliente/update/'+id;

    // Faz o login
    Global.enviaApi("POST", url, form)
        .then(function (data){

            if(data.tipo == true)
            {
                // Avisa que deu certo
                Global.setSuccess(data.mensagem);

                // Libera o formulário
                setTimeout(() => {
                    $(this).removeClass("bloqueiaForm");
                    window.location.href = Global.config.url+'empresas';
                },3000);

            }


        })
        .catch(() =>{
            // Libera o formulário
            setTimeout(() => {
                $(this).removeClass("bloqueiaForm");
            },1000);
        });


});



/***
 * Ação responsável por receber o id do usuario
 * e enviar para API
 */
$(".apagarEmpresa").on("click", function(){

    // Não carrega
    event.preventDefault();

    // Recupera os dados do formulário
    var id = $(this).attr("data-id");


    Swal.fire({
        title: 'Excluir Empresa',
        text: "Deseja realmente excluir a empresa?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {

            // url
            var url = Global.config.urlApi + 'cliente/delete/'+id;

            // Exclui o usuário
            Global.enviaApi("POST", url, null)
                .then(function (data){

                    $("#empresa-"+id).css("display","none");

                    Swal.fire(
                        'Excluido!',
                        'Empresa excluido com sucesso.',
                        'success'
                    )
                })
                .catch(() =>{
                    Swal.fire(
                        'Erro!',
                        'Erro ao excluir empresa.',
                        'error'
                    )
                });
        }
    })

});


// Retorno para os demais arquivos
export default (() => {

    return null;

})();