<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Creating Popup Div | istockphp.com</title>
<link href="style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"> </script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript">
(function($){
    $.fn.extend({
        center: function () {
            return this.each(function() {
                var top = ($(window).height() - $(this).outerHeight()) / 2;
                var left = ($(window).width() - $(this).outerWidth()) / 2;
                $(this).css({position:'absolute', margin:0, top: (top > 0 ? top : 0)+'px', left: (left > 0 ? left : 0)+'px'});
            });
        }
    }); 
})(jQuery);
/*

*/

</script>
<style type="text/css">
.center{
    position: absolute;
    height: 50px;
    width: 50px;
    background:red;
    top:calc(50% - 50px/2);
    left:calc(50% - 50px/2);
}
</style>
</head>

<body>
	<a href="#" class="topopup">Click Here Trigger</a>


    <div id="toPopup" class="center"  style="background-color: #EDEFF1; height:300px;width:600px; -moz-border-radius-bottomright: 15px; border-bottom-right-radius: 15px; -moz-border-radius-bottomleft: 15px; moz-border-radius-topleft: 15px;moz-border-radius-topright: 15px; border-bottom-left-radius: 15px; ">

        <div class="close"></div>
       	<span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
		<div id="popup_content"> <!--your content start-->
        
            <?php

            function make_bitly_url($url, $login, $appkey, $format='xml', $history=1, $version='2.0.1')
            {
            //create the URL
            $bitly = 'http://api.bit.ly/shorten';
            $param = 'version='.$version.'&longUrl='.urlencode($url).'&login='
            .$login.'&apiKey='.$appkey.'&format='.$format.'&history='.$history;

            //get the url
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $bitly . "?" . $param);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);

            //parse depending on desired format
            if(strtolower($format) == 'json') {
            $json = @json_decode($response,true);
            return $json['results'][$url]['shortUrl'];
            } else {
            $xml = simplexml_load_string($response);
            return 'http://bit.ly/'.$xml->results->nodeKeyVal->hash;
            }
            }
            /* usage */
            $short = make_bitly_url('http://ec2-54-226-21-153.compute-1.amazonaws.com','karimkhan123','R_fcc6891d46e315a3e9610dbc88eb13ee','json');
            echo 'The short URL is:  '.$short;


            ?>
            
            <textarea style="height:65px;width:400px;">
            </textarea> <br>
            <?php echo 'The short URL is:  '.$short; ?>
            <input type="checkbox"> - Facebook <hr>
            <input type="checkbox"> - Twitter  <hr>
            <input type="checkbox"> - Linked In  <hr>
            </br></br>
            
        </div> <!--your content end-->

    </div> <!--toPopup end-->
    <!-- <script src="//platform.linkedin.com/in.js" type="text/javascript">
             lang: en_US
            </script>
            <script type="IN/Share" data-url="http://dev01.dev/" data-counter="right"></script>
            <hr>
        
             <a href="https://twitter.com/share" class="twitter-share-button" data-via="ThenWat" data-size="large" data-related="Karimkhan">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            <hr>
            
            <div style="float:left;padding:4px;">
            <a expr:share_url='data:post.url' name='fb_share' rel='nofollow' type='button_count'>Share</a>
            <script type="text/javascript" src="http://static.ak.fbcdn.net/connect.php/js/FB.Share"/> </script>
            </div> -->
</br>
                   

<script type="text/javascript" src="socialite.js"></script>
</body>
</html>
