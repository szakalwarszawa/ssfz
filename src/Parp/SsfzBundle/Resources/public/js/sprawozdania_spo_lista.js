jQuery(document).ready(function() {
    $('.btn-send-to-parp').on('click', function(e) {
        var dialog = bootbox.dialog({
            message: "Czy wysłać sprawozdanie do PARP?",
            buttons: {
                ok: {
                    label: "Tak",
                    className: 'btn-danger',
                    callback: function(){
                        var url = e.target.getAttribute('data-href');
                        location.href = url;
                    }
                },
                cancel: {
                    label: "Nie",
                    className: 'btn-info',
                    callback: function(){
                    }
                }
            }
        });
    }); 
});
