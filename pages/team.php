<?php
$template = Template::getInstance();
$template->title = 'Team';
$template->tab = 'Team';
// $template->sidebar = false;

$people = json_decode(file_get_contents('json/people.json'), true);

// helper function for deciding whether to hide a section
function count_people($type) {
  global $people;
  $count = 0;

  foreach($people as $person) {
    if ($person['type'] == $type) 
      $count++;
  }
  return $count;
}

// outputs an itemized list of people based on type
// visitors and UROP students get special treatment 
function people_filter($type) {
  echo '<ul class="'.$type.' clearfix">';
  global $people;
  $count = 0;
  if ($type == 'visitor') {
    foreach($people as $person) {
      if ($person['type'] == $type) {
        echo '<li class="person person-'.$type.'"><img src="/images/people/'.$person['url'].'.png" alt="'.$person['name'].'" title="'.$person['name'].'" />
          <span class="name">'.$person['name'].'</span>
          <span class="info small">'.$person['institution'].'</span>
          </li>';
        if (++$count % 2 == 0)
          echo '<br style="clear:both;" />';
      }
    }
  } elseif ($type == 'urop') {
    foreach($people as $person) {
      if ($person['type'] == $type) {
        echo '<li class="person person-'.$type.'"><img src="/images/people/'.$person['url'].'.png" alt="'.$person['name'].'" title="'.$person['name'].'" />
          <span class="name">'.$person['name'].'</span>
          <span class="info"><a href="/people/'.$person['url'].'">bio</a></span>
          </li>';
        if (++$count % 2 == 0)
          echo '<br style="clear:both;" />';
      }
    }
  } else {
    foreach($people as $person) {
      if ($person['type'] == $type) {
        echo '<li class="person person-'.$type.'"><img src="/images/people/'.$person['url'].'.png" alt="'.$person['name'].'" title="'.$person['name'].'" />
          <span class="name">'.$person['name'].'</span>';

        if (isset($person['affiliation']) && !empty($person['affiliation'])) {
          echo '<div class="affiliations">';
          $affiliations = explode("\n", $person['affiliation']);
          echo '<ul>';
          foreach ($affiliations as $affiliation) {
            echo '<li>'.$affiliation.'</li>';
          }
          echo '</ul>';
          echo '</div>';
        }

        echo '<div class="bio" id="'.$person['url'].'">';
        echo '<p>'.$person['bio'].'</p>';
        echo '</div>';
        if (!empty($person['email'])) {
          echo '<div class="contact">'.$person['email'].' at ucla dot edu</div>';
        }
        echo '</li>';
      }
    }
  }
  echo '</ul>';
}

// outputs an itemized list of alumni based on type
function list_alumni($type) {
  global $people;
  echo '<ul class="list">';
  foreach($people as $person) {
    if ($person['type'] == $type) {
      $affiliation = (!empty($person['bio'])) ? ' (' . $person['bio'] . ')': '';
      echo '<li><strong>' . $person['name'] .'</strong>'.$affiliation.'</li>';
    }
  }
  echo '</ul>';
}

?>

<h2>Group Members</h2>

<div class="people-browser clearfix">  

  <h3>Principal Investigator</h3>
  <?php people_filter('pi'); ?>

  <?php if (count_people('postdoc') > 0) { ?>
  <h3>Postdoctoral Associates</h3>
  <?php people_filter('postdoc'); ?>
  <?php } ?>
  
  <?php if (count_people('visitor') > 0) { ?>
  <h3>Current Visitors</h3>
  <?php people_filter('visitor'); ?>
  <?php } ?>

  <h3>Graduate Students, Ph.D.</h3>
  <?php people_filter('phd'); ?>
  
  <h3>Graduate Students, M.S.</h3>
  <?php people_filter('sm'); ?>

  <?php if (count_people('undergrad') > 0) { ?>
  <h3>Undergraduate Students</h3>
  <?php people_filter('undergrad'); ?>
  <?php } ?>

</div>

<br style="clear:both" />

<?php 
$alumn_count = count_people('postdoc-alumn')
             + count_people('visitor-alumn')
             + count_people('grad-alumn')
             + count_people('undergrad-alumn');
if ($alumn_count > 0) {
?>
<h2>Alumni</h2>
<div class="alumni">
  <div class="col-1-2">
  <?php if (count_people('postdoc-alumn') > 0) { ?>
  <h3>Postdoctoral Alumni</h3>
    <?php list_alumni('postdoc-alumn'); ?>
  <?php } ?>

  <?php if (count_people('visitor-alumn') > 0) { ?>
  <h3>Long Term Visitors</h3>
    <?php list_alumni('visitor-alumn'); ?>
  <?php } ?>
  </div>
  <div class="col-2-2">

  <?php if (count_people('grad-alumn') > 0) { ?>
  <h3>Graduate Alumni</h3>
    <?php list_alumni('grad-alumn'); ?>
  <?php } ?>

  <?php if (count_people('undergrad-alumn') > 0) { ?>
  <h3>Undergraduate Alumni</h3>
    <?php list_alumni('undergrad-alumn'); ?>
  <?php } ?>
  </div>
</div>
<?php } ?>