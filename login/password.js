$(document).ready(function () {
    $("#password").keyup(function () {
        validatePassword();
    });
   

    $("#login").submit(function(e) {
        e.preventDefault();
        if (validatePassword()) {
            $("#password-message").html("Password is valid!");
            //$("#password-message").show("");
            $('#login').unbind('submit').submit();
           
        } else {
            $("#password-message").html("Password is invalid!");
        }
    });

    function validatePassword() {
        var password = $("#password").val();
        var passwordMessage = $("#password-message");
       
        var regex = /[^0-9]/g;
       

        if (regex.test(password)){
            return true;
        } else {
            $("#password-message").html("password is invalid");
            return false;
        }
    }
});