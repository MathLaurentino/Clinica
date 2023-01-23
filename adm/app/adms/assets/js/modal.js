$('#Alt').on('show.bs.modal', function(event){ // evento que detecta a abertura da modal
    var bt = $(event.relatedTarget);            // botão que abriu a modal
    var id = bt.data('whatevernome');           // valor do data
    $(this).find('#id_codigo').val(id);         // insere valor no input
 });