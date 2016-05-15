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

    function commentInsert(){

        var t ='';

        t += '<li class="commentFeed-items" id="_1">';
        t += '<span class="comment-username">Insert User</span>';
        t += '<span class="comment-text">New Comment</span>';
        t += '</li>';

        $('.commentFeed-holder').append(t);
    }

   $('#comment-btn-submit').click( function(){
       var _comment = $('#commentField').val();
       var _userID = $("#userID").val();
       var _userName = $("#userName").val();


       if (_comment.length > 0 && _userID != null){
           console.log(_comment + " Username " + _userName + " userID " + _userID);


           $.ajax({
               type: 'POST',
               url: 'includes/comment_insert.php',
               data: $(this).serialize(),
               succes: function(data)
               {
                   commentInsert();
               }

           })


       }


       var _comment = $('#commentField').val("");
       return false;

   });



});





