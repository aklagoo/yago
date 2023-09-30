var plate;

function renderPlate() {
    htm = "<table class='plate-table'>";
    var total = 0;
    for(i=0; i<plate.length; i++) {
        total = total + plate[i].cost * plate[i].quantity;
        row = "<tr><td>" + plate[i].name + "</td><td>Rs. " + plate[i].cost + "</td>"
            +"<td>" + plate[i].quantity + "</td>"+
            "<td><button class='button-round decQty' "+ (plate[i].quantity == 1 ? "disabled" : "") + "  id='" + plate[i].foodID + "'>-</button></td>"+
            "<td><button class='button-round incQty'  id='" + plate[i].foodID + "'>+</button></td>"+
            "<td><button class='button-round delItem' id='" + plate[i].foodID + "'>x</button></td>"+
            "</tr>";
        htm = htm + row;
    }
    htm = htm + "<tr><th id='total'>Total</th><td colspan=2>Rs. "+total+"</td></tr></table><button class='button-primary' id='placeOrder'>Place order</button>";
    if(total == 0) {
        $(".plate-div").html("No items added!");
    }
    else{
        $(".plate-div").html(htm);
    }
}

function getPlate() {
    $.ajax({
        type : 'POST',
        url : '/plate',
        data : {
            action      : 'fetchPlate'
        },
        success : function(response){
            plate = JSON.parse(response);
            renderPlate();
        }
    });
}

$(document).ready(function(){
    getPlate();

    $(document).on("click",".buy-btn",function(){
        fields = $(this).parent().parent().children("td");
        foodID = $(this).attr('id');
        $.ajax({
            type : 'POST',
            url : '/plate',
            data : {
                action : 'add',
                foodID : $(this).attr('id')
            },
            success : function(response){
                getPlate();
            }
        });
    });
    $(document).on("click",".incQty",function(){
        id = parseInt($(this).attr('id'));
        par = $(this).parent().parent();
        $.ajax({
            type : 'POST',
            url : '/plate',
            data : {
                action      : 'set',
                foodID      : $(this).attr('id'),
                quantity    : parseInt($(this).parent().parent().children('td:nth-child(3)').html()) + 1
            },
            success : function(response){
                if(response==0) {
                    /* Search for id and increment the quantity*/
                    for(i=0; i<plate.length; i++) {
                        if(plate[i].foodID == id) {
                            plate[i].quantity = plate[i].quantity + 1;
                            break;
                        }
                    }
                    renderPlate();
                }
            }
        });
    });
    $(document).on("click",".decQty",function(){
        id = parseInt($(this).attr('id'));
        par = $(this).parent().parent();
        $.ajax({
            type : 'POST',
            url : '/plate',
            data : {
                action      : 'set',
                foodID      : $(this).attr('id'),
                quantity    : parseInt($(this).parent().parent().children('td:nth-child(3)').html()) - 1
            },
            success : function(response){if(response==0) {
                /* Search for id and decrement the quantity*/
                for(i=0; i<plate.length; i++) {
                    if(plate[i].foodID == id) {
                        plate[i].quantity = plate[i].quantity - 1;
                        break;
                    }
                }
                renderPlate();
            }
            }
        });
    });
    $(document).on("click",".delItem",function(){
        id = parseInt($(this).attr('id'));
        $.ajax({
            type : 'POST',
            url : '/plate',
            data : {
                action      : 'set',
                foodID      : $(this).attr('id'),
                quantity    : 0
            },
            success : function(response){
                if(response==0) {
                    if(response==0) {
                        /* Search for id and increment the quantity*/
                        for(i=0; i<plate.length; i++) {
                            if(plate[i].foodID == id) {
                                plate.splice(i,1);
                            }
                        }
                        renderPlate();
                    }
                }
            }
        });
    });
    $(document).on("click","#placeOrder",function(){
        $.ajax({
            type : 'POST',
            url : '/plate',
            data : {
                action : 'placeOrder'
            },
            success : function(response){
                if(response==0) {
                    alert("Order placed");
                    plate = [];
                    renderPlate();
                }
                else if(response==1) {
                    location.replace("/login");
                }
            }
        });
    });

    /* Styling */
    $(".plate-modal-trigger").click(function(){
        $(".plate-modal").fadeIn();
        $(".plate-div").fadeIn();
    });
    $(".close-plate-modal").click(function(){
        $(".plate-modal").fadeOut();
        $(".plate-div").fadeOut();
    });
    $(".login-trigger").click(function(){
        location.replace("/login");
    });
    $(".logout-trigger").click(function(){
        $.ajax({
            type    : 'POST',
            data    : {action:'logout'},
            url     : '/login',
            success : function(result){
                if(result=='0'){
                    location.reload();
                }
            }
        });
        return false;
    });
});