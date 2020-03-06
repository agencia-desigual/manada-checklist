import Global from "../global.js"


/***
 * Ação responsável por receber os dados do formulário
 * e enviar os dados para API
 */
$("#adicionarFuncionario").on("submit", function(){

    // Não carrega
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o Botão
    $("#adicionarFuncionario").addClass("bloqueiaForm")

    // url
    var url = Global.config.urlApi + 'funcionario/insert';

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
                    window.location.href = Global.config.url+'funcionarios';
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
$("#editarFuncionario").on("submit", function(){

    // Não carrega
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o Botão
    $("#editarFuncionario").addClass("bloqueiaForm")

    //Pergando o id do usuario
    var id = form.get('id_funcionario');

    // url
    var url = Global.config.urlApi + 'funcionario/update/'+id;

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
                    window.location.href = Global.config.url+'funcionarios';
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
$(".apagarFuncionario").on("click", function(){

    // Não carrega
    event.preventDefault();

    // Recupera os dados do formulário
    var id = $(this).attr("data-id");


    Swal.fire({
        title: 'Excluir Funcionário',
        text: "Deseja realmente excluir o funcionário?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {

            // url
            var url = Global.config.urlApi + 'funcionario/delete/'+id;

            // Exclui o usuário
            Global.enviaApi("POST", url, null)
                .then(function (data){

                    $("#funcionario-"+id).css("display","none");

                    Swal.fire(
                        'Excluido!',
                        'Funcionário excluido com sucesso.',
                        'success'
                    )
                })
                .catch(() =>{
                    Swal.fire(
                        'Erro!',
                        'Erro ao excluir funcionário.',
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