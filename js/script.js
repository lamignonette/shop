$(function () {
    $('#submit').on('click', function (event) {
        event.preventDefault();
        var formName = $('[name=name]').val();
        var formSurname = $('[name=surname]').val();
        var formPassword1 = $('[name=password1]').val();
        var formPassword2 = $('[name=password2]').val();
        var formEmail = $('[name=email]').val();
        var formAddress = $('[name=address]').val();
        $.ajax({
            url: 'register.php',                          // adres pod ktory sie laczycmy
            type: "POST",                          // metoda jaka przesylamy dane
            data: {name:formName, surname: formSurname ,password1:formPassword1,password2:formPassword2,email:formEmail,formAddress:formAddress},                               // aktualny czas od teraz // $_POST['fromNow'] tego wartosc 0 ( co przesylamy ajaxem ZAWSZE W DACIE)
            success: function (czas) { // przypisanie do mziennej co nam zwraca php
                var koperek = czas.date.date;
                $('#pokaz').val(koperek);
            }
        });
    });
});