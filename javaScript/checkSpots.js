var spotCheck = setInterval(function()
{ 
    $.ajax({
        method:"POST",
        url:"checkspots.php",
        datatype:"html",
        success:function(data){
            //do something with response data
            $("#request_status").html(data)

            $.ajax({
                method:"POST",
                url:"checkstatus.php",
                datatype:"json",
                success:function(statusCode){
                    if (statusCode == 10){
                        clearInterval(spotCheck)
                    }
                }
            });
        }
    });
}, 5000);//time in milliseconds 

function stopCheck(){
    clearInterval(spotCheck);
};
