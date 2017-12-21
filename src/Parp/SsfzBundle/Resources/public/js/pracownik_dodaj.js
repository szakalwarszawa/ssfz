$('#pracownicy-powrot').click(function(){
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
                    location.href = '/';
                }
            }
        }
    });
});

//$('#pracownicy-dodano').click(function () {
//      alert('Dodano nowego pracownika.');
//});

    
$('#pracownicy-powrot').click(function(){
    var dialog1 = bootbox.alert({
        //message: "This is an alert with a callback!",
        callback: function () {
            console.log('udalo sie');
        }
   });
});