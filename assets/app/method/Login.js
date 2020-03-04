import Global from "../global.js"


/***
 * Ação responsável por receber os dados do formulário
 * e realizar o login do usuário.
 */
$("#formLogin").on("submit", function(){

    // Não carrega
    event.preventDefault();

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Bloqueia o Botão
    $("#formLogin").addClass("bloqueiaForm")

    // url
    var url = Global.config.urlApi + 'usuario/login';

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
                window.location.href = Global.config.url;
            },1000);


        }

    })
        .catch(() =>{
            // Libera o formulário
            setTimeout(() => {
                $(this).removeClass("bloqueiaForm");
            },1000);
        });


});


// Retorno para os demais arquivos
export default (() => {

    return null;

})();