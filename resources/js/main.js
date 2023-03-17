var url= 'http://web.com.devel';
window.addEventListener("load", function () {

    
        $('.btn-like').css('cursor', 'pointer');
        $('.btn-dislike').css('cursor', 'pointer');
        
        function  like() {
            $('.btn-like').unbind('click').click(function () {

                $(this).addClass('btn-dislike').removeClass('btn-like');
                $(this).attr('src', url+'/img/redHeart.png');


                $.ajax({
                    url: url+ '/like/add/' +$(this).data('id'),
                    type:'GET',
                    success: function(response){   
                            console.log("You liked the post"); 
                            console.log(response);
                    }

                });

                dislike();

            });
        }

        like();

        function dislike() {
            $('.btn-dislike').unbind('click').click(function () {
                $(this).addClass('btn-like').removeClass('btn-dislike');
                $(this).attr('src', url+'/img/blackHeart.png');

                $.ajax({
                    url: url+ '/like/delete/' +$(this).data('id'),
                    type:'GET',
                    success: function(response){

                            console.log("You removed the like ");

                    }

                });

                like();
            });
        }
        dislike();

        //BUSCADOR

        $('#searcher').submit(function(){
            $(this).attr('action',url+'/user/all/' + $('#searcher #search').val());
        });
});
