jQuery(document).ready(function() {
    $('.js-datepicker').datepicker({
        language:"pl",
        locale: "pl",
        autoclose: true
    });
    
    var prepareMoney = function($value){
        if($value && !isNaN($value)) {
            $value = $value.replace(',','.');
            $value = parseFloat(Math.round($value * 100) / 100).toFixed(2);            
        }
        return $value;
    }
    
    var formatMoney = function ($value) {
        if(isNaN($value)){
            $value = $value.replace(',','.');
            $value = $value.replace(/[^0-9\.\-]/g,'');         
            if($value.length>1) {
               $value = $value.replace(/\-+$/,""); 
            }
            if($value.split('.').length>2) 
                $value = $value.replace(/\.+$/,"");
            }
            if($value.split('.').length == 1 && $value.split('.')[0].length > 13 && $value != '.'){
                $value = $value.substring(0,13);
            }
            return $value;
    }
    
    var calculateZwrot = function($inw, $dezinw) {
        $result = parseFloat(Math.round(((($dezinw - $inw)/$inw)*100) * 100) / 100).toFixed(2);
        if (isNaN($result)) {
            $result = null;
        }
        return $result; 
    }
    
    $('#spolka_przekierowanie').val('portfel');
    
    $('.ssfz-pln').each(function(){
        $(this).val(prepareMoney($(this).val()));
    });
    
    $zwrot =$('#spolka_zwrotInwestycji').val().replace(',','.');
    $('#spolka_zwrotInwestycji').val(prepareMoney($zwrot));
    
    $('.ssfz-pln').on('keyup', function(){
        $(this).val(formatMoney($(this).val()));
    });
    $('.ssfz-digits').on('keyup', function(){
        $value = $(this).val();
        if(isNaN($value)){            
            $value = $value.replace(/[^0-9]/g,'');                     
        }
        $(this).val($value);
    });
    $('.ssfz-pln').on('change', function(){
        $(this).val(formatMoney($(this).val()));
        $(this).val(prepareMoney($(this).val())); 
    });
     $('.ssfz-pln').on('blur', function(){
        $(this).val(formatMoney($(this).val()));
        $(this).val(prepareMoney($(this).val()));
    });   
    $('#spolka_kwInwestycji').on('change', function(e) {

        if($(this).val() && $('#spolka_kwDezinwestycji').val()){
            $('#spolka_zwrotInwestycji').val(calculateZwrot($(this).val(), $('#spolka_kwDezinwestycji').val()));
        } else {
            $('#spolka_zwrotInwestycji').val(null);
        }        
    });
    
    $('#spolka_kwDezinwestycji').on('change', function(e) {       
        if($(this).val() && $('#spolka_kwInwestycji').val()){
            $('#spolka_zwrotInwestycji').val(calculateZwrot($('#spolka_kwInwestycji').val(), $(this).val()));
        } else {
            $('#spolka_zwrotInwestycji').val(null);
        }          
    });  
    
    if(1 != $('#spolka_zakonczona').val()) {
        $('#zakonczonaDodatkowe').hide();
    }
    $('#spolka_zakonczona').on('change', function(e){
        if(1 == $('#spolka_zakonczona').val()) {
            $('#zakonczonaDodatkowe').show();
        } else {
            $('#zakonczonaDodatkowe').hide();
        }
    });

    $('#portfel-powrot').on('click', function(e) {
        var dialog = bootbox.dialog({
            message: "Czy zapisać dane?",
            buttons: {
                cancel: {
                    label: "Tak",
                    className: 'btn-info',
                    callback: function(){   
                        $('#spolka_przekierowanie').val('beneficjent');
                        $('form[name=spolka]').submit();
                    }
                },
                ok: {
                    label: "Nie",
                    className: 'btn-danger',
                    callback: function(){
                        location.href = '/beneficjent';
                    }
                }
            }
        });
    }); 
});  