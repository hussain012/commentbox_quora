<html>
   <head>
    <html xmlns:fb="http://ogp.me/ns/fb#">
      <title>ThenWat</title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
    <meta content="utf-8" http-equiv="encoding" />
     <link href="content/rateit.css" rel="stylesheet" type="text/css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    </script>
  <link rel="stylesheet" class="cssStatics" type="text/css" href="css/stylesheet.css" />
        <link rel="stylesheet" class="cssButtons" type="text/css" href="css/linkPreview.css" />
        <script type="text/javascript" src="js/jquery.js" ></script>
        <script type="text/javascript" src="js/linkPreview.js" ></script>
        <script>
            $(document).ready(function() {
                $('.linkPreview').linkPreview();
                // setting max number of images $('.linkPreview').linkPreview({imageQuantity: "put here the number"});
                // e.g. $('.linkPreview').linkPreview({imageQuantity: 15});
            });
        </script>
      
   </head>
   <body>
                <div style="z-index: 2; left: 720px; top: 110px; position: absolute; margin-top: 0px"> 
            <button  value="View Graph" >   View Graph   </button>
         </div>      

               <div style="z-index: 1; left: 420px; top: 40px; position: absolute; margin-top: 0px">         
               <label>Enter URL:</label><br/>
            </div>

            <div style=" width: 15%;    margin: auto; ">
            <div class="linkPreview" style="z-index: 2;">
                <div id="previewLoading"></div>
                <div style="float: left;">
                    <textarea type="text" id="text" style="text-align: left; height:35px; width:512px; " placeholder="What's in your mind"/>
                    </textarea>
                    <div style="clear: both"></div>
                </div>
                <div id="preview" style="z-index: 1000;">
                    <div id="previewImages">
                        <div id="previewImage"><img src="img/loader.gif" style="margin-left: 43%; margin-top: 39%;" ></img>
                        </div>
                        <input type="hidden" id="photoNumber" value="0" />
                    </div>
                    <div id="previewContent">
                        <div id="closePreview" title="Remove" ></div>
                        <div id="previewTitle"></div>
                        <div id="previewUrl"></div>
                        <div id="previewDescription"></div>
                        <div id="hiddenDescription"></div>
                        <div id="previewButtons" >
                            <div id="previewPreviousImg" class="buttonLeftDeactive" ></div><div id="previewNextImg" class="buttonRightDeactive"  ></div>
                            <div class="photoNumbers" ></div>
                            <div class="chooseThumbnail">
                                Choose a thumbnail
                            </div>
                        </div>
                        <input type="checkbox" id="noThumb" class="noThumbCb" />
                        <div class="nT"  >
                            <span id="noThumbDiv" >No thumbnail</span>
                        </div>
                    </div>
                    <div style="clear: both"></div>
                </div>
                <div style="clear: both"></div>
                <div id="postPreview">
                    
                
                </div>
                <div class="previewPostedList"></div>
            </div>
        </div>
  
       
      </body>
</html>
