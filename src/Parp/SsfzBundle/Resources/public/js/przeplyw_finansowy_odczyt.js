$(document).ready(function () {
    var plnOptions = {
        symbol: ' zł',
        precision: 2,
        decinal: '.',
        thousand: ' ',
        format: "%v%s"
    };
   
    function format() {
        $('.decimal-11-2').each(function () {
            var txt;

            txt = $(this).text();
            txt = accounting.toFixed(txt, 2);
            txt = accounting.formatMoney(txt, plnOptions);
            $(this).text(txt);
        });
    }

    format();
});
