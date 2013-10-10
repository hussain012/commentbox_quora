 <?php
//Wall Res
//Srinivas Tamada http://9lessons.info
//Load latest comment 
error_reporting(0);
include_once 'includes/db.php';
include_once 'includes/functions.php';
include_once 'includes/tolink.php';
include_once 'includes/time_stamp.php';
include_once 'session.php';
$wcid = (int) $_GET['CID'];
//echo "Comment:wcid is ".$wcid; 
$id = (int) $_GET['Id'];
$Wall = new Wall_Updates($wcid);
if(isSet($_POST['comment']))
{
//$comment=$_POST['comment'];
$comment=addslashes($_POST['comment']);
$msg_id=$_POST['msg_id'];
$ip=$_SERVER['REMOTE_ADDR'];
$cdata=$Wall->Insert_Comment($wcid, $uid,$msg_id, $id, $comment);
if($cdata)
{
$com_id=$cdata['com_id'];
 //$comment=tolink(htmlentities($cdata['comment'] ));
 
 //Frankie
    
	$comment = str_replace('  ', ' &nbsp;', $comment);
    $comment = str_replace('	','&nbsp;&nbsp;&nbsp;&nbsp;',$comment);
    $comment = str_replace("\t",'&nbsp;&nbsp;&nbsp;',$comment);

    if(strpos($comment,'http://youtu.be/')===false)
     ;
    else
       $comment = str_replace("youtu.be/","www.youtube.com/watch?v=",$comment);
	
    $findme   = 'http://www.youtube.com/watch?v=';
    $pos = strpos($comment, $findme);
    if ($pos === false) 
	{
        $findme = 'www.ted.com/talks';
        $pos = strpos($comment, $findme);
        if($pos === false) 
		{
            //$comment=tolink(htmlentities($data['message']));
            //$comment = make_img_tag($comment);//.' '.tolink(htmlentities($data['message']));
	        // look for a jpg, gif, or png reference
            // if not found, carry on as normal
            $pos = stripos($comment,".jpg") || $pos = stripos($comment,".png") || $pos = stripos($comment,".gif");
            if($pos === false) 
		    {
                $findme   = 'https://voicethread.com/share/';
                $pos = strpos($comment, $findme);
	            if($pos === false) 
	            {
	                $findme   = 'http://teachertube.com/viewVideo.php?video_id=';
                    $pos = strpos($comment, $findme);
	        	    if($pos === false)
		            {
	                    $findme   = 'http://www.slideshare.net';
                        $pos = strpos($comment, $findme);
		 		        if($pos === false)
		                {
		                    $findme   = 'http://www.scribd.com/doc/';
			                $pos = strpos($comment, $findme);
		                    if($pos === false) 
			                {
			                    $findme = 'http://vimeo.com';
							    $pos = strpos($comment, $findme);
							    if($pos === false)
							    {
							       //$comment=tolink(htmlentities(nl2br($cdata['comment'])));
								   $comment = tolink(htmlentities(nl2br($comment)));
							    }
								else 
								{
								    $oriMesg = $comment;                                
									$comment = str_replace("vimeo.com/","www.youtube.com/watch?v=",$comment);
					                $arr = explode("http://www.youtube.com", $comment, 2);
                                    $first = $arr[0];
			                        $url = $comment;
                                    $codeid=0;
                                    // we get the unique video id from the url by matching the pattern
                                    preg_match("/v=([^&]+)/i", $url, $matches);
                                    if(isset($matches[1])) $codeid = $matches[1];
                                    if(!$id) 
							        {
                                       $matches = explode('/', $url);
                                       $codeid = $matches[count($matches)-1];
                                    }
                                    // this is your template for generating embed codes
                                    $code = '<iframe src="http://player.vimeo.com/video/{id}" width="300" height="133" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                                    // we replace each {id} with the actual ID of the video to get embed code for this particular video
                                    $code = str_replace('{id}', $codeid, $code);
									$comment=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;
								}
			                }
			                else  
					        {
                                $oriMesg = $comment;
                                $comment = str_replace("http://www.scribd.com/doc/","www.youtube.com/watch?v=",$comment);
					            $arr = explode("http://www.youtube.com", $comment, 2);
                                $first = $arr[0];
			                    $url = $comment;
                                $codeid=0;
                                // we get the unique video id from the url by matching the pattern
                                preg_match("/v=([^&]+)/i", $url, $matches);
                                if(isset($matches[1])) $codeid = $matches[1];
                                if(!$id) 
							    {
                                   $matches = explode('/', $url);
                                   $codeid = $matches[count($matches)-1];
                                }
                                // this is your template for generating embed codes
                                $code = '<a href="http://www.scribd.com/doc/{id}" style="margin: 12px auto 6px auto; font-family: Helvetica,Arial,Sans-serif; font-style: normal; font-variant: normal; font-weight: normal; font-size: 14px; line-height: normal; font-size-adjust: none; font-stretch: normal; -x-system-font: none; display: block; text-decoration: underline;"></a><iframe class="scribd_iframe_embed" src="http://www.scribd.com/embeds/{id}/content?start_page=1&view_mode=scroll" data-auto-height="true" data-aspect-ratio="" scrolling="no" width="100%" height="600" frameborder="0"></iframe>';
                                // we replace each {id} with the actual ID of the video to get embed code for this particular video
                                $code = str_replace('{id}', $codeid, $code);
	                            $comment=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;       
			                }
		                } else  {
                                    $oriMesg = $comment;
                                    $comment = str_replace("http://www.slideshare.net/","www.youtube.com/watch?v=",$comment);
			                        $arr = explode("http://www.youtube.com", $comment, 2);
                                    $first = $arr[0];
			                        $url = $comment;
                                    $codeid=0;
                                    // we get the unique video id from the url by matching the pattern
                                    preg_match("/v=([^&]+)/i", $url, $matches);
                                    if(isset($matches[1])) $codeid = $matches[1];
                                    if(!$id) 
						            {
                                      $matches = explode('/', $url);
                                      $codeid = $matches[count($matches)-1];
                                    }
                                    // this is your template for generating embed codes
                                    $code = '<iframe src="http://www.slideshare.net/slideshow/embed_code/{id}" width="427" height="356" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:1px solid #CCC;border-width:1px 1px 0;margin-bottom:5px" allowfullscreen> </iframe> ';
                                    // we replace each {id} with the actual ID of the video to get embed code for this particular video
                                    $code = str_replace('{id}', $codeid, $code);
	                                $comment=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;
		                        }
		            } else  {
		                        /* Embed a TeacherTube video! */
								$oriMesg = $comment;                                
		 			            $comment = str_replace("teachertube.com/viewVideo.php?video_id=","www.youtube.com/watch?v=",$comment);
			                    $arr = explode("http://www.youtube.com", $comment, 2);
                                $first = $arr[0];
			                    $url = $comment;
                                $codeid=0;
                                // we get the unique video id from the url by matching the pattern
                                preg_match("/v=([^&]+)/i", $url, $matches);
                                if(isset($matches[1])) $codeid = $matches[1];
                                if(!$id) 
								{
                                   $matches = explode('/', $url);
                                   $codeid = $matches[count($matches)-1];
								   $codeid = str_replace("watch?v=","",$codeid);
                                }
                                // this is your template for generating embed codes
                                $code = '<embed flashvars="file=http://teachertube.com/embedFLV.php?pg=video_{id}"
                                            allowfullscreen="true"
                                            allowscriptaccess="always"
                                            id="player1"
                                            name="player1"
                                            src="http://teachertube.com/embed/player.swf"
                                            width="480"
                                            height="270"
                                          />  ';
                                // we replace each {id} with the actual ID of the video to get embed code for this particular video
                                $code = str_replace('{id}', $codeid, $code);
	                            $comment=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;
		                    }
		        } else  {
	                        /* Embed a Voicethread! */
			                $orimesg = $comment;
	                        /* Voicethread! */
			                //Check if the final character of the URL is a frontslash. If yes, nuke it!
			                if (substr($comment, -1) == '/')
			                {
			                   $comment = rtrim($comment,'/');
			                   //$comment = preg_replace('{/$}', '', $comment);
			                }
			                $comment = str_replace("voicethread.com/share/","www.youtube.com/watch?v=",$comment);
			                $arr = explode("http://www.youtube.com", $comment, 2);
                            $first = $arr[0];
			                $url = $comment;
                            $codeid=0;
                            // we get the unique video id from the url by matching the pattern
                            preg_match("/v=([^&]+)/i", $url, $matches);
                            if(isset($matches[1])) $codeid = $matches[1];
                            if(!$id) 
							{
                               $matches = explode('/', $url);
                               $codeid = $matches[count($matches)-1];
                            }
                            // this is your template for generating embed codes
                            $code = '<object width="480" height="360"><param name="movie" value="https://voicethread.com/book.swf?b={id}"></param><param name="wmode" value="transparent"></param><embed src="https://voicethread.com/book.swf?b={id}" type="application/x-shockwave-flash" wmode="transparent" width="480" height="360"></embed></object>';
                            // we replace each {id} with the actual ID of the video to get embed code for this particular video
                            $code = str_replace('{id}', $codeid, $code);
	                        $comment=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;
	                    }
  
            } else  {
                        /* Embed an image! */
						$beg=stripos($comment,"http://"); 
                        if($beg===false) $beg=stripos($comment,"www.");
                        if($beg===false) $beg=stripos($comment,"ftp.");
                        if($beg !== false)
                        {
                            $imgsrc='$beg='.$beg;
                            $end = stripos($comment,".jpg");
                            if($end ===false) $end = stripos($comment,".gif");
                            if($end ===false) $end=stripos($comment,".png");
                            if($end !== false)
                            {       
                                $imgsrc=substr($comment,$beg,$end-$beg+4);
                            }
                        }
                        $width=300;
                        $target = " onclick=\"window.open(this.href,\\'_blank\\');return false;\"";
                        //$comment = preg_replace("#(^|[\n \]])([\w]+?://[\w\#$%&~/.\-;:=,?@+]*)#ise", "'<a href=\"".$imgsrc."\" ".$target."><img src=\"\\2\" $width=\"".$width."\"></img>'", $comment);
                        $comment = preg_replace("#(^|[\n \]])([\w]+?://[\w\#$%&~/.\-;:=,?@+]*)#ise", "'\\1<insertimage><P><center><a href=\'".$imgsrc."\'".$target."><img src=\'\\2\' width=\'".$width."\'></img></a></center></insertimage>'", $comment);
						$comment = nl2br($comment);
                    }
        } else  {
                    /* Embed a TED.com video! */
					$oriMesg = $comment;                                
                    $arr = explode("http://www.ted.com", $comment, 2);
                    $first = $arr[0];
			        //echo $first;   
                    $url = $comment;
                    $urlid = basename($url);
			        // this is your template for generating embed codes, 480-340 360-220
                    $code = '<div id="img_wrapper">
			        <iframe src="http://embed.ted.com/talks/{id}" width="440" height="220" frameborder="0" scrolling="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			        </div>';
	                //$code=$id;
                    // we replace each {id} with the actual ID of the video to get embed code for this particular video
                    $code = str_replace('{id}', $urlid, $code);
	                //$comment=$first."<p><br>".$code;
			        $comment=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;
                }
    } else  {
                /* Embed a Youtube video! */
				$oriMesg = $comment;                                
                $arr = explode("http://www.youtube.com", $comment, 2);
                $first = $arr[0];
                $url = $comment;
                $codeid=0;
                // we get the unique video id from the url by matching the pattern
                preg_match("/v=([^&]+)/i", $url, $matches);
                if(isset($matches[1])) $codeid = $matches[1];
                if(!$id) 
				{
                    $matches = explode('/', $url);
                    $codeid = $matches[count($matches)-1];
                }
                // this is your template for generating embed codes
                //$code = '<div id="img_wrapper"><object width="480" height="340"><param name="movie" value="http://www.youtube.com/v/{id}&hl=en_US&fs=1&"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/{id}&hl=en_US&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="320" height="259"></embed></object></div>';
                $code = '<div id="img_wrapper">
	            <iframe class="youtube-player" type="text/html" width="440" height="220" src="http://www.youtube.com/embed/{id}" frameborder="0">
                </iframe></div>';
                // we replace each {id} with the actual ID of the video to get embed code for this particular video
                $code = str_replace('{id}', $codeid, $code);
	            //$code = "";
	            //$comment=$first."<p><br>".$code;
	            $comment=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;
            }            
 
 //Frankie-end
 
 
 $time=$cdata['created'];
 //$username=$cdata['username'];
 $username=$USER->firstname.' '.$USER->lastname;
 $uid=$cdata['uid_fk'];
 //$cface=$Wall->Gravatar($uid);
 //$cface="http://www.moodurian.com/user/pix.php/".$USER->id."/f2.jpg";
 ?>
<div class="stcommentbody" id="stcommentbody<?php echo $com_id; ?>">

<div class="stcommentimg">
<?php 
 $ustring = "select * from mdl_m22_user where id = ".$uid;
 $user = $DB->get_record_sql($ustring);
 $cface = $OUTPUT->user_picture($user, array('size'=>36));
echo $cface; 
?>
</div> 
<div class="stcommenttext">
<a class="stcommentdelete" href="#" id='<?php echo $com_id; ?>'><img width="12" style="border:none;" src="trash.png" class="shakeimage" onMouseover="init(this);rattleimage()" onMouseout="stoprattle(this);top.focus()" onClick="top.focus()"></a>
<!--<b>< ? php echo $username; ?></b> < ? php echo $comment; ? >--> <!-- $username -->
<?php echo '<a target="_blank" href="../user/view.php?id='.$uid.'&course='.$wcid.'">'.$username.'</a>'.' '.stripslashes($comment);?> <!-- $username -->
<div class="stcommenttime"><?php time_stamp($time); ?></div> 
</div>
</div>
<?php
}
}
?>
