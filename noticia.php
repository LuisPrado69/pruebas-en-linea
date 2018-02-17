<?php
include_once 'conn.php';
?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang=""> <!--<![endif]-->
    <head>
      <title>Noticias</title>
      <!-- scripots y csss -->
      <link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css" />
      <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
      <script type="text/javascript" src="jquery.slidertron-1.0.js"></script>
      <link rel="stylesheet" href="css/bootstrap.css">
      <link rel="stylesheet" href="css/font-awesome.min.css"> 
</head>
<!-- CUERPO DE LA PAGINA -->
    <script>
      function opciones(val)
      {
        var opcion=document.getElementById("opciones"+val).value;
        val = window.btoa(val);
        if(opcion==1)
        {
          window.location= "muestra_noticia.php?id="+val;
        }
        //window.location= "d_productos.php?b="+document.getElementById(val).value;
      }
    </script>
    <body>
      <?php include_once "menu2.html" ?>

      <div id="page">
      <div id="content-other" align="center">

        <div class="fb-page" data-href="https://www.facebook.com/mach.audit/" data-tabs="timeline" data-width="500" data-height="400" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
          <blockquote cite="https://www.facebook.com/mach.audit/" class="fb-xfbml-parse-ignore">
          <a href="https://www.facebook.com/mach.audit/">MACH</a>
        </blockquote>
        </div>
      </div>
    </div>
      <!--Pie de página-->
      <?php include_once "footer1.php" ?>>
    </body>
</html>
