import Global from "../global.js"


/***
 * Ação responsável por receber os dados do formulário
 * e enviar os dados para API
 */
$("#adicionarEquipamento").on("submit", function(){

    // Não carrega
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o Botão
    $("#adicionarEquipamento").addClass("bloqueiaForm")

    // url
    var url = Global.config.urlApi + 'equipamento/insert';

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
                    window.location.href = Global.config.url+'equipamentos';
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
$("#editarEquipamento").on("submit", function(){

    // Não carrega
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o Botão
    $("#editarEquipamento").addClass("bloqueiaForm")

    //Pergando o id do usuario
    var id = form.get('id_equipamento');

    // url
    var url = Global.config.urlApi + 'equipamento/update/'+id;

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
                    window.location.href = Global.config.url+'equipamento/editar/'+id;
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
$(".apagarEquipamento").on("click", function(){

    // Não carrega
    event.preventDefault();

    // Recupera os dados do formulário
    var id = $(this).attr("data-id");


    Swal.fire({
        title: 'Excluir Equipamento',
        text: "Deseja realmente excluir o equipamento?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {

            // url
            var url = Global.config.urlApi + 'equipamento/delete/'+id;

            // Exclui o usuário
            Global.enviaApi("POST", url, null)
                .then(function (data){

                    $("#equipamento-"+id).css("display","none");

                    Swal.fire(
                        'Excluido!',
                        'Equipamento excluido com sucesso.',
                        'success'
                    )
                })
                .catch(() =>{
                    Swal.fire(
                        'Erro!',
                        'Erro ao excluir equipamento.',
                        'error'
                    )
                });
        }
    })

});



$(".novaCategoria").on("click", function(){

    // Não carrega
    event.preventDefault();

    $("#selecionarCategoria").css("display","none");
    $("#novaCategoria").css("display","block");
    $("#id_categoria").val("");
    $(".nomeCategoria").val("");


});



$(".selecioneCategoria").on("click", function(){

    // Não carrega
    event.preventDefault();

    $("#selecionarCategoria").css("display","block");
    $("#novaCategoria").css("display","none");
    $(".nomeCategoria").val("");


});



// Retorno para os demais arquivos
export default (() => {

    return null;

})();