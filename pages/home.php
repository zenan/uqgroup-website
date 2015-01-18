<?php
$template = Template::getInstance();
$template->title = 'Home';
$template->tab = 'Home';
?>
<h2>Introduction</h2> 

<p>Welcome to the Chen Lab website!</p>
<div class="figure figure-left" style="width:29%">
	<img src="/images/home/home1.jpg" />
	<div class="caption">Caption 1</div>
</div>
<div class="figure figure-left" style="width:42%">
	<img src="/images/home/home2.png" />
	<div class="caption">Caption 2</div>
</div>
<div class="figure figure-left" style="width:29%">
	<img src="/images/home/home3.jpg" />
	<div class="caption">Caption 3</div>
</div>

<br style="clear: both;" />

<h3 class="noline">Featured Publications</h3>
<div class="articles">
<?php 
$articles = json_decode(file_get_contents('json/articles.json'), true);
show_featured_articles(); ?>
</div>
<div class="see-all">
  <a href="/publications">See all publications</a>
</div>

<script type="text/javascript" src="js/jquery.simplemodal.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    articlesAttachHover();
});
</script>
