<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Chen Lab - <?=$this->title;?></title> 
  <link href="/css/style.css?20150116" rel="stylesheet" type="text/css" media="screen" />
  <link href="/css/font-awesome.css"  rel="stylesheet" type="text/css" />
  <link href='//fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
  <link href='//fonts.googleapis.com/css?family=Arimo:400,700' rel='stylesheet' type='text/css'>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="/js/main.js"></script>
  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <link rel="shortcut icon" href="/favicon.ico" />  
</head>
<body>
<div id="vertical-container">
<div id="header-wrap">
  <div id="header" class="clearfix">
    <div id="title">
      <div id="title-wrap">
      <h1><a href="/home">Chen Lab</a></h1>
      <h2><a href="http://www.chemeng.ucla.edu/">UCLA Chemical &amp; Biomolecular Engineering</a></h2>
      </div>
    </div>
  </div>
</div>
<div id="nav-wrap" class="clearfix">
  <div id="nav" class="clearfix">
    <ul id="navbar">
      <?php 

      $tabs = array(
        array('Home', 'home'),
        array('Research', 'research'),
        array('Team', 'team'),
        array('Publications', 'publications'),
        array('Join Us', 'join-us')
      );
      
      foreach ($tabs as $tab) {
        $url = (USE_REWRITE) ? '/' . $tab[1] : '?p=' . $tab[1];
        $name = $tab[0];
        $active = $this->tab == $name ? ' class="active"' : '';
        if ($name == 'Home') $name = '<i class="icon-home"></i>';
        printf("<li><a href=\"%s\"%s>%s</a></li>\n", $url, $active, $name);
      }
      ?>
    </ul>
    <a class="totop" onclick="$('html, body').animate({scrollTop:0}, 500);"><i class="icon-circle-arrow-up"></i></a>
  </div>
</div>
<div id="content-wrap" class="clearfix <?php if ($this->sidebar == false) echo 'nosidebar'; ?>">
<div id="content" class="column">
