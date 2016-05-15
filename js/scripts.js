$(document).ready(function(){
    init();
    $('.btnEditProfile').click(function(){
        console.log('click');
        window.location.href='editProfile.php';
    });
    $('.glyphicon-bell').click(function(){
        window.location.href='notifications.php';
    });
    function init(){
        $('.glyphicon-ok').click(function(){
            console.log('click');
            var requestUserID = $(this).attr("value");
            $.ajax({
                            type : 'POST',
                            url  : 'includes/acceptFollow.inc.php',
                            data : {aanvraag: requestUserID},
                            success : function(data)
                            {
                                
                            }
            });
            $(this).parent().hide();
            return false;
        });
         $('.glyphicon-remove').click(function(){
             console.log('click');
             /*
            $.ajax({
                            type : 'POST',
                            url  : 'includes/follow.inc.php',
                            data : $(this).serialize(),
                            success : function(data)
                            {
                                console.log(data);
                                init();
                            }
            });
            */
            return false;
        });
        
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
        
        $('.btnFollowPrivate').click(function(){
            $.ajax({
                            type : 'POST',
                            url  : 'includes/followPrivate.inc.php',
                            data : $(this).serialize(),
                            success : function(data)
                            {
                                console.log(data);
                                console.log("succes!");
                                $(".btnFollowPrivate").html("Aangevraagd");
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
        
         $('.btnPrivateRequested').click(function(){
            $.ajax({
                            type : 'POST',
                            url  : 'includes/cancelRequest.inc.php',
                            data : $(this).serialize(),
                            success : function(data)
                            {
                                console.log(data);
                                console.log("succes!");
                                $(".btnPrivateRequested").attr("class", "btnFollowPrivate");
                                $(".btnFollowPrivate").html("Volgen");
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
                                $("#privacySetting").html("Privé");
                                $("#privacyUitleg").html("Dit wil zeggen dat je posts onzichtbaar zijn, behalve voor mensen die jij goedkeurt.");
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
                                $("#privacySetting").html("Openbaar");
                                $("#privacyUitleg").html("Dit wil zeggen dat je posts zichtbaar zijn voor iedereen die je account kan vinden.")
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










    $('.likeHeart').on('click', function(){
        console.log('clicked');

        var imageID = $(this).attr("value");

        if($(this).is('.btnLike')){
            console.log('liked');
            $.ajax({
                type: 'POST',
                url: 'includes/like.inc.php',
                data: {nieuweLike: imageID},
                success: function(data)
                {
                    console.log(data);
                }
            });
            $(this).attr("src", "images/heart_filled.png");
            $(this).attr("class", "likeHeart btnUnlike");
            return false;
        }
        else
        {
            console.log('unliked');
            $.ajax({
                type: 'POST',
                url: 'includes/unlike.inc.php',
                data: {nieuweLike: imageID},
                success: function(data)
                {
                    console.log(data);
                }
            });
            $(this).attr("src", "images/heart_blank.png");
            $(this).attr("class", "likeHeart btnlike");
            return false;
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#uploadPreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#fileUpload").change(function(){
        readURL(this);
        $( "#figureUploadPreview" ).slideDown( "slow" );
        $( "#dropdownFilters" ).slideDown( "slow" );
        $( "#dropdownFiltersLabel" ).slideDown( "slow" );
    });
    $('#dropdownFilters').change(function(){
        var selectedValue = $('#dropdownFilters option:selected').val();
        $('#figureUploadPreview').attr("class", selectedValue);
    });
});

