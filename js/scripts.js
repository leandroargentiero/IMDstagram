$(document).ready(function(){
    init();
    $('.btnEditProfile').click(function(){
        console.log('click');
        window.location.href='editProfile.php';
    });
    function init(){
        $('.btnFollow').click(function(){
            $.ajax({
                            type : 'POST',
                            url  : 'includes/follow.inc.php',
                            data : $(this).serialize(),
                            success : function(data)
                            {
                                console.log(data);
                                console.log("succes!");
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
                                console.log("succes!");
                                $(".btnUnfollow").attr("class", "btnFollow");
                                $(".btnFollow").html("Volgen");
                                init();
                            }
            });
            return false;
        });
        $('.openbaar').click(function(){
            $.ajax({
                            type : 'POST',
                            url  : 'includes/private.inc.php',
                            data : $(this).serialize(),
                            success : function(data)
                            {
                                $(".openbaar").attr("class", data);
                                $(".private").html("Privé");
                                init();
                            }
            });
            return false;
        });
        
        $('.private').click(function(){
            $.ajax({
                            type : 'POST',
                            url  : 'includes/openbaar.inc.php',
                            data : $(this).serialize(),
                            success : function(data)
                            {
                                $(".private").attr("class", data);
                                $(".openbaar").html("Openbaar");
                                init();
                            }
            });
            return false;
        });

        $('.btnLike').click(function(){
            $.ajax({
                type: 'POST',
                url: 'includes/like.inc.php',
                data: $(this).serialize(),
                success: function(data)
                {
                    console.log(data);
                    $(".btnLike").attr("class", "btnUnlike");
                    $("#heart").attr("src", "images/heart_filled.png");
                    init();
                }
            });
            return false;
        });

        $('.btnUnlike').click(function(){
            $.ajax({
                type: 'POST',
                url: 'includes/unlike.inc.php',
                data: $(this).serialize(),
                success: function(data)
                {
                    console.log(data);
                    $(".btnUnlike").attr("class", "btnLike");
                    $("#heart").attr("src", "images/heart_blank.png");
                    init();
                }
            });
            return false;
        });
    }
    $('.btnLoadMore').click(function(){
    for(i=0; i<20;i++){
        $.ajax({
                        
                        type : 'POST',
                        url  : 'includes/loadmore.inc.php',
                        data : $(this).serialize(),
                        success : function(data)
                        {
                            console.log(data);
    $('.indexFeed').append("<div class='feedPic'><img src='"+data+"' alt=''></div");

                            
                            
                        
                        }
                    });}
                    return false;
    
    });
    
    $('.glyphicon-trash').click(function(){
            $.ajax({
                type: 'POST',
                url: 'includes/deletePost.inc.php',
                data: $(this).serialize(),
                success: function(data)
                {
                    window.location.href='index.php'; 
                }
            });
        });
});