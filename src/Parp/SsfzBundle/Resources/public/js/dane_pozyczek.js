$(document).ready(function () {
    var changed = false;

    $.fn.exists = function () {
        return this.length !== 0;
    }

    function resetChangeable() {
        changed = false;
    }

    function sumByGroup() {
        var verticalGroupsInteger = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
            verticalGroupsDecimal = ['13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24'],
            horizontalGroupsInteger = ['1', '2', '3'],
            horizontalGroupsDecimal = ['4', '5', '6'],
            sum = 0
        ;

        $.each(verticalGroupsInteger, function (index, value) {
            $('[data-vertical-group='+value+']').each(function () {
                sum = sum + parseInt($(this).val());
            });
            $('[data-vertical-group-sum='+value+']').text(sum);
            sum = 0;
        });

        $.each(verticalGroupsDecimal, function (index, value) {
            $('[data-vertical-group='+value+']').each(function () {
                sum = sum + parseFloat($(this).maskMoney('unmasked')[0]);
            });

            sum = accounting.toFixed(sum, 2);
            sum = accounting.formatMoney(sum, {
                symbol: ' zł',
                precision: 2,
                decinal: '.',
                thousand: ' ',
                format: "%v%s"
            });

            $('[data-vertical-group-sum='+value+']').text(sum);
            sum = 0;
        });
    }

    function recalculateDeps() {
        $('[name^=form_dane_pozyczek\\[liczba]').each(function (index, value) {
            var fieldValue = parseInt($(this).val()),
                fieldName = $(this).attr('name'),
                correspondingFieldValue,
                correspondingFieldName,
                correspondingField;

            correspondingFieldName = fieldName.replace('form_dane_pozyczek[liczba', 'form_dane_pozyczek[kwota');
            correspondingFieldName = correspondingFieldName.replace('[', '\\[');
            correspondingFieldName = correspondingFieldName.replace(']', '\\]');

            correspondingField = $('[name='+correspondingFieldName+']');
            if (! correspondingField.exists()) {
                return;
            }
            correspondingFieldValue = parseFloat($('[name='+correspondingFieldName+']').val());

            if ((fieldValue > 0 && correspondingFieldValue === 0) || (fieldValue <= 0 && correspondingFieldValue !== 0)) {
                $(this).closest('td').addClass('danger');
                $('[name='+correspondingFieldName+']').closest('td').addClass('danger');
            } else {
                $(this).closest('td').removeClass('danger');
                $('[name='+correspondingFieldName+']').closest('td').removeClass('danger');
            }
        });
    }

    $('[data-changeable=\'1\']').change(function () {
        changed = true;
        recalculateDeps();
    });

    $('[data-vertical-group]').change(function () {
        sumByGroup();
    });

    $('.decimal-11-2').maskMoney({
        prefix: '',
        suffix: ' zł',
        affixesStay: false,
        thousands: ' ',
        decimal: '.',
        precision: 2,
        allowZero: true,
        allowNegative: false,
        allowEmpty: false,
        reverse: false
    });

    $('.percent-11-2').maskMoney({
        prefix: '',
        suffix: ' %',
        affixesStay: false,
        thousands: ' ',
        decimal: '.',
        precision: 2,
        allowZero: true,
        allowNegative: false,
        allowEmpty: false,
        reverse: false
    });

    $('#button_return').on('click', function (event) {
        var dialog;

        event.preventDefault();
        if (changed === false) {
            location.href = $('#button_return').attr('href');
            return true;
        }

        dialog = bootbox.dialog({
            message: 'Czy zapisać dane?',
            buttons: {
                cancel: {
                    label: 'Tak',
                    className: 'btn btn-info',
                    callback: function () {
                        $('#button_submit').click();
                    }
                },
                ok: {
                    label: 'Nie',
                    className: 'btn btn-danger',
                    callback: function () {
                        location.href = $('#button_return').attr('href');
                    }
                }
            }
        });
    }); 

    sumByGroup();
    resetChangeable();
    recalculateDeps();
});
