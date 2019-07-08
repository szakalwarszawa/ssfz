$(document).ready(function () {
    var changed = false;

    $.fn.exists = function () {
        return this.length !== 0;
    }

    function resetChangeable() {
        changed = false;
    }

    function sumByGroup() {
        var verticalGroupsInteger = [
                '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '35',
                '36', '37', '38', '39', '40', '41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52'
            ],
            verticalGroupsDecimal = [
                '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34',
                '53', '54', '55', '56', '57', '58', '59', '60', '61', '62', '63', '64', '65', '66', '67', '68', '69'
            ],
            horizontalGroupsInteger = ['9'],
            horizontalGroupsDecimal = [],
            sum = 0
        ;

        $.each(verticalGroupsInteger, function (index, value) {
            $('[data-vertical-group='+value+']').each(function () {
                sum = sum + parseInt($(this).val());
            });
            sum = sum < 0 ? 0 : sum;
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

    function toggleTable(tableId) {
        var togglerSelector = $('[data-toggle-table='+tableId+']'),
            tableSelector = $('#table_'+tableId),
            iconSelector = $('[data-toggle-table-icon='+tableId+']');

        if (togglerSelector.is(':checked')) {
            tableSelector.slideUp('slow');
            iconSelector.removeClass('fa-minus-circle');
            iconSelector.addClass('fa-plus-circle');
        } else {
            tableSelector.slideDown('slow');
            iconSelector.removeClass('fa-plus-circle');
            iconSelector.addClass('fa-minus-circle');
        }
    }

    function recalculateDeps() {
        $('[name^=form_dane_poreczen\\[liczba]').each(function (index, value) {
            var fieldValue = parseInt($(this).val()),
                fieldName = $(this).attr('name'),
                correspondingFieldValue,
                correspondingFieldName,
                correspondingField;

            correspondingFieldName = fieldName.replace('form_dane_poreczen[liczba', 'form_dane_poreczen[kwota');
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

    $('[data-changeable=\'1\']').change(function () {
        changed = true;
        recalculateDeps();
    });

    $('[data-vertical-group]').change(function () {
        sumByGroup();
    });

    $('.uint-5').change(function () {
        var value;

        value = parseInt($(this).val());
        if (value < 0) {
            $(this).val(0);
        }
    });

    $('[data-toggle-table=\'1\']').change(function () {
        toggleTable('1');
    });

    $('[data-toggle-table=\'2\']').change(function () {
        toggleTable('2');
    });

    $('[data-toggle-table=\'3\']').change(function () {
        toggleTable('3');
    });

    $('[data-toggle-table=\'4\']').change(function () {
        toggleTable('4');
    });

    $('[data-toggle-table=\'5\']').change(function () {
        toggleTable('5');
    });

    $('[data-toggle-table=\'6\']').change(function () {
        toggleTable('6');
    });

    $('[data-toggle-table=\'7\']').change(function () {
        toggleTable('7');
    });

    $('[data-toggle-table=\'8\']').change(function () {
        toggleTable('8');
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
