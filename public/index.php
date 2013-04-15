<?php
require '../vendor/autoload.php';

// init the feed
$url = 'http://rss.nytimes.com/services/xml/rss/nyt/HomePage.xml';
$feed = new SimplePie();
$feed->set_feed_url($url);
// enable caching
$feed->enable_cache();
$feed->set_cache_location('../cache');
$feed->init();
?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
  <title>RSS Feed</title>
 </head>
 <body>
<?php
// show feed information
echo '<h1>' . $feed->get_title() . '</h1>';
echo '<p>' . $feed->get_description() . '</p>';

// show the first five items in the feed
foreach ($feed->get_items(0, 5) as $item) {
    echo '<article>';
    echo '<header>';
    echo '<h1><a href="' . $item->get_link() . '">' .
        $item->get_title() . '</a></h1>';
    echo '<p>Author: ' . $item->get_author()->get_name() . '</p>';
    echo '<p>Date: ' . $item->get_date('Y-m-d H:i:s') . '</p>';
    echo '<p><em>' . $item->get_description() . '</em></p>';
    echo '</header>';
    // only attempt to get summary - set false to fall back on description
    // if summary is not available
    echo $item->get_content(true);
    echo '</article>';
}
?>
 </body>
</html>
