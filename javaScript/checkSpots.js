function cancelRequest(){ // Called when Cancel button is clicked
    $.ajax({    // Ajax function calls manageRequest.php and with "cancel" action
        method:"POST",
        url:"manageRequest.php",
        data:{action:"cancel", status:0},
        datatype:"html",
        success:function(data){
            $("#request_status").html(data) // Output HTML statments onto div #request_status passed back from manageRequest.php
        }
    });
    clearInterval(spotCheck)
};

function submitRequest(){ // Called when Request button is clicked
    $.ajax({    // Ajax function calls checkstatus.php to check for the status code for the user
        method:"POST",
        url:"checkstatus.php",
        datatype:"json",
        success:function(statusCode){
            if (statusCode == 1){   // statusCode 1 - User is requesting a spot, but has not yet been paired with a parking spot

                clearInterval(spotCheck) // Stop current search for a parking spot
                console.log(statusCode);
                output = "<div class = 'alert alert-danger'>You're already requesting a parking spot.</div>"
                location.reload()

            } else if (statusCode == 10){ // statusCode 10 - User is requesting a spot and has already been paired with a spot

                // Output HTML statments onto div #request_status to notify user of the status
                output = "<div class = 'alert alert-danger'>We've already paired you with a parking spot. Please click cancel if you would like to cancel your request</div>";

            } else if (statusCode == 0){ // statusCode 0 - User is not requesting or offering a parking spot

                // Reload the page to start the request for a parking spot
                location.reload()  
            }
            $("#request_status").html(output); // Output HTML statments onto div #request_status to notify user of the status
        }
    });
};

var spotCheck = setInterval(function()  // Creating var spotCheck as a setInterval function which runs every 5 seconds
{ 
    $.ajax({    // Ajax function which calls checkspots.php to check for available parking spots
        method:"POST",
        url:"checkspots.php",
        datatype:"html",
        success:function(data){
            
            // Clear div #request_status
            document.getElementById("request_status").innerHTML = "";

            // Output new status based on html data received from checkspots.php
            $("#request_status").html(data)

            $.ajax({    // Ajax function calls checkstatus.php to retrieve the user's status code
                method:"POST",
                url:"checkstatus.php",
                datatype:"json",
                success:function(statusCode){
                    if (statusCode != 1){           // If status is not 1, then user should no longer be looking for a parking spot
                        clearInterval(spotCheck)    // Stoping the spotCheck interval function
                        console.log(statusCode);
                    } 
                }
            });
        }
    });
}, 5000);//time in milliseconds 
