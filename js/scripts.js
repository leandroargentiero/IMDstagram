$(document).ready(function(){
    $('.btnFollow').click(function(){
        $.ajax({
                        type : 'POST',
                        url  : 'includes/follow.inc.php',
                        data : $(this).serialize(),
                        success : function(data)
                        {
                            console.log(data);
                            console.log("succes!")
                            $(".btnFollow").addClass(data);
                            $(".btnFollow").html("Volgend");
                        }
                    });
                    return false;
    });
    
    $('.btnUnfollow').click(function(){
        $.ajax({
                        type : 'POST',
                        url  : 'includes/unfollow.inc.php',
                        data : $(this).serialize(),
                        success : function(data)
                        {
                            console.log(data);
                            console.log("succes!")
                            $(".btnFollow").addClass(data);
                            $(".btnFollow").html("Volgen");
                        }
                    });
                    return false;
    });
});