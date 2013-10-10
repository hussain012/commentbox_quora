<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Creating Popup Div | istockphp.com</title>
<link href="style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"> </script>
<script type="text/javascript" src="script.js"></script>

<style type="text/css">
.center{
    position: absolute;
    height: 50px;
    width: 50px;
    background:red;
    margin: auto;
  bottom: 0;
  left: 0;
  top: 0;
  right: 0;
}
</style>
</head>
<body>
    <a href="#" class="topopup">Click Here Trigger</a>


    <div id="toPopup" class="center"  style="background-color: #EDEFF1; height:300px;width:500px; -moz-border-radius-bottomright: 15px; border-bottom-right-radius: 15px; -moz-border-radius-bottomleft: 15px; moz-border-radius-topleft: 15px;moz-border-radius-topright: 15px; border-bottom-left-radius: 15px; ">

        <div class="close"></div>
        <span class="ecs_tooltip">Press Esc to close <span class="arrow"></span></span>
        <div id="popup_content"> <!--your content start-->
        <p><b>Share post </b></p>
            <textarea style="height:65px;width:400px;"></textarea> <br>         
            <input type="checkbox"> - Facebook <hr>
            <input type="checkbox"> - Twitter  <hr>
            <input type="checkbox"> - Linked in <hr>
            </br></br>                
        </div> <!--your content end-->    
    </div> 
</body>
</html>