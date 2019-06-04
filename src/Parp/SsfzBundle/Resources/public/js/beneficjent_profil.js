var $umowyCollectionHolder;
var $osobyZatrudnioneCollectionHolder ;
var $addUmowaLink = $('<a href="#" class="btn btn-success" role="button"><span class="fas fa-plus"></span> Dodaj kolejną umowę</a>');
var $addOsobaLink = $('<a href="#" class="btn btn-success" role="button"><span class="fas fa-plus"></span> Dodaj kolejną osobę</a>');
var $newLinkUmowaDiv = $('<div></div>').append($addUmowaLink);
var $newLinkOsobaDiv = $('<div></div>').append($addOsobaLink);

jQuery(document).ready(function() {
    $('.js-datepicker').datepicker({
        language:"pl",
        locale: "pl",
        autoclose: true
    });
    $umowyCollectionHolder = $('div.umowy');
    $osobyZatrudnioneCollectionHolder = $('div.osoby-zatrudnione');

    $umowyCollectionHolder.find('.umowa-row').each(function() {
        //addFormDeleteLink($(this));
    });
    $osobyZatrudnioneCollectionHolder.find('.osoba-row').each(function() {
        addFormDeleteLink($(this));
    });    
    $umowyCollectionHolder.append($newLinkUmowaDiv);
    $osobyZatrudnioneCollectionHolder.append($newLinkOsobaDiv);
    $umowyCollectionHolder.data('index', $umowyCollectionHolder.find(':input').length);
    $osobyZatrudnioneCollectionHolder.data('index', $osobyZatrudnioneCollectionHolder.find(':input').length);

    $addUmowaLink.on('click', function(e) {        
        e.preventDefault();
        addForm($umowyCollectionHolder, $newLinkUmowaDiv, 0);
    });    
    $addOsobaLink.on('click', function(e) {
        e.preventDefault();
        addForm($osobyZatrudnioneCollectionHolder, $newLinkOsobaDiv, 1);
        $('.js-datepicker').datepicker({
            language:"pl",
            locale: "pl",
            autoclose: true
        });
    }); 
    $('#beneficjent-profil-powrot').on('click', function(e) {
        $form = $('form[name=beneficjent]').serialize();
        if($form === $formB) {
            location.href = '/beneficjent';
        } else {
        var dialog = bootbox.dialog({
        message: "Czy zapisać dane?",
        buttons: {
            cancel: {
                label: "Tak",
                className: 'btn-info',
                callback: function(){            
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
        }
    }); 
    $formB = $('form[name=beneficjent]').serialize();
});   

function addForm($collectionHolder, $newLinkDiv, $formType) {
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);
    switch ($formType) {
        case 0:
            var $newFormDivPt1 = $('<div class="umowa-col col-sm-11"></div>').append(newForm);
            var $newFormDiv = $('<div class="row umowa-row"></div>').append($newFormDivPt1);           
            break;
        case 1:
            var $newFormDivPt1 = $('<div class="panel-body"></div>').append(newForm);
            var $newFormDivPt2 = $('<div class="panel panel-default"></div>').append($newFormDivPt1);                                       
            var $newFormDivPt3 = $('<div class="osoba-col col-sm-11"></div>').append($newFormDivPt2);
            var $newFormDiv = $('<div class="row osoba-row"></div>').append($newFormDivPt3);            
            break;
    }    
    $newLinkDiv.before($newFormDiv);
    addFormDeleteLink($newFormDiv);    
}

function addFormDeleteLink($formDiv) {
    var $removeFormA = $('<a class="btn btn-danger" href="#"><span class="fas fa-remove"></span> Usuń</a>');
    $formDiv.append($removeFormA);
    $removeFormA.on('click', function(e) {
        e.preventDefault();
        $formDiv.remove();
    });
}