$(function () {

    //Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csv',
                text: 'Exportar CSV',
                charset: 'utf-8',
                extension: '.csv',
                fieldSeparator: ';',
                fieldBoundary: '',
                filename: 'export',
                bom: true
            },
            {
                extend: 'print',
                text: 'Imprimir',
            },
            {
                extend: 'copy',
                text: 'Copiar',
            }
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        }
    });
});