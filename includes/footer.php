</div> <!-- content -->
<div id="sidebar-wrap">
  <div id="sidebar">
    <div class="sidebar-box">
      <h2>Announcements</h2>
      <div class="sidebar-content">
      <?php
      $announcements = json_decode(file_get_contents('json/announcements.json'),true);
      foreach ($announcements as $index => $announcement) {
        if ($index < 5) {
          printf("<p class=\"announcement\"><strong>%s</strong><br />%s</p>\n",
            $announcement['date'], $announcement['content']);
        }
      }
      ?>
      <p><a href="/announcements">More announcements</a></p>
      </div>
    </div>
    <div class="sidebar-box">
      <h2>Links</h2>
      <div class="sidebar-content">
        <ul class="links">
        <!--
        <li><a href="https://wikis.mit.edu/confluence/display/uqlab/Home"><i class="icon-lock"></i> Lab Wiki </a></li>
        <li><a href="https://wikis.mit.edu/confluence/display/uqgroup/Home"><i class="icon-lock"></i> Reading Group Wiki</a></li>
        -->
        <li><a href="/admin/index.php"><i class="icon-lock"></i> Website Administration</a></li>
        </ul>
      </div>
    </div>    
  </div>
</div> 
</div> <!-- content-wrap -->
<div id="footer-wrap">
<!--
<div id="footer" class="clearfix">
  <div class="contact">
    <div class="pi">
      <h4>Contact Information</h4>
      <p><a href="http://www.chemeng.ucla.edu/people/faculty/yvonne-chen" target="_blank"><strong>Yvonne Chen</strong></a></p>
      <p>Assistant Professor of Chemical and Biomolecular Engineering</p>
      <p><i class="icon-envelope"></i> yvchen at ucla dot edu</p>
      <p><i class="icon-phone"></i> (310) 825-2816</p>
      <p><i class="icon-map-marker"></i>5532-H Boelter Hall<br />
       <i>&nbsp;</i>Los Angeles, CA 90095
      </p>
    </div>
    <div class="admin">
      <h4>&nbsp;</h4>
      <p><strong>Name</strong></p>      
      <p>Administrative Assistant<br />&nbsp;</p>
      <p><i class="icon-envelope"></i> email</p>
      <p><i class="icon-phone"></i> phone</p>
    </div>
  </div>
  <div class="logos-wrapper">
  <ul class="logos">
    <li><a href="http://mit.edu" target="_blank"><img src="/images/mitlogo.png" alt="cce" width="200" /></a></li>
    <li><a href="http://aeroastro.mit.edu" target="_blank"><img src="/images/aeroastro.png" alt="aeroastro" width="180" /></a></li>
    <li><a href="http://acdl.mit.edu" target="_blank"><img src="/images/acdl.png" alt="acdl" width="100" /></a></li>
    <li><a href="http://computationalengineering.mit.edu" target="_blank"><img src="/images/cce.png" alt="cce" width="200" /></a></li>
  </ul>
  </div>
  <br style="clear: both" />
</div>
-->
  <div id="footer-bottom" class="clearfix">
    <div class="center-width">
    <div class="designed-by">
      Yvonne Chen Lab. Copyright &copy;<?php echo date('Y'); ?> All Rights Reserved.
    </div>
    <div class="copyright">
    <i class="icon-map-marker"></i> &nbsp; 5532-H Boelter Hall <i>&nbsp;</i>Los Angeles, CA 90095
    </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-38300402-1']);
_gaq.push(['_trackPageview']);
(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>

</body>
</html>