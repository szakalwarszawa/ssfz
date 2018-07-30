function sendToParp(id) {
    $("#sprawozdanieId").val(id);
    $( "#sendToParpForm" ).dialog('open');
}

function cancelSendToParp() {
    $("#sprawozdanieId").val('');
    $('#sendToParpForm').dialog('close');
}

function send(id)
{
    var dialog = bootbox.dialog({
            message: "Czy wysłać sprawozdanie do PARP?",
            buttons: {
                cancel: {
                    label: "Tak",
                    className: 'btn-info',
                    callback: function(){
                        $("#sprawozdanieId").val(id);
                        $(".btnSend").click();
                    }
                },
                ok: {
                    label: "Nie",
                    className: 'btn-danger',
                    callback: function(){
                        //var id = $("#umowaIdHidden").val();
                        //location.href = '/sprawozdanie/rejestracja/' + id;
                    }
                }
            }
        });
}

function prepareMoneyFormat(element)
{
        $value = $(element).val();
        $value = $value.replace(',','.');
        if($value && !isNaN($value)) {  
            $value = parseFloat(Math.round($value * 100) / 100).toFixed(2);            
        }
        //$value = $value.replace('.',',');
        $(element).val($value);
        $(element).text($value);
}

function validateZatrudnieniSection(men_id,women_id,all_id,errorId)
{
        if($('#' + men_id).val() == '' && $('#' + all_id).val() != '')
        {
            var new_val =  parseInt($('#' + all_id).val()) - parseInt($('#' + women_id).val());
            $('#' + men_id).val(new_val);
            if($('#' + errorId).length)
            {
                $('#' + errorId).remove();
            }
        }
        else if($('#' + men_id).val() != '' && $('#' + all_id).val() != '' && $('#' + women_id).val() != '')
        {
            if((parseInt($('#' + all_id).val()) - parseInt($('#' + women_id).val())) != parseInt($('#' + men_id).val()))
            {
                if(!$('#' + errorId).length)
                {
                    var error = '<span id="'+errorId+'" class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> Suma zatrudnionych kobiet i mężczyzn powinna być równa liczbie osób zatrudnionych </span>';
                    $('#' + all_id).parent().append(error);
                }
            }
            else if($('#' + errorId).length)
                $('#' + errorId).remove();
        }
}

function formatDecimalValue(value)
{
    value = value.replace(',','.');
    if(value != '')
        return parseFloat(value);
    return parseFloat(0);
}

jQuery(document).ready(function() {
    
    $(".decimal").each(function( index ) {
        prepareMoneyFormat(this);
    });
    
    $(".decimal" ).keyup(function() {
    		  $(this).val($(this).val().replace(',', '.'));
    	  });
	  
    $(".decimal").on('paste', function () {
		var element = this;
		setTimeout(function () {
				var text = $(element).val();
				$(element).val($(element).val().replace(',', '.'));
                                if(text.indexOf('.') == -1)
                                {
                                    if(text.length > 13)
                                        $(element).val(text.substring(0,13));
                                }
                                else
                    {
                        if(text.length > 16)
                            $(element).val(text.substring(0,16));
                    }
                                
    }, 100);});

    $(".integer").on('paste', function () {
		var element = this;
		setTimeout(function () {
				var text = $(element).val();
                                if(text.length > 5)
                                    $(element).val(text.substring(0,5));
                                
    }, 100);});
    
    $('#sprawozdanie-powrot').on('click', function(e) {
        var dialog = bootbox.dialog({
            message: "Czy zapisać dane?",
            buttons: {
                cancel: {
                    label: "Tak",
                    className: 'btn-info',
                    callback: function(){
                        $('#sprawozdanie_przekierowanie').val('beneficjent');
                        $(".btnRegister").click();
                    }
                },
                ok: {
                    label: "Nie",
                    className: 'btn-danger',
                    callback: function(){
                        var id = $("#umowaIdHidden").val();
                        location.href = '/beneficjent';
                    }
                }
            }
        });
    }); 
    $('#przeplyw-powrot').on('click', function(e) {
        var dialog = bootbox.dialog({
            message: "Czy zapisać dane?",
            buttons: {
                cancel: {
                    label: "Tak",
                    className: 'btn-info',
                    callback: function(){
                        $(".btnRegister").click();
                    }
                },
                ok: {
                    label: "Nie",
                    className: 'btn-danger',
                    callback: function(){
                        var id = $("#umowaIdHidden").val();
                        location.href = '/sprawozdanie/rejestracja/' + id;
                    }
                }
            }
        });
    }); 
    
    $('.btn-send-to-parp').on('click', function(e) {
        var dialog = bootbox.dialog({
            message: "Czy wysłać sprawozdanie do PARP?",
            buttons: {
                cancel: {
                    label: "Tak",
                    className: 'btn-info',
                    callback: function(){
                        $(".btnSend").click();
                    }
                },
                ok: {
                    label: "Nie",
                    className: 'btn-danger',
                    callback: function(){
                        var id = $("#umowaIdHidden").val();
                        location.href = '/sprawozdanie/rejestracja/' + id;
                    }
                }
            }
        });
    }); 
    if(window.location.href.indexOf("przeplyw") > -1) {
        $( "input" ).change(function() {
            var value1 =  formatDecimalValue($('#przeplyw_finansowy_udzialWZyskach').val()) 
                    + formatDecimalValue($('#przeplyw_finansowy_wyjsciaZInwestycji').val()) 
                    + formatDecimalValue($('#przeplyw_finansowy_inneWplywy').val()); 
            $("#przeplyw_finansowy_wplywy").val(value1.toFixed(2).replace(',','.'));
            
            var value2 = formatDecimalValue($('#przeplyw_finansowy_wejsciaKapitalowe').val()) 
                    + formatDecimalValue($('#przeplyw_finansowy_preinkubacjaPomyslow').val()) 
                    + formatDecimalValue($('#przeplyw_finansowy_wydatkiOperacyjne').val())
                    + formatDecimalValue($('#przeplyw_finansowy_podatki').val()) 
                    + formatDecimalValue($('#przeplyw_finansowy_inneWyplywy').val()); 
            $("#przeplyw_finansowy_wyplywy").val(value2.toFixed(2).replace(',','.'));
            
            var value3 =  formatDecimalValue($('#przeplyw_finansowy_saldoPoczatkowe').val()) 
                    + formatDecimalValue($('#przeplyw_finansowy_wplywy').val()) 
                    - formatDecimalValue($('#przeplyw_finansowy_wyplywy').val()); 
            $("#przeplyw_finansowy_saldoKoncowe").val(value3.toFixed(2).replace(',','.'));
        });
    }
    // negative bool - czy pozwolić na wprowadzanie wartości ujemnych
    // el - element do którego przypiety jest handler
    var decimalKeypressEventHandler = function (event, el, negative) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(event.keyCode, [8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (event.keyCode >= 35 && event.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        if(event.which == 44)
            event.which = 46;
        if ((event.which != 46 || $(el).val().indexOf('.') != -1) && ((event.which < 48 || event.which > 57) && (event.which != 45 || !negative))) {
            event.preventDefault();
        }
        var input = $(el).val();
        if ((input.indexOf('.') != -1) && (input.substring(input.indexOf('.')).length > 2)) {
            event.preventDefault();
        }
        if(input.indexOf('.') == -1 && input.length > 12 && event.which != 46)
        {
            event.preventDefault();
        }

    }

    $('.decimal').on('keypress',function (event) {
        decimalKeypressEventHandler(event, this, false);
    });

    $('.ndecimal').on('keypress',function (event) {
        decimalKeypressEventHandler(event, this, true);
    });

    $('.integer').on('keypress',function (event) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(event.keyCode, [ 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (event.keyCode === 65 && (event.ctrlKey === true || event.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (event.keyCode >= 35 && event.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        if ((event.which < 48 || event.which > 57) && event.which != 45) {
            event.preventDefault();
        }
        var input = $(this).val();
        if( input.length > 4)
        {
            event.preventDefault();
        }
    });
    
    $( ".decimal, .ndecimal" ).focusout(function() {
        prepareMoneyFormat(this);
    });    
    
    $('input[id$="zatrudnienieInneFormyKobiety"]').focusout(function() {
        var men_id = $(this).attr('id').replace('zatrudnienieInneFormyKobiety','zatrudnienieInneFormyMezczyzni');
        var all_id = $(this).attr('id').replace('zatrudnienieInneFormyKobiety','zatrudnienieInneFormy');
        var errorId = $(this).attr('id').replace('zatrudnienieInneFormyKobiety','zatrudnienieInneFormy_error');
        
        if($('#' + men_id).val() == '' && $('#' + all_id).val() != '')
        {
            var new_val =  parseInt($('#' + all_id).val()) - parseInt($(this).val());
            $('#' + men_id).val(new_val);
            if($('#' + errorId).length)
            {
                    $('#' + errorId).remove();
            }
        }
        else if($('#' + men_id).val() != '' && $('#' + all_id).val() != '' && $(this).val() != '')
        {
            if((parseInt($('#' + all_id).val()) - parseInt($(this).val())) != parseInt($('#' + men_id).val()))
            {
                if(!$('#' + errorId).length)
                {
                    var error = '<span id="'+errorId+'" class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> Suma zatrudnionych kobiet i mężczyzn powinna być równa liczbie osób zatrudnionych </span>';
                    $('#' + all_id).parent().append(error);
                }
            }
            else
            {
                if($('#' + errorId).length)
                {
                    $('#' + errorId).remove();
                }
            }
        }
        
    });
    
    $('input[id$="zatrudnienieInneFormyMezczyzni"]').focusout(function() {
        var men_id = $(this).attr('id');
        var women_id = $(this).attr('id').replace('zatrudnienieInneFormyMezczyzni','zatrudnienieInneFormyKobiety');
        var all_id = $(this).attr('id').replace('zatrudnienieInneFormyMezczyzni','zatrudnienieInneFormy');
        var errorId = $(this).attr('id').replace('zatrudnienieInneFormyMezczyzni','zatrudnienieInneFormy_error');
        
        if($('#' + men_id).val() == '' && $('#' + all_id).val() != '')
        {
            var new_val =  parseInt($('#' + all_id).val()) - parseInt($('#' + women_id).val());
            $('#' + men_id).val(new_val);
            if($('#' + errorId).length)
            {
                    $('#' + errorId).remove();
            }
        }
        else if($('#' + men_id).val() != '' && $('#' + all_id).val() != '' && $('#' + women_id).val() != '')
        {
            if((parseInt($('#' + all_id).val()) - parseInt($('#' + women_id).val())) != parseInt($('#' + men_id).val()))
            {
                if(!$('#' + errorId).length)
                {
                    var error = '<span id="'+errorId+'" class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> Suma zatrudnionych kobiet i mężczyzn powinna być równa liczbie osób zatrudnionych </span>';
                    $('#' + all_id).parent().append(error);
                }
            }
            else
            {
                if($('#' + errorId).length)
                {
                    $('#' + errorId).remove();
                }
            }
        }
        
    });
    
    $('input[id$="zatrudnienieInneFormy"]').focusout(function() {
        var men_id = $(this).attr('id').replace('zatrudnienieInneFormy','zatrudnieniMezczyzni');;
        var women_id = $(this).attr('id').replace('zatrudnienieInneFormy','zatrudnioneKobiety');
        var all_id = $(this).attr('id');
        var errorId = $(this).attr('id').replace('zatrudnienieInneFormy','zatrudnienieInneFormy_error');
        validateZatrudnieniSection(men_id,women_id,all_id,errorId);
    });
    
    $('input[id$="zatrudnienieEtaty"]').focusout(function() {
        var men_id = $(this).attr('id').replace('zatrudnienieEtaty','zatrudnienieInneFormyMezczyzni');;
        var women_id = $(this).attr('id').replace('zatrudnienieEtaty','zatrudnienieInneFormyKobiety');
        var all_id = $(this).attr('id');
        var errorId = $(this).attr('id').replace('zatrudnienieEtaty','zatrudnienieEtaty_error');
        validateZatrudnieniSection(men_id,women_id,all_id,errorId);
    });
    
    
    $('input[id$="zatrudnioneKobiety"]').focusout(function() {
        var men_id = $(this).attr('id').replace('zatrudnioneKobiety','zatrudnieniMezczyzni');
        var all_id = $(this).attr('id').replace('zatrudnioneKobiety','zatrudnienieEtaty');
        var errorId = $(this).attr('id').replace('zatrudnioneKobiety','zatrudnienieEtaty_error');
        
        if($('#' + men_id).val() == '' && $('#' + all_id).val() != '')
        {
            var new_val =  parseInt($('#' + all_id).val()) - parseInt($(this).val());
            $('#' + men_id).val(new_val);
            if($('#' + errorId).length)
            {
                    $('#' + errorId).remove();
            }
        }
        else if($('#' + men_id).val() != '' && $('#' + all_id).val() != '' && $(this).val() != '')
        {
            if((parseInt($('#' + all_id).val()) - parseInt($(this).val())) != parseInt($('#' + men_id).val()))
            {
                if(!$('#' + errorId).length)
                {
                    var error = '<span id="'+errorId+'" class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> Suma zatrudnionych kobiet i mężczyzn powinna być równa liczbie osób zatrudnionych </span>';
                    $('#' + all_id).parent().append(error);
                }
            }
            else
            {
                if($('#' + errorId).length)
                {
                    $('#' + errorId).remove();
                }
            }
        }
        
    });
    
    $('input[id$="zatrudnieniMezczyzni"]').focusout(function() {
        var men_id = $(this).attr('id');
        var women_id = $(this).attr('id').replace('zatrudnieniMezczyzni','zatrudnioneKobiety');
        var all_id = $(this).attr('id').replace('zatrudnieniMezczyzni','zatrudnienieEtaty');
        var errorId = $(this).attr('id').replace('zatrudnieniMezczyzni','zatrudnienieEtaty_error');
        
        
        if($('#' + men_id).val() == '' && $('#' + all_id).val() != '')
        {
            var new_val =  parseInt($('#' + all_id).val()) - parseInt($('#' + women_id).val());
            $('#' + men_id).val(new_val);
            if($('#' + errorId).length)
            {
                    $('#' + errorId).remove();
            }
        }
        else if($('#' + men_id).val() != '' && $('#' + all_id).val() != '' && $('#' + women_id).val() != '')
        {
            if((parseInt($('#' + all_id).val()) - parseInt($('#' + women_id).val())) != parseInt($('#' + men_id).val()))
            {
                if(!$('#' + errorId).length)
                {
                    var error = '<span id="'+errorId+'" class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> Suma zatrudnionych kobiet i mężczyzn powinna być równa liczbie osób zatrudnionych </span>';
                    $('#' + all_id).parent().append(error);
                }
            }
            else
            {
                if($('#' + errorId).length)
                {
                    $('#' + errorId).remove();
                }
            }
        }
        
    });
    
}); 





