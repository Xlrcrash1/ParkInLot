var spotLoop;

function getStatus(){
    var status = 0;
    $.ajax({
        method:"POST",
        url:"checkstatus.php",
        datatype:"json",
        data:{isOnReqPage: 0},
        async: false,
        success:function(statusCode){
            console.log(statusCode);
            console.log(typeof statusCode);
            // if (statusCode != 2)
            // {
            //     clearInterval(spotCheck);
            // }
            status = statusCode;
        }
    });
    return status;
};

function submitOffer() {
    var select = document.getElementById("parking_lot");
    var parkingLot = select.value;
    offerParkingSpot(parkingLot);
};

function offerParkingSpot(parkingLot){
    // var lotStr = JSON.stringify(lot);
    // console.log(lot)
    // console.log(typeof lot);
    var status = document.getElementById('offer_status');
    status.innerHTML = "";

    $.ajax({
        method: "POST",
        url: "manageOffer.php",
        data: 
        {
            action:"add",
            parkingLot:parkingLot
        },
        dataType: "html",
        success:function(data){
            $("#offer_status").html(data);
            spotCheck();
        }
    });
};

function cancelOffer(){
    var status = document.getElementById('offer_status');
    status.innerHTML = "";

    $.ajax({
        method: "POST",
        url: "manageOffer.php",
        data: 
        {
            action:"cancel",
        },
        dataType: "html",
        success:function(data){
            $("#offer_status").html(data)
        }
    });
};

function spotCheck(){
    var status = getStatus();

    spotLoop = setInterval(function(){
        console.log(status);
        if (status == 20){
            clearInterval(spotLoop);
        } else if (status == 2){
            status = getStatus();
            $.ajax({
                method:"POST",
                url:"getofferstatus.php",
                datatype:"html",
                success:function(data){
                    $("#offer_status").html(data);
                }
            });
        } else {
            output = "<div class = 'alert alert-info'><strong>You are not yet offering your parking spot. </strong><br>Please enter your parking lot to continue or you can click <strong>Cancel</strong> if you would like to cancel your offer.</div>";
            $("#offer_status").html(output);
        }

        if (status == 20){
            clearInterval(spotLoop);
        }
    }, 5000);
    if (status == 20){
        clearInterval(spotLoop);
    }
};
function offerDetails(){
    location.href = "offerdetails.php";
};

function updateOffer(){
    var status = document.getElementById('offer_status');
    status.innerHTML = "";

    $.ajax({
        method: "POST",
        url: "manageOffer.php",
        data: 
        {
            action:"update",
        },
        dataType: "html",
        success:function(data){
            $("#offer_status").html(data)
        }
    });

}

// document.getElementById("myButton").onclick = function () {
//     location.href = "www.yoursite.com";
// };