<?php

// render featured articles
function show_featured_articles() {
  global $articles;
  $index = 0;
  foreach ($articles as $article) {
    if (isset($article['featured']) && $article['featured'] == 'yes') {
      echo render_article($index++, $article);
    }
  }
}

// render a list of articles by id
function show_articles($article_ids) {
  global $articles;
  $index = 0;
  foreach ($articles as $article) {
    if (in_array(intval($article['order']), $article_ids)) {
      echo render_article($index++, $article);
    }
  }
}

// get a list of all article authors
function get_article_authors() {
  global $articles;
  $hashmap = array();
  $authors = array();
  foreach ($articles as $index => $article) {
    foreach ($article['authors'] as $author) {
      if (!isset($hashmap[$author])) {
        $hashmap[$author] = true;
        $authors[] = $author;
      }
    }
  }
  sort($authors);
  return $authors;
}

// get a list of all journals
function get_article_journals() {
  global $articles;
  $hashmap = array();
  $journals = array();
  foreach ($articles as $index => $article) {
    if (!isset($hashmap[$article['journal']])) {
      $hashmap[$article['journal']] = 0;
      $journals[] = $article['journal'];
    }
  }
  sort ($journals);
  return $journals;
}

// render short representation of an article
function render_article_short($article) {
  $html = sprintf('%s, &ldquo;%s.&rdquo; %s <strong>%s</strong> %s (%s)', implode(', ', $article['authors']), $article['title'], $article['journal'], $article['volume'], $article['pages'], $article['year']);
  return $html; 
}

// render short representation of an article given the article's order id
function show_article_short($order_id) {
  global $articles;
  foreach($articles as $article) {
    if ($article['order'] == $order_id) {
      echo render_article_short($article);
      break;
    }
  }
}

// render an article
// Freedman SB, Adler M, Seshadri R, Powell EC. 
// Oral ondansetron for gastroenteritis in a pediatric emergency department. 
// N Engl J Med. 2006 Apr 20;354(16):1698-705. PubMed PMID: 16625009.
function render_article($index, $article) {
  
  $article_id = "article-$index";
  
  $authors = array();
  foreach($article['authors'] as $author) {
    $authors[] = "<span class=\"author\">$author</span>";
  }
  $authors = "<div class=\"authors\">\n" . implode(', ', $authors) . "</div>\n";
  
  $title = '<div class="title"><a href="' . $article['fulltext'] . '">' . $article['title'] . '</a></div>'."\n";
  
  $journal_pages = (isset($article['pages']) && !empty($article['pages'])) ? $article['pages'] : '';
  $journal_name = (isset($article['journal']) && !empty($article['journal'])) ? $article['journal'] . '.': '';
  $journal_year = (isset($article['year']) && !empty($article['year'])) ? $article['year'] : '';
  $journal_volume = (!empty($article['issue'])) ? $article['volume'] . '(' . $article['issue'] . ')' : '';

  if (empty($article['volume'])) {
    $journal_volume = '';
  }
  $journal_comment = '';
  if (!empty($article['status'])) {
    $journal_comment = '<span class="status">' . $article['status'] . '</span>';
  }
  
  $journal_entry = $journal_name; 
  if (!empty($journal_year)) 
    $journal_entry .= ' ' . $journal_year;
  if (!empty($journal_volume)) 
    $journal_entry .= ';' . $journal_volume;
  if (!empty($journal_pages)) 
    $journal_entry .= ':' . $journal_pages . '.';
  $journal_entry .= ' ' . $journal_comment;
  
  $journal = '<div class="journal">' . $journal_entry .'</div>'. "\n";
  
  $bibtex_raw = array(
    '@article {', 
    '  title = "' . $article['title'] . '",',
    '  author = "' . implode(' and ', $article['authors']) . '",',
    '  journal = "' . $article['journal'] . '",',
    '  volume = "' . $article['volume'] . '",',
    '  year ="' . $article['year'] .'",',
    '  number = "' . $article['number'] . '",',
    '  pages = "' . $article['pages'] . '",',
    '  doi = "' . $article['doi'] . '"',
    "}\n");

  $bibtex_raw = implode("\n", $bibtex_raw);
  $bibtex = "<div class=\"bibtex\"><h4>BibTeX</h4><textarea class=\"bibtex\" readonly=\"readonly\">$bibtex_raw</textarea></div>\n";
  
  $buttons = implode("\n", array(
    '<a href="' . $article['fulltext'] . '" class="button button-fulltext" target="_blank"><span>Fulltext</span><i class="icon-external-link"></i></a>',
    '<a class="button button-bibtex"><span>BibTeX</span><i class="icon-book"></i> </a>',
    '<a class="button button-abstract"><span>Abstract</span><i class="icon-eye-open"></i></a>'
  ));
  $buttons = "<div class=\"article-buttons\">\n$buttons\n</div>\n";
  
  $keywords = (isset($article['keywords']) ? '<div class="keywords"><strong>Keywords: </strong>' . $artice['keywords'] .'</div>' : '');
  
  $thumbnail_src = (isset($article['thumbnail']) && !empty($article['thumbnail'])) ? '/images/publications/' . $article['thumbnail'] : '/images/publications/none.png';
  $thumbnail = '<a href="' . $article['fulltext'] . '"><img class="thumbnail" src="'. $thumbnail_src .'" /></a>' . "\n";

  $abstract = '<div class="abstract">'.$article['abstract']."</div>\n";
  
  $fulltext = "<div class=\"fulltext\"><h4>Fulltext Options</h4>\n";
  if (strpos($article['fulltext'], 'arxiv') === false) {
    $fulltext .= '<a class="btn external" href="'.$article['fulltext'].'">View on External Site <i class="icon-external-link"></i> </a>';
    $fulltext .= '<code class="block">'.htmlspecialchars($article['fulltext']).'</code><br />';
    if (isset($article['arxiv']) && !empty($article['arxiv'])) {
      $link = $article['arxiv'];
      if (strpos($article['arxiv'], 'http') === false) {
        $link = 'http://arxiv.org/abs/' . $article['arxiv'];
      }
      $fulltext .= '<a class="btn" href="'.$link.'">View on arXiv.org <img class="float-right" src="/images/open-access.png" height="20" alt="open-access" /></a>';
      $fulltext .= '<code class="block">'.htmlspecialchars($link).'</code><br />';
    }
  } else {
    $fulltext .= '<a class="btn" href="'.$article['fulltext'].'">View on arXiv.org <img class="float-right" src="/images/open-access.png" height="20" alt="open-access" /></a>';
    $fulltext .= '<code class="block">'.htmlspecialchars($article['fulltext']).'</code><br />';    
  }

  $fulltext .= '</div>'."\n";
  
  $zebra = ($index % 2 == 0) ? 'even' : 'odd';
  
  $div = implode('', array('<div id="'.$article_id.'" class="article '.$zebra.'">',
    $thumbnail, $buttons, $authors, $title, $journal, $fulltext, $abstract, $bibtex,
    "</div>\n"));
  
  return $div;
}

function render_conference($idx, $conference) {
  $return = array();
  $return[] = '<div class="conference">';
  $return[] = '<span class="conference-order">'. $conference['order'] .'.</span>';
  $return[] = '<span class="conference-authors">'. implode(', ', $conference['authors']) .',</span>';
  $return[] = '<span class="conference-title">&ldquo;'. $conference['title'] .'.&rdquo;</span>';
  $return[] = '<span class="conference-conference">'. $conference['conference'] .'</span>';
  if (strlen($conference['publication'])) {
    $return[] = '<span class="conference-publication">'. $conference['publication'] .'</span>';
  }
  $return[] = '<span class="conference-year">('. $conference['year'] .')</span>';
  if (strlen($conference['url'])) {
    $return[] = '<span class="conference-url">[<a href="'. $conference['url'] .'">Link</a>]</span>';
  }
  $return[] = '</div>';
  return implode("\n", $return);
}

?>
