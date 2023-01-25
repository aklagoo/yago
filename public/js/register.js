$(document).ready(function(){
    $("#btnRegister").click(function(){
        var err = false;
        var foc;
        //Validations
        if(document.user_register.password.value=='') {
            $("#passwordError").html("This field is required.");
            err = true;
            foc = document.user_register.password;
        }
        if(document.user_register.mobile.value=='') {
            $("#mobileError").html("This field is required.");
            err = true;
        }
        if(document.user_register.email.value=='') {
            $("#emailError").html("This field is required.");
            err = true;
        }
        if(document.user_register.lName.value=='') {
            $("#lNameError").html("This field is required.");
            err = true;
        }
        if(document.user_register.fName.value=='') {
            $("#fNameError").html("This field is required.");
            err = true;
        }
        if(!err) {
            $.ajax({
                type : 'POST',
                url : "http://yago1.000webhostapp.com/register",
                data : {action:'register', fName:document.user_register.fName.value, lName:document.user_register.lName.value, email:document.user_register.email.value, mobile:document.user_register.mobile.value, password:document.user_register.password.value},
                success : function(response) {
                    if(response=='0'){
                        location.replace("http://yago1.000webhostapp.com/");
                    }
                    if(response=='1'){
                        alert("This email has already been registered.");
                    }
                    if(response=='2'){
                        alert("This mobile number has already been registered.");
                    }
                    if(response=='3'){
                        alert("The email and mobile have already been registered.");
                    }
                }
            });
        }
        return false;
    });
});