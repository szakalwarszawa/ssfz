jQuery(document).ready(function () {
    $('#ocena-popraw-submit').click(function () {
        var uwagi = '';

        uwagi = $('#ocen-uwagi').val();
        if (uwagi === '') {
            alert('Komentarz musi być wypełniony.');
            return false;
        }

        $('#sprawozdanie_ocen_uwagi').val(uwagi);
        $('#sprawozdanie_ocen_status').val(4);
        $('form[name=sprawozdanie_ocen]').submit();
    });

    $('#ocena-popraw-nie').click(function () {
        $('#ocen-uwagi').val(null);
    });

    $('#ocena-powrot').click(function () {
        $('#sprawozdanie_ocen_uwagi').val(null);
        $('#sprawozdanie_ocen_status').val(2);
        $('form[name=sprawozdanie_ocen]').submit();
    });
    
    $('#ocena-zatwierdz').on('click', function (e) {
        var dialog = bootbox.dialog({
            message: "Czy zatwierdzić sprawozdanie?",
            buttons: {
                cancel: {
                    label: "Tak",
                    className: 'btn-info',
                    callback: function () {
                        $('#sprawozdanie_ocen_uwagi').val(null);
                        $('#sprawozdanie_ocen_status').val(3);
                        $('form[name=sprawozdanie_ocen]').submit();
                    }
                },
                ok: {
                    label: "Nie",
                    className: 'btn-danger',
                    callback: function () {
                    }
                }
            }
        });
    })
});
