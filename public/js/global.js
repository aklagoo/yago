$(document).ready(function(){
    $("#signIn").click(function(){
        type = $('.switch-selected').attr('id').replace('Select','');
        obj = {action:'login',user:$("input[name='email']").val(), password:$("input[name='password']").val(), type:type};
        console.log(obj);
        $.ajax({
            type    : 'POST',
            data    : obj,
            url     : '/login',
            success : function(response){
                console.log(response);
                if(response=='0') {
                    alert("User doesn't exist!");
                }
                else if(response=='1') {
                    alert("The combination doesn't match!");
                }
                else if(response=='2') {
                    location.replace("http://localhost:8000/");
                }
            }
        });
        return false;
    });
    $("#signOut").click(function(){
        $.ajax({
            type    : 'POST',
            data    : {action:'signOut'},
            url     : '/login',
            success : function(result){
                console.log(response);
            }
        });
        return false;
    });
    $(".switch-p").click(function(){
        list = $(this).attr('class').split(/\s+/);
        if(list[1]=="switch-not-selected"){
            selected = $(this).parent().children(".switch-selected");
            selected.removeClass("switch-selected");
            selected.addClass("switch-not-selected");
            $(this).removeClass("switch-not-selected");
            $(this).addClass("switch-selected");
        }
    });
});