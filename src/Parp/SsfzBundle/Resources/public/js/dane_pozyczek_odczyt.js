$(document).ready(function () {
    var plnOptions = {
            symbol: ' zł',
            precision: 2,
            decinal: '.',
            thousand: ' ',
            format: "%v%s"
        },
        percentOptions = {
            symbol: ' %',
            precision: 2,
            decinal: '.',
            thousand: ' ',
            format: "%v%s"
        };

    function sumByGroup() {
        var verticalGroupsInteger = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
            verticalGroupsDecimal = ['13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24'],
            horizontalGroupsInteger = ['1', '2', '3'],
            horizontalGroupsDecimal = ['4', '5', '6'],
            sum = 0,
            text;

        $.each(verticalGroupsInteger, function (index, value) {
            $('[data-vertical-group='+value+']').each(function () {
                text = $(this).text().replace(' ', '');
                sum = parseFloat(sum) + parseFloat(text);
                sum = sum.toFixed(2);
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

        $('.percent-11-2').each(function () {
            var txt;

            txt = $(this).text();
            txt = accounting.toFixed(txt, 2);
            txt = accounting.formatMoney(txt, percentOptions);
            $(this).text(txt);
        });
    }

    sumByGroup();
    format();
});
