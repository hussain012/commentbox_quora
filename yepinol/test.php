<!DOCTYPE html>

<html lang="en" class="no-js">
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
  
  <title>Readmore.js: jQuery plugin for long blocks of text</title>
    <style media="screen">
    body { font: 16px/1.5 "Helvetica Neue", Arial, Helvetica, sans-serif; color: #444; }
    code { color: #777; font-family: "Source Code Pro", "Menlo", "Courier New", monospace;}
    a { color: #178DB1; }
    .container { margin: 0 auto; max-width: 960px; }
    #info + .readmore-js-toggle { padding-bottom: 1.5em; border-bottom: 1px solid #999; font-weight: bold;}
    #demo { padding: 0 10%; }
  </style>
</head>

<body>
  <div class="container">  
    <h1>Demo</h1>
    <section id="demo">    
        <div>      
             <art>
            <textarea style="height:65px;width:400px;">
        <h2>Artisanal Narwahls</h2>
        <p>Salvia portland leggings banh mi fanny pack mixtape, authentic bushwick wes anderson intelligentsia artisan typewriter high life they sold out mixtape high life. Marfa ethnic wayfarers brooklyn keytar mixtape. Blue bottle shoreditch gluten-free, mixtape hoodie whatever pinterest viral twee fashion axe high life irony biodiesel tofu.</p>
        </textarea>
     
         </art>
        </div>        
    </section>
  </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="readmore.js"></script>
<script>
  $('#info').readmore({
    moreLink: '<a href="#">More examples and options</a>',
    maxHeight: 190,
    afterToggle: function(trigger, element, more) {
      if(! more) { // The "Close" link was clicked
        $('html, body').animate( { scrollTop: element.offset().top }, {duration: 100 } );
      }
    }
  });

    $('art').readmore({maxHeight: 140});

  </script>
  
</body>
</html>