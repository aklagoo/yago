/* Global variables */
var data;

/* Initial loading functions */
function generateOrderCards(orderList) {
    ordersDiv = "";
    orderList.forEach(element => {
        /* Generating stats and variables */
        prepared =  element.prepared  + " / " + element.quantity;
        collected = element.collected + " / " + element.quantity;
        if(element.paid=="1") {
            paid = "<span class='positive'>Yes</span>";
        }
        else {
            paid = "<span class='negative'>No</span>";
        }

        orderhtml = `
        <div class='card order'>
        <h4>Order ID: ` + element.orderID + "</h4>" +
        "<p class='status_paid'>Paid: " + paid + "</p>" +
        "<p>Prepared: " + prepared + "</p>" +
        "<p>Collected: " + collected + "</p>" +
        "</table><hr><table class='suborder-list'><tr>"
        + "<th>Name</th><th>Total</th><th>Prepared</th><th colspan=3>Collected</th></tr>"
        ;

        /* Getting list of suborders */
        element.suborders.forEach(suborder => {
            subhtml = `
            <tr class='suborder' id='`+suborder.subID+`'>
            <td>` + suborder.name + ' x ' + suborder.quantity + `</td>
            <td>` + suborder.total + `</td>
            <td><button class='button-round decr-prepared' id='`+suborder.subID+`'>&#x2212;</button>
            <td>` + suborder.prepared + '/' + suborder.quantity + `</td>
            <td><button class='button-round incr-prepared' id='`+suborder.subID+`'>&#x2b;</button></td>
            <td><button class='button-round decr-collected' id='`+suborder.subID+`'>&#x2212;</button>
            <td>` + suborder.collected + '/' + suborder.quantity + `</td>
            <td><button class='button-round incr-collected' id='`+suborder.subID+`'>&#x2b;</button></td>
            </tr>
            `;
            orderhtml = orderhtml + subhtml;
        });
        orderhtml = orderhtml + "</table><button class='button-primary btnPaid'>Paid</button></div>";
        ordersDiv = ordersDiv + orderhtml;
    });
    return ordersDiv;
}
function generateFoodTable(foodGroups) {
    html = "<table><tr><th>Name</th><th>Quantity</th></tr>";
    foodGroups.forEach(group => {
        grouphtml = `
        <tr>
        <td>`+group.name+`</td>
        <td>`+group.quantity+`</td>
        </tr>
        `;
        html = html + grouphtml;
    })
    return html;
}

function initFillPage(rawData) {
}

function fetchAll() {
    var reply;
    $.ajax({
        type: "POST",
        url: "http://yago1.000webhostapp.com/dashboard",
        data: {action : 'fetchAll'},
        success: function(rawData) {
            console.log(rawData);
            /* JSON parse the data */
            data = JSON.parse(rawData);
            console.log(data);
        
            /* Generate HTML for orders */
            orderhtml = generateOrderCards(data.orders);
            $(".order-div").html(orderhtml);

            /* Generate HTML for foods */
            foodhtml = generateFoodTable(data.foodGroups);
            $(".food-div").html(foodhtml);
        }
    });
}

$(document).on('click','.btnPaid',function(){
    parent = $(this).parent();
    id = parent.children("h4").html().slice(10);
    console.log(parent);
    $.ajax({
        type: "POST",
        url: "http://yago1.000webhostapp.com/dashboard",
        data: {action : 'paid', orderID:parseInt(id)},
        success: function(response) {
            location.reload();
            // parent.children("p.status_paid").children("span").html("Yes");
            // parent.children("p.status_paid").children("span").removeClass('negative');
            // parent.children("p.status_paid").children("span").addClass('positive');
        }
    });
});
$(document).on('click','.incr-collected',function(){
    id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url: "http://yago1.000webhostapp.com/dashboard",
        data: {action : 'modify', suborderID: parseInt(id) ,modifier: '+1', type: 'collected'},
        success : function(response) {
            location.reload(true);;
        }
    });
});
$(document).on('click','.decr-collected',function(){
    id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url: "http://yago1.000webhostapp.com/dashboard",
        data: {action : 'modify', suborderID: parseInt(id) ,modifier: '-1', type: 'collected'},
        success: function(response) {
            location.reload(true);;
        }
    });
});
$(document).on('click','.incr-prepared',function(){
    id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url: "http://yago1.000webhostapp.com/dashboard",
        data: {action : 'modify', suborderID: parseInt(id) ,modifier: '+1', type: 'prepared'},
        success: function(response) {
            location.reload(true);;
        }
    });
});
$(document).on('click','.decr-prepared',function(){
    id = $(this).attr('id');
    $.ajax({
        type: "POST",
        url: "/dashboard",
        data: {action : 'modify', suborderID: parseInt(id) ,modifier: '-1', type: 'prepared'},
        success: function(response) {
            location.reload(true);;
        }
    });
});

$(document).ready(function() {

fetchAll();

});