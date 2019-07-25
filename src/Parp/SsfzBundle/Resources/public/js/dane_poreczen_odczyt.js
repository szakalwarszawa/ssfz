$(document).ready(function () {
    var plnOptions = {
            symbol: ' zł',
            precision: 2,
            decinal: '.',
            thousand: ' ',
            format: "%v%s"
        };

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
            sum = 0;

        $.each(verticalGroupsInteger, function (index, value) {
            $('[data-vertical-group='+value+']').each(function () {
                var txt;
    
                txt = $(this).text();
                sum = sum + parseInt(txt);
            });
            $('[data-vertical-group-sum='+value+']').text(sum);
            sum = 0;
        });

        $.each(verticalGroupsDecimal, function (index, value) {
            $('[data-vertical-group='+value+']').each(function () {
                var txt;

                txt = $(this).text();
                txt = accounting.unformat(txt);
                sum = sum + parseFloat(txt);
            });
            $('[data-vertical-group-sum='+value+']').text(sum);
            sum = 0;
        });
    }
    
    function format() {
        $('.decimal-11-2').each(function () {
            var txt;

            txt = $(this).text();
            txt = accounting.toFixed(txt, 2);
            txt = accounting.formatMoney(txt, plnOptions);
            $(this).text(txt);
        });
    }

    sumByGroup();
    format();
});
