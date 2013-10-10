<script type="text/javascript">
function setSelectionRange(input, selectionStart, selectionEnd) {
  if (input.setSelectionRange) {
    input.focus();
    input.setSelectionRange(selectionStart, selectionEnd);
  }
  else if (input.createTextRange) {
    var range = input.createTextRange();
    range.collapse(true);
    range.moveEnd('character', selectionEnd);
    range.moveStart('character', selectionStart);
    range.select();
  }
}

function replaceSelection (input, replaceString) {
	if (input.setSelectionRange) {
		var selectionStart = input.selectionStart;
		var selectionEnd = input.selectionEnd;
		input.value = input.value.substring(0, selectionStart)+ replaceString + input.value.substring(selectionEnd);
    
		if (selectionStart != selectionEnd){ 
			setSelectionRange(input, selectionStart, selectionStart + 	replaceString.length);
		}else{
			setSelectionRange(input, selectionStart + replaceString.length, selectionStart + replaceString.length);
		}

	}else if (document.selection) {
		var range = document.selection.createRange();

		if (range.parentElement() == input) {
			var isCollapsed = range.text == '';
			range.text = replaceString;

			 if (!isCollapsed)  {
				range.moveStart('character', -replaceString.length);
				range.select();
			}
		}
	}
}


// We are going to catch the TAB key so that we can use it, Hooray!
function catchTab(item,e){
	if(navigator.userAgent.match("Gecko")){
		c=e.which;
	}else{
		c=e.keyCode;
	}
	if(c==9){
		replaceSelection(item,String.fromCharCode(9));
		setTimeout("document.getElementById('"+item.id+"').focus();",0);	
		return false;
	}
		    
}
</script>

<?php
//Wall_resource
//Srinivas Tamada http://9lessons.info
//Loading Comments link with load_updates.php 
include_once 'includes/make_img_tag.php';
foreach((array)$updatesarray as $data)
{
   $msg_id=$data['msg_id'];
   $orimessage="";
   //$message=tolink(htmlentities($data['message']));
 
 $message = $data['message'];
 
 $message = str_replace("&acirc;€”","-",$message);
 $message = str_replace("&acirc;€™","'",$message);
 $message = str_replace("&acirc;€œ","'",$message);
 $message = str_replace("&acirc;€","'",$message);
 
 $message = str_replace('  ', ' &nbsp;', $message);
 $message = str_replace('	','&nbsp;&nbsp;&nbsp;&nbsp;',$message);
 $message = str_replace("\t",'&nbsp;&nbsp;&nbsp;',$message);

 
 $id = $data['activity_id'];
  
 if(strpos($message,'http://youtu.be/')===false)
   ;
 else
    $message = str_replace("youtu.be/","www.youtube.com/watch?v=",$message);
	
 $findme   = 'http://www.youtube.com/watch?v=';
 $pos = strpos($message, $findme);

 // Note our use of ===.  Simply == would not work as expected
 // because the position of 'a' was the 0th (first) character.
 if ($pos === false) {
   
   $findme = 'www.ted.com/talks';
   $pos2 = strpos($message, $findme);
   
   if($pos2 == false) {
       //$message=tolink(htmlentities($data['message']));
       //$message = make_img_tag($message);//.' '.tolink(htmlentities($data['message']));
	     // look for a jpg, gif, or png reference
  // if not found, carry on as normal
  $pos = stripos($message,".jpg") || $pos = stripos($message,".png") || $pos = stripos($message,".gif");
  if($pos === false) {
  
     $findme   = 'https://voicethread.com/share/';
     $pos = strpos($message, $findme);
	 
	 if($pos === false) 
	 {
	      $findme   = 'http://teachertube.com/viewVideo.php?video_id=';
          $pos = strpos($message, $findme);
	 
       	 if($pos === false)
		 {
	      $findme   = 'http://www.slideshare.net';
          $pos = strpos($message, $findme);
		 
		  if($pos === false)
		  {
		     $findme   = 'http://www.scribd.com/doc/';
			 $pos = strpos($message, $findme);
		     
			 		        if($pos === false) 
			                {
			                    $findme = 'http://vimeo.com';
							    $pos = strpos($message, $findme);
								
							    if($pos === false)
							    {
							       $findme = 'http://www.chatbotmaker.com/videofiles';
								   $findme2 = 'http://www.labodanglais.com/videofiles';
								   $pos = strpos($message, $findme);
								   $pos2 = strpos($message, $findme2);
								   if(($pos === false) && ($pos2 === false)) 
								   {
								      $findme = 'http://www.chatbotmaker.com/voicefiles';
									  $findme2 = 'http://www.labodanglais.com/voicefiles';
								      $pos  = strpos($message, $findme);
									  $pos2 = strpos($message, $findme2);
								      if(($pos === false) && ($pos2 === false)) 
									  {
								         //$message=tolink(htmlentities(nl2br($data['message'])));
										 $message = tolink(htmlentities(nl2br($message)));
									  }
									  else
									  {
								         $oriMesg = $message;
									     $exp = explode("http://",$message);
									     $audiobot = $exp[1];
									     //$message = str_replace("index.html","index_right_frame_only.html",$message);
                    			         //$code = '<div style="text-align: center;"><span style="font-size: large;"></span><object data="'.$message.'" height="700" width="500"> <embed src=http://www.web-source.net width="500" height="800"> </embed> </object></div>';
									     $code = '<object data="'.'http://'.$audiobot.'" height="680" width="500"></object></div>';
								         // we replace each {id} with the actual ID of the video to get embed code for this particular video
                    			         $message=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;			       
									     //$message = "<p><br>".$code;									  
									  }
								   }
								   else
								   {  //http://www.chatbotmaker.com/videofiles/07/mp4/index.html
								      $oriMesg = $message;
									  $exp = explode("http://",$message);
									  $chatbotmaker = str_replace("index.html","index_right_frame_only.html",$exp[1]);
									  //$message = str_replace("index.html","index_right_frame_only.html",$message);
                    			      //$code = '<div style="text-align: center;"><span style="font-size: large;"></span><object data="'.$message.'" height="700" width="500"> <embed src=http://www.web-source.net width="500" height="800"> </embed> </object></div>';
									  //$code = '<div style="text-align: center;"><span style="font-size: large;"></span><object data="'.'http://'.$chatbotmaker.'" height="700" width="500"> <embed src=http://www.web-source.net width="500" height="800"> </embed> </object></div>';
									  $code = '<object data="'.'http://'.$chatbotmaker.'" height="700" width="500"></object>';
								      // we replace each {id} with the actual ID of the video to get embed code for this particular video
                    			      $message=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;			       
									  //$message = "<p><br>".$code;
								   }
								}
								else 
								{
								    $oriMesg = $message;                                
									$message = str_replace("vimeo.com/","www.youtube.com/watch?v=",$message);
					                $arr = explode("http://www.youtube.com", $message, 2);
                                    $first = $arr[0];
			                        $url = $message;
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
                                    $code = '<iframe src="http://player.vimeo.com/video/{id}" width="400" height="233" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                                    // we replace each {id} with the actual ID of the video to get embed code for this particular video
                                    $code = str_replace('{id}', $codeid, $code);
									$message=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;
								}
			                }
			 else {
                   $oriMesg = $message;
                    $message = str_replace("http://www.scribd.com/doc/","www.youtube.com/watch?v=",$message);
					$arr = explode("http://www.youtube.com", $message, 2);
                    $first = $arr[0];
			        $url = $message;
                    $codeid=0;
                    // we get the unique video id from the url by matching the pattern
                    preg_match("/v=([^&]+)/i", $url, $matches);
                    if(isset($matches[1])) $codeid = $matches[1];
                    if(!$id) {
                       $matches = explode('/', $url);
                       $codeid = $matches[count($matches)-1];
                    }
                    // this is your template for generating embed codes
                    $code = '<a href="http://www.scribd.com/doc/{id}" style="margin: 12px auto 6px auto; font-family: Helvetica,Arial,Sans-serif; font-style: normal; font-variant: normal; font-weight: normal; font-size: 14px; line-height: normal; font-size-adjust: none; font-stretch: normal; -x-system-font: none; display: block; text-decoration: underline;"></a><iframe class="scribd_iframe_embed" src="http://www.scribd.com/embeds/{id}/content?start_page=1&view_mode=scroll" data-auto-height="true" data-aspect-ratio="" scrolling="no" width="100%" height="600" frameborder="0"></iframe>';
                    // we replace each {id} with the actual ID of the video to get embed code for this particular video
                    $code = str_replace('{id}', $codeid, $code);
	                $message=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;       
			 }
		  }
		  else {
                    $oriMesg = $message;
                    $message = str_replace("http://www.slideshare.net/","www.youtube.com/watch?v=",$message);
			        $arr = explode("http://www.youtube.com", $message, 2);
                    $first = $arr[0];
			        $url = $message;
                    $codeid=0;
                    // we get the unique video id from the url by matching the pattern
                    preg_match("/v=([^&]+)/i", $url, $matches);
                    if(isset($matches[1])) $codeid = $matches[1];
                    if(!$id) {
                       $matches = explode('/', $url);
                       $codeid = $matches[count($matches)-1];
                    }
                    // this is your template for generating embed codes
                    $code = '<iframe src="http://www.slideshare.net/slideshow/embed_code/{id}" width="427" height="356" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:1px solid #CCC;border-width:1px 1px 0;margin-bottom:5px" allowfullscreen> </iframe> ';
                    // we replace each {id} with the actual ID of the video to get embed code for this particular video
                    $code = str_replace('{id}', $codeid, $code);
	                $message=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;
		  }
		 }	
	     else {
		            /* Embed a TeacherTube video! */
					$oriMesg = $message;  
		 			$message = str_replace("teachertube.com/viewVideo.php?video_id=","www.youtube.com/watch?v=",$message);
			        $arr = explode("http://www.youtube.com", $message, 2);
                    $first = $arr[0];
			        $url = $message;
                    $codeid=0;
                    // we get the unique video id from the url by matching the pattern
                    preg_match("/v=([^&]+)/i", $url, $matches);
                    if(isset($matches[1])) $codeid = $matches[1];
                    if(!$id) {
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
	                $message=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;
		         }
		}
		 
	 else {
	        /* Embed a Voicethread! */
			$oriMesg = $message;  
	        /* Voicethread! */
			//Check if the final character of the URL is a frontslash. If yes, nuke it!

			if (substr($message, -1) == '/')
			{
			   $message = rtrim($message,'/');
			   //$message = preg_replace('{/$}', '', $message);
			}
			
			$message = str_replace("voicethread.com/share/","www.youtube.com/watch?v=",$message);
			$arr = explode("http://www.youtube.com", $message, 2);
            $first = $arr[0];
			$url = $message;
            $codeid=0;
            // we get the unique video id from the url by matching the pattern
            preg_match("/v=([^&]+)/i", $url, $matches);
            if(isset($matches[1])) $codeid = $matches[1];
            if(!$id) {
               $matches = explode('/', $url);
               $codeid = $matches[count($matches)-1];
            }
            // this is your template for generating embed codes
            $code = '<object width="480" height="360"><param name="movie" value="https://voicethread.com/book.swf?b={id}"></param><param name="wmode" value="transparent"></param><embed src="https://voicethread.com/book.swf?b={id}" type="application/x-shockwave-flash" wmode="transparent" width="480" height="360"></embed></object>';
            // we replace each {id} with the actual ID of the video to get embed code for this particular video
            $code = str_replace('{id}', $codeid, $code);
	        $message=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;
	 }
  
  } 
else 
{
  /* Embed an image! */
  $beg=stripos($message,"http://"); 
  if($beg===false) $beg=stripos($message,"www.");
  if($beg===false) $beg=stripos($message,"ftp.");
  if($beg !== false)
  {
     $imgsrc='$beg='.$beg;
     $end = stripos($message,".jpg");
     if($end ===false) $end = stripos($message,".gif");
     if($end ===false) $end=stripos($message,".png");
     if($end !== false)
     {       
       $imgsrc=substr($message,$beg,$end-$beg+4);
     }
  }
  $width=300;
  $target = " onclick=\"window.open(this.href,\\'_blank\\');return false;\"";
  //$message = preg_replace("#(^|[\n \]])([\w]+?://[\w\#$%&~/.\-;:=,?@+]*)#ise", "'<a href=\"".$imgsrc."\" ".$target."><img src=\"\\2\" $width=\"".$width."\"></img>'", $comment);
  $message = preg_replace("#(^|[\n \]])([\w]+?://[\w\#$%&~/.\-;:=,?@+]*)#ise", "'\\1<insertimage><P><center><a href=\'".$imgsrc."\'".$target."><img src=\'\\2\' width=\'".$width."\'></img></a></center></insertimage>'", $message);
  $message = nl2br($message);
}

   } else {
            /* Embed a TED.com video! */
			$oriMesg = $message;  
            $arr = explode("http://www.ted.com", $message, 2);
            $first = $arr[0];
			//echo $first;   
            $url = $message;
            $urlid = basename($url);
			// this is your template for generating embed codes, 480-340 360-220
            $code = '<div id="img_wrapper">
			<iframe src="http://embed.ted.com/talks/{id}" width="440" height="220" frameborder="0" scrolling="no" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			</div>';
	        //$code=$id;
            // we replace each {id} with the actual ID of the video to get embed code for this particular video
            $code = str_replace('{id}', $urlid, $code);
	        //$message=$first."<p><br>".$code;
			$message=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;
   }
 } else {
           $oriMesg = $message;  
           /* Embed a Youtube video! */
           $arr = explode("http://www.youtube.com", $message, 2);
           $first = $arr[0];
           //echo $first;   

           $url = $message;
           $codeid=0;
            // we get the unique video id from the url by matching the pattern
            preg_match("/v=([^&]+)/i", $url, $matches);
            if(isset($matches[1])) $codeid = $matches[1];
            if(!$id) {
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
	        //$message=$first."<p><br>".$code;
	        $message=tolink(htmlentities(nl2br($oriMesg)))."<p><br>".$code;
        }
 
 $time=$data['created'];
 //$username=$data['username'];
 $username=$data['firstname'].' '.$data['lastname'];
 $uid=$data['uid_fk'];
 //$face=$Wall->Gravatar($uid);
 //$face="http://www.moodurian.com/user/pix.php/".$uid."/f2.jpg";
 $commentsarray=$Wall->Comments($msg_id, $uid);
?>

<script type="text/javascript"> 
$(document).ready(function(){$("#stexpand<?php echo $msg_id;?>").oembed("<?php echo $message; ?>",{maxWidth: 400, maxHeight: 300});});
</script>
<div class="stbody" id="stbody<?php echo $msg_id;?>">

<div class="stimg">
<?php 
 $ustring = "select * from mdl_m22_user where id = ".$uid;
 $user = $DB->get_record_sql($ustring);
 $cface = $OUTPUT->user_picture($user, array('size'=>50));
echo $cface; 
?>
</div> 
<div class="sttext">
<a class="stdelete" href="#" id="<?php echo $msg_id; ?>" title="Delete update">
<?php 
    $admins = get_admins();
    $isadmin = false;
    foreach ($admins as $admin) {
        if ($USER->id == $admin->id) {
            $isadmin = true;
            break;
        }
    }

     if(($uid==$USER->id) || ($isadmin == true))
      //if($uid==$USER->id) 
         //echo "X"; 
		 echo '<img width="14" style="border:none;" src="trash.png" class="shakeimage" onMouseover="init(this);rattleimage()" onMouseout="stoprattle(this);top.focus()" onClick="top.focus()">';
      else 
	     echo "";
?></a>

<?php echo '<b><a target="_blank" href="../user/view.php?id='.$uid.'&course='.$wcid.'">'.$username.'</a></b>'.' '.$message;?> <!-- $username -->
<div class="sttime"><?php time_stamp($time);?> <a href='#' class='commentopen' id='<?php echo $msg_id;?>' title='Comment'>Comment </a></div> 

<div id="stexpandbox">
<div id="stexpand<?php echo $msg_id;?>"></div>
</div>

<div class="commentcontainer" id="commentload<?php echo $msg_id;?>">


<?php include('load_comments.php') ?>

</div>
<div class="commentupdate" style='display:none' id='commentbox<?php echo $msg_id;?>'>
<div class="stcommentimg">
<?php 
 //$ustring = "select * from mdl_m22_user where id = ".$uid;
 $ustring = "select * from mdl_m22_user where id = ".$USER->id;
 $user = $DB->get_record_sql($ustring);
 $cface = $OUTPUT->user_picture($user, array('size'=>36));
echo $cface; 
?>
</div> 
<div class="stcommenttext" >
<form method="post" action="">

<textarea name="comment" class="comment" maxlength="2000"  id="ctextarea<?php echo $msg_id;?>"></textarea>
<br />
<input type="submit"  value=" Comment "  id="<?php echo $msg_id;?>" class="comment_button"/>
</form>


</div>
</div>


</div> 

</div>
<?php
}
?>


