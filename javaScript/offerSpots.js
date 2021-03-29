function submitOffer() {
    var select = document.getElementById("parking_lot");
    var parkingLot = select.value;
    console.log(typeof select);
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
            $("#offer_status").html(data)
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
