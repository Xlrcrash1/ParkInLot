function cancelRequest(){
    // $_SESSION['statusCode'] = 0
    $.ajax({
        method:"POST",
        url:"manageRequest.php",
        data:{action:"cancel", status:0},
        datatype:"html",
        success:function(data){
            $("#request_status").html(data)
        }
    });
    clearInterval(spotCheck)
};

function submitRequest(){
    // $_SESSION['statusCode'] = 1
    $.ajax({
        method:"POST",
        url:"checkstatus.php",
        datatype:"json",
        success:function(statusCode){
            if (statusCode == 1){
                clearInterval(spotCheck)
                console.log(statusCode);
                output = "<div class = 'alert alert-danger'>You're already requesting a parking spot.</div>"
                location.reload()
            } else if (statusCode == 10){
                output = "<div class = 'alert alert-danger'>We've already paired you with a parking spot. Please click cancel if you would like to cancel your request</div>";
                $("#request_status").html(output);
            } else if (statusCode == 0){
                location.reload()
            }
            $("#request_status").html(output);
        }
    });
};

var spotCheck = setInterval(function()
{ 
    $.ajax({
        method:"POST",
        url:"checkspots.php",
        datatype:"html",
        success:function(data){
            //do something with response data
            document.getElementById("request_status").innerHTML = "";
            $("#request_status").html(data)

            $.ajax({
                method:"POST",
                url:"checkstatus.php",
                datatype:"json",
                success:function(statusCode){
                    if (statusCode != 1){
                        clearInterval(spotCheck)
                        console.log(statusCode);
                    } 
                }
            });
        }
    });
}, 5000);//time in milliseconds 



// function submitRequest(){
//     $_SESSION['statusCode'] = 1
//     location.reload('request.php')
// };
