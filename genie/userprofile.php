<!DOCTYPE html>
<html>
    <head>

        <script type="text/javascript" src="jquery-2.2.1.min.js">
</script>
        <meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39">
        <title>
            Notes
        </title>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
        <script type="text/javascript" src="bootstrap/js/bootstrap.js">
</script>
        <script type="text/javascript" src="packery.pkgd.min.js">
</script>
        <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js">
</script>




<style>


.grid-item { 
	width: 200px;
	min-height: 200px;
	background-color: red;	

 }
.grid-item--width2 { 
	background-color: blue;
	width: 400px;
}






</style>
</head>



<body>
<script>

$(function() {
// $('.grid').masonry({
//   // options
//   itemSelector: '.grid-item',
//   columnWidth: 200
// });

$('.grid').packery({
  // options
  itemSelector: '.grid-item',
  gutter: 10
});

});


</script>

<div class="container">
<div class="grid">
  <div class="grid-item">...</div>
  <div class="grid-item">...</div>
  <div class="grid-item">...</div>
  <div class="grid-item">...</div>
  <div class="grid-item grid-item--width2">...</div>
  <div class="grid-item"> ...</div>
  <div class="grid-item">...</div>
  <div class="grid-item">...</div>
 
</div>
</div>



</body>
</html>