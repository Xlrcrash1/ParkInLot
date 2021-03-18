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

function stopCheck(){
    clearInterval(spotCheck);
};

// function submitRequest(){
//     $_SESSION['statusCode'] = 1
//     location.reload('request.php')
// };
