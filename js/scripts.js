$(document).ready(function(){
    init();
    function init(){
    $('.btnFollow').click(function(){
        $.ajax({
                        type : 'POST',
                        url  : 'includes/follow.inc.php',
                        data : $(this).serialize(),
                        success : function(data)
                        {
                            console.log(data);
                            console.log("succes!")
                            $(".btnFollow").attr("class", "btnUnfollow");
                            $(".btnUnfollow").html("Volgend");
                            init();
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
                            $(".btnUnfollow").attr("class", "btnFollow");
                            $(".btnFollow").html("Volgen");
                            init();
                        }
                    });
                    return false;
    });
};

});