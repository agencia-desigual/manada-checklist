import Global from "../global.js"


$("#adicionarProjeto").on("submit", function(){

    // Não carrega
    event.preventDefault();

    // Trava o formulário
    $(this).addClass("bloqueiaForm");

    // Recupera os dados do formulário
    var form = new FormData(this);

    // Url
    var url = Global.config.urlApi + "projeto/insert";

    // Envia
    Global.enviaApi("POST", url, form)
        .then((data) => {

            // Informa que deu cert
            // Global.setSuccess(data.mensagem);

            setTimeout(() => {
                // Redireciona
                location.href = Global.config.url + "projeto/imprimir/" + data.objeto;
            }, 2000);
        })
        .catch(() => {
            // Debloqueia o form
            $(this).removeClass("bloqueiaForm");
        });

    // Não carrega mesmo
    return false;
});


$(".apagarProjeto").on("click", function(){

    // Recupera o id
    var id = $(this).data("id");

    // Url
    var url = Global.config.urlApi + "projeto/delete/" + id;

    // Verifica se realmente deseja deletar
    Swal.fire({
        title: 'Deletar Projeto',
        text: 'Deseja realmente deletar o projeto?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, delete!'
    }).then((result) => {
        if (result.value)
        {
            // Realiza a solicitação
            Global.enviaApi("POST", url, null)
                .then((data) => {

                    // Avisa que deu certo
                    Global.setSuccess(data.mensagem);

                    // Remove o item da tabela
                    $('.js-exportable')
                        .DataTable()
                        .row("#projeto-" + id)
                        .remove()
                        .draw(false);

                });
        }
    });

    // Não carrega mesmo
    return false;

});


$("#alterarProjeto").on("submit", function(){

    // Não atualiza
    event.preventDefault();

    // Bloqueia o form
    $(this).addClass("bloqueiaForm");

    // Recupera os dados
    var form = new FormData(this);

    // Recupera o id
    var id = $(this).data("id");

    // monta a url
    var url = Global.config.urlApi + "projeto/update/" + id;

    // Altera
    Global.enviaApi("POST", url, form)
        .then((data) => {

            // Avisa que deu certo
            Global.setSuccess(data.mensagem);

            // Remove o bloqueio
            $(this).removeClass("bloqueiaForm");

            // Redireciona
            setTimeout(() => {
                location.href = Global.config.url + "projetos";
            }, 2000);

        })
        .catch(() => {

            // Remove o bloqueio
            $(this).removeClass("bloqueiaForm");
        });

    // Não atualiza mesmo
    return false;
});

$(".duplicarProjeto").on("click", function(){

    // Recupera o id
    var id = $(this).data("id");

    // Url
    var url = Global.config.urlApi + "projeto/duplicar/" + id;

    // Verifica se realmente deseja deletar
    Swal.fire({
        title: 'Duplicar Projeto',
        text: 'Deseja realmente duplicar esse projeto?',
        type: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, duplicar!'
    }).then((result) => {
        if (result.value)
        {
            // Realiza a solicitação
            Global.enviaApi("POST", url, null)
                .then((data) => {

                    // Avisa que deu certo
                    // Global.setSuccess(data.mensagem);

                    // Redireciona
                    setTimeout(() => {
                        location.href = Global.config.url + "projetos";
                    }, 1000);

                });
        }
    });

    // Não carrega mesmo
    return false;

});
