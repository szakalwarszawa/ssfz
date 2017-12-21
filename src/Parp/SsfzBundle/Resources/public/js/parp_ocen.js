jQuery(document).ready(function() {

    $('#ocena-popraw-submit').click(function(){
         /* when the submit button in the modal is clicked, submit the form */
        $('#sprawozdanie_ocen_uwagi').val($('#ocen-uwagi').val());
        $('#sprawozdanie_ocen_status').val(4);
        $('form[name=sprawozdanie_ocen]').submit();
    });

    $('#ocena-popraw-nie').click(function(){
        $('#ocen-uwagi').val(null);
    });

    $('#ocena-powrot').click(function(){
        $('#sprawozdanie_ocen_uwagi').val(null);
        $('#sprawozdanie_ocen_status').val(2);
        $('form[name=sprawozdanie_ocen]').submit();
    });
    
    $('#ocena-zatwierdz').on('click', function(e) {
        var dialog = bootbox.dialog({
            message: "Czy zatwierdzić sprawozdanie?",
            buttons: {
                cancel: {
                    label: "Tak",
                    className: 'btn-info',
                    callback: function(){   
                        $('#sprawozdanie_ocen_uwagi').val(null);
                        $('#sprawozdanie_ocen_status').val(3);
                        $('form[name=sprawozdanie_ocen]').submit();
                    }
                },
                ok: {
                    label: "Nie",
                    className: 'btn-danger',
                    callback: function(){
                    //location.href = '/beneficjent';
                    }
                }
            }
        });
    }); 
});   