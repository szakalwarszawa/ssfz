$(document).ready(function () {
    var changed = false;

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

    $('[data-changeable=\'1\']').change(function () {
        changed = true;
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
});
