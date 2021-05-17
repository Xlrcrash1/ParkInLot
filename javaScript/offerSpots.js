var spotLoop; // Used to consistently check for a match in the spot table
var completionLoop; // Used to consistently check the status of the request once a spot is requested

function getStatus(){
    var status = 0;
    // Ajax function calls getstatus.php to get the current SESSION statusCode value
    $.ajax({ 
        method:"POST",
        url:"../getstatus.php",
        datatype:"json",
        data:{isOnReqPage: 0},
        async: false,
        success:function(statusCode){
            console.log(statusCode);
            console.log(typeof statusCode);

            status = statusCode;
        }
    });
    return status;
};

// Grab Parking lot selection and call offerParkingSpot function to submit offer
function submitOffer() { 
    var select = document.getElementById("parking_lot");
    var parkingLot = select.value;
    offerParkingSpot(parkingLot);
};

function offerParkingSpot(parkingLot){

    // Clear offer status div
    var status = document.getElementById('offer_status');
    status.innerHTML = "";

    // Ajax function calls manage.php and passes in an "add" action string
    $.ajax({
        method: "POST",
        url: "manage.php",
        data: 
        {
            action:"add",
            parkingLot:parkingLot
        },
        dataType: "html",
        success:function(data){
            $("#offer_status").html(data); // Update offer_status div 
            spotCheck(); // Call spotCheck() function
        }
    });
};

// Function to cancel an offer request
function cancelOffer(){
    // Clear offer_status div
    var status = document.getElementById('offer_status');
    status.innerHTML = "";

    // Ajax function calls manage.php and passes in "cancel" action string
    $.ajax({
        method: "POST",
        url: "manage.php",
        data: 
        {
            action:"cancel",
        },
        dataType: "html",
        success:function(data){
            $("#offer_status").html(data) // Update offer_status div
        }
    });
};

// Function creates an interval function to update the status of the parking spot offer
function spotCheck(){
    var statusCode = getStatus(); // Get current statusCode for user

    // Start spotLoop interval function 
    spotLoop = setInterval(function(){
        console.log(statusCode);
        
        if (statusCode == 20){ // If the user is offering a spot and a requester has been found
            clearInterval(spotLoop); // Stop spotLoop the interval function
            checkCompletion(); // Call checkCompletion() to check completion status
            console.log("first check");
        } else if (statusCode == 2){ // If user is offering a spot and a requester has not been found
            statusCode = getStatus(); // Get the updated SESSION statusCode

            // Ajax function runs offerstatus.php to get and display the current offer status
            $.ajax({
                method:"POST",
                url:"offerstatus.php",
                datatype:"html",
                success:function(data){
                    $("#offer_status").html(data); // Display offer status
                }
            });
        } else { // A spot has not been offered yet
            output = "<div class = 'alert alert-info'><strong>You are not yet offering your parking spot. </strong><br>Please enter your parking lot to continue or you can click <strong>Cancel</strong> if you would like to cancel your offer.</div>";
            $("#offer_status").html(output); // Update offer_status div
        }

        if (statusCode == 20){ // Second check to check for completion
            clearInterval(spotLoop);
            checkCompletion();
            console.log("second check");

        }
    }, 5000);
    if (statusCode == 20){ // Third check to check for completion
        clearInterval(spotLoop);
        checkCompletion();
        console.log("third check");
    }
};

// Redirect to details.php
function offerDetails(){
    location.href = "details.php";
};

// Update offer status
function updateOffer(){

    // Clear offer_status div
    var status = document.getElementById('offer_status');
    status.innerHTML = "";

    // Ajax function calls manage.php and passes "update" action
    $.ajax({
        method: "POST",
        url: "manage.php",
        data: 
        {
            action:"update",
        },
        dataType: "html",
        success:function(data){
            // Display new status on offer_status div
            $("#offer_status").html(data)
            checkCompletion();
        }
    });

};

// Function checks for the completion/cancellation of a parking spot offer
function checkCompletion(){
    var status = getStatus(); // Grab the current statusCode

    // Clear comp_status div
    var compStatus = document.getElementById('comp_status');
    compStatus.innerHTML = "";

    // Start completionLoop interval function to check completion status
    completionLoop = setInterval(function(){
        status = getStatus(); // Get current statusCode

        compStatus.innerHTML = ""; // Clear comp_status div

        // Ajax function calls checkcompletion.php to get the current status of the trade
        $.ajax({
            method:"POST",
            url:"checkcompletion.php",
            datatype:"html",
            success:function(data){
                if(status == 0){ // Spot trade has been completed

                    clearInterval(completionLoop); // Stop the completionLoop
                    $("#comp_status").html(data); // Display status of the trade

                } else if (status == 2){ // Trade has been cancelled

                    clearInterval(completionLoop); // Stop the completionLoop
                    $("#offer_status").html(data); // Display status of the trade
                    spotCheck(); // Start spotCheck to search for new requesters
                } else{
                    $("#comp_status").html(data); // Display status of trade
                }
            }
        });

        if(status == 0){ // StatusCode 0 = not requesting and not offerring a spot
            clearInterval(completionLoop); // Clear completionLoop check
        }

    }, 5000);
};

// Get current position of user
function getPosition() {
    if(navigator.geolocation) { // If geolocation is allowed/enabled
        navigator.geolocation.getCurrentPosition(function(position) {
            
            // Ajax function calls updatelocation.php to update user's location in the database
            $.ajax({
                method:"POST",
                url:"../offer/updatelocation.php",
                data:{
                    longitude: position.coords.longitude,
                    latitude: position.coords.latitude
                },
                datatype:"html",
                async: false,
                success:function(data){

                }
            });

            var positionInfo = "Your current position is (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";
            console.log(positionInfo);

            // Submit parking spot offer
            submitOffer();

        });
    } else {
        alert("Sorry, your browser does not support HTML5 geolocation.");
    }
};
