<?php
  $inc_lang = NULL;
  $inc_dir = NULL;
  $inc_page = NULL;
  $inc_page_sub = NULL;
  $inc_uri = NULL;
  $inc_uri_fname = NULL;
  $language_fallback = "en";
  $languages = ["en", "es", "de"];

  # FIXME TODO XXX error pages/handling

  function include_page($dir, $lang, $page) {
    global $inc_lang, $inc_dir, $inc_page, $inc_page_sub, $inc_uri, $inc_uri_fname;

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/$dir/$lang/$page.php")) {
      include $_SERVER['DOCUMENT_ROOT'] . "/$dir/$lang/$page.php";
    } else {
      include $_SERVER['DOCUMENT_ROOT'] . "/$dir/en/$page.php";
    }
  }

  function include_title($dir, $lang, $page) {
    global $inc_lang, $inc_dir, $inc_page, $inc_page_sub, $inc_uri, $inc_uri_fname;
    global $language_fallback;

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/$dir/$lang/$page.php.title.$lang")) {
      include $_SERVER['DOCUMENT_ROOT'] . "/$dir/$lang/$page.php.title.$lang";
    } else {
      include $_SERVER['DOCUMENT_ROOT'] . "/$dir/$language_fallback/$page.php.title.$language_fallback";
    }
  }

  if (!preg_match(
      '%^/+(?:(' . implode("|", $languages) . ')/*)?(?:([^/]+)/*(?:/+(.+))?)?$%i',
      $_SERVER['REQUEST_URI'], $matches, PREG_UNMATCHED_AS_NULL))
  {
    http_response_code(500);
  } else {
    $inc_lang = $matches[1];
    if (is_null ($inc_lang)) {
      if (array_key_exists ("geoip2_data_country_code", $_SERVER)) {
        $inc_lang = strtolower($_SERVER['geoip2_data_country_code']);
      } else {
        $inc_lang = "en";
      }
      if (!in_array ($inc_lang, $languages)) {
        $inc_lang = "en";
      }

      header("Location: /$inc_lang" . $_SERVER['REQUEST_URI']);
      die();
    } else {
      $inc_lang = strtolower($inc_lang);
      if (!in_array ($inc_lang, $languages)) {
        $inc_lang = "en";
        header("Location: /$inc_lang" . preg_replace('|^/[a-z][a-z]/*|i', '/', $_SERVER['REQUEST_URI']));
        die();
      }
    }

    $inc_page = $matches[2];
    $inc_page_sub = $matches[3];

    if (is_null ($inc_page)) {
      header("Location: /$inc_lang/about");
      die();
    }

    if (is_null ($inc_page_sub)) {
      $inc_dir = "pages";
      $inc_page = $inc_page;
      $inc_page_sub = NULL;
      $inc_uri_fname = "/" . $inc_dir . "/" . $inc_lang . "/" . $inc_page;
      $inc_uri = $inc_uri_fname . ".php";
      $inc_uri_orig = "/" . $inc_page;
    } else {
      $inc_dir = $inc_page;
      $inc_page = $inc_page_sub;
      $inc_page_sub = NULL;
      $inc_uri_fname = "/" . $inc_dir . "/" . $inc_lang . "/" . $inc_page;
      $inc_uri = $inc_uri_fname . ".php";
      $inc_uri_orig = "/" . $inc_dir . "/" . $inc_page;
    }
  }
?>

<!DOCTYPE html>
<html lang="<?php echo $inc_lang ?>">
  <head>
    <link href="/assets/favicon.ico" rel="icon">
    <link href="/assets/styles.global.css" rel="stylesheet">
    <link href="/assets/styles.css" rel="stylesheet">
    <link href="/assets/styles.etc.css" rel="stylesheet">
    <meta charset="utf-8">
    <script src="/assets/functions.js"></script>
    <title><?php include_title ($inc_dir, $inc_lang, $inc_page) ?></title>
  </head>
  <body onload="kadeClick()">
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/" . $inc_lang . "/legend.php" ?>
    <div class="div-empty"></div>
    <?php include_page ($inc_dir, $inc_lang, $inc_page); ?>
    <div class="div-empty"></div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/includes/" . $inc_lang . "/copyright.php" ?>
  </body>
</html>

<!--
  vim:ts=2 sw=2 expandtab fenc=utf-8 foldmethod=marker nowrap tw=0
  -->
