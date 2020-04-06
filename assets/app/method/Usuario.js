import Global from "../global.js"


/***
 * Ação responsável por receber os dados do formulário
 * e enviar os dados para API
 */
$("#adicionarUsuario").on("submit", function(){

    // Não carrega
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o Botão
    $("#adicionarUsuario").addClass("bloqueiaForm")

    // url
    var url = Global.config.urlApi + 'usuario/insert';

    // Faz o login
    Global.enviaApi("POST", url, form)
        .then(function (data){

            if(data.tipo == true)
            {
                // Avisa que deu certo
                // Global.setSuccess(data.mensagem);

                // Libera o formulário
                setTimeout(() => {
                    $(this).removeClass("bloqueiaForm");
                    window.location.href = Global.config.url+'usuarios';
                },2000);

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
$("#editarUsuario").on("submit", function(){

    // Não carrega
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o Botão
    $("#editarUsuario").addClass("bloqueiaForm")

    //Pergando o id do usuario
    var id = form.get('id_usuario');

    // url
    var url = Global.config.urlApi + 'usuario/update/'+id;

    // Faz o login
    Global.enviaApi("POST", url, form)
        .then(function (data){

            if(data.tipo == true)
            {
                // Avisa que deu certo
                // Global.setSuccess(data.mensagem);

                // Libera o formulário
                setTimeout(() => {
                    $(this).removeClass("bloqueiaForm");
                    window.location.href = Global.config.url+'usuario/editar/'+id;
                },2000);

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
$(".apagarUsuario").on("click", function(){

    // Não carrega
    event.preventDefault();

    // Recupera os dados do formulário
    var id = $(this).attr("data-id");


    Swal.fire({
        title: 'Excluir Usuário',
        text: "Deseja realmente excluir o usuário?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {

            // url
            var url = Global.config.urlApi + 'usuario/delete/'+id;

            // Exclui o usuário
            Global.enviaApi("POST", url, null)
                .then(function (data){

                    $("#usuario-"+id).css("display","none");

                    Swal.fire(
                        'Excluido!',
                        'Usuário excluido com sucesso.',
                        'success'
                    )
                })
                .catch(() =>{
                    Swal.fire(
                        'Erro!',
                        'Erro ao excluir usuário.',
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