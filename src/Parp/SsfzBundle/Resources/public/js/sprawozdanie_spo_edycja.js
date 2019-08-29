var $skladnikiOgolemCollectionHolde,
    $skladnikiWydzieloneCollectionHolde,
    $addSkladnikOgolemLink = $('<a href="#" class="btn btn-success" role="button"><span class="fas fa-plus"></span> Dodaj składnik</a>'),
    $newLinkSkladnikOgolemDiv = $('<div></div>').append($addSkladnikOgolemLink),
    $addSkladnikWydzielonyLink = $('<a href="#" class="btn btn-success" role="button"><span class="fas fa-plus"></span> Dodaj składnik</a>'),
    $newLinkSkladnikWydzielonyDiv = $('<div></div>').append($addSkladnikWydzielonyLink);

$(document).ready(function () {
    $('.js-datepicker').datepicker({
        language:"pl",
        locale: "pl",
        autoclose: true
    });
    
    $skladnikiOgolemCollectionHolder = $('div.skladniki-ogolem');
    $skladnikiOgolemCollectionHolder.find('.skladnik-ogolem-row').each(function () {
        addFormDeleteLink($(this));
    });    
    $skladnikiOgolemCollectionHolder.append($newLinkSkladnikOgolemDiv);
    $skladnikiOgolemCollectionHolder.data('index', $skladnikiOgolemCollectionHolder.find(':input').length);

    $addSkladnikOgolemLink.on('click', function (e) {
        e.preventDefault();
        addForm($skladnikiOgolemCollectionHolder, $newLinkSkladnikOgolemDiv, 1);
        $('.js-datepicker').datepicker({
            language:"pl",
            locale: "pl",
            autoclose: true
        });
    });
    
    $skladnikiWydzieloneCollectionHolder = $('div.skladniki-wydzielone');
    $skladnikiWydzieloneCollectionHolder.find('.skladnik-wydzielony-row').each(function () {
        addFormDeleteLink($(this));
    });    
    $skladnikiWydzieloneCollectionHolder.append($newLinkSkladnikWydzielonyDiv);
    $skladnikiWydzieloneCollectionHolder.data('index', $skladnikiWydzieloneCollectionHolder.find(':input').length);

    $addSkladnikWydzielonyLink.on('click', function (e) {
        e.preventDefault();
        addForm($skladnikiWydzieloneCollectionHolder, $newLinkSkladnikWydzielonyDiv, 2);
        $('.js-datepicker').datepicker({
            language:"pl",
            locale: "pl",
            autoclose: true
        });
    });

    $('#btn_powrot').on('click', function(e) {
        bootbox.dialog({
            message: "Czy zapisać dane?",
            buttons: {
                cancel: {
                    label: "Tak",
                    className: 'btn-info width-xshort',
                    callback: function () {
                        $('#form_sprawozdanie').submit();
                    }
                },
                ok: {
                    label: "Nie",
                    className: 'btn-danger width-xshort',
                    callback: function () {
                        location.href = e.target.getAttribute('data-href-powrot');
                    }
                }
            }
        });
    });

    $('.kod-pocztowy').mask("99-999", {
        placeholder: '__-___'
    });
});

function addForm($collectionHolder, $newLinkDiv, $formType) {
    var prototype = $collectionHolder.data('prototype');
    var index = $collectionHolder.data('index');
    var newForm = prototype;
    newForm = newForm.replace(/__name__/g, index);
    $collectionHolder.data('index', index + 1);
    var $newFormDivPt1 = $('<div class="panel-body"></div>').append(newForm);
    var $newFormDivPt2 = $('<div class="panel panel-default"></div>').append($newFormDivPt1);                                       
    switch ($formType) {
        case 1:
            var $newFormDivPt3 = $('<div class="skladnik-ogolem-col col-sm-11"></div>').append($newFormDivPt2);
            var $newFormDiv = $('<div class="row skladnik-ogolem-row"></div>').append($newFormDivPt3);
            break;
        case 2:
            var $newFormDivPt3 = $('<div class="skladnik-wydzielony-col col-sm-11"></div>').append($newFormDivPt2);
            var $newFormDiv = $('<div class="row skladnik-wydzielony-row"></div>').append($newFormDivPt3);
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
