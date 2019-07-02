$(document).ready(function () {
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

    sumByGroup();
});
