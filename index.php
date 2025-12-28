<?php
  $inc_lang = NULL;
  $inc_dir = NULL;
  $inc_page = NULL;
  $inc_page_sub = NULL;
  $inc_uri = NULL;
  $inc_uri_fname = NULL;
  $inc_uri_orig = NULL;
  $language_fallback = "en";
  $languages = ["en", "es", "de"];

  function include_include($lang, $include) {
    global $inc_lang, $inc_dir, $inc_page, $inc_page_sub, $inc_uri, $inc_uri_fname, $inc_uri_orig;
    global $language_fallback;

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/includes/$lang/$include.php")) {
      include $_SERVER['DOCUMENT_ROOT'] . "/includes/$lang/$include.php";
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/includes/$language_fallback/$include.php")) {
      include $_SERVER['DOCUMENT_ROOT'] . "/includes/$language_fallback/$include.php";
    } else {
      /* Internally generated, ignore. */
    }
  }

  function include_page($dir, $lang, $page) {
    global $inc_lang, $inc_dir, $inc_page, $inc_page_sub, $inc_uri, $inc_uri_fname, $inc_uri_orig;
    global $language_fallback;

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/$dir/$lang/$page.php")) {
      include $_SERVER['DOCUMENT_ROOT'] . "/$dir/$lang/$page.php";
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/$dir/$language_fallback/$page.php")) {
      include $_SERVER['DOCUMENT_ROOT'] . "/$dir/$language_fallback/$page.php";
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/_error_pages/$lang/404.php")) {
      include $_SERVER['DOCUMENT_ROOT'] . "/_error_pages/$lang/404.php";
      http_response_code(404);
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/_error_pages/$language_fallback/404.php")) {
      include $_SERVER['DOCUMENT_ROOT'] . "/_error_pages/$language_fallback/404.php";
      http_response_code(404);
    }
  }

  function include_title($dir, $lang, $page) {
    global $inc_lang, $inc_dir, $inc_page, $inc_page_sub, $inc_uri, $inc_uri_fname, $inc_uri_orig;
    global $language_fallback;

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/$dir/$lang/$page.php.title.$lang")) {
      echo rtrim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/$dir/$lang/$page.php.title.$lang"));
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/$dir/$language_fallback/$page.php.title.$language_fallback")) {
      echo rtrim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/$dir/$language_fallback/$page.php.title.$language_fallback"));
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/_error_pages/$lang/404.php.title.$lang")) {
      include $_SERVER['DOCUMENT_ROOT'] . "/_error_pages/$lang/404.php.title.$lang";
      http_response_code(404);
    } else if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/_error_pages/$language_fallback/404.php.title.$language_fallback")) {
      include $_SERVER['DOCUMENT_ROOT'] . "/_error_pages/$language_fallback/404.php.title.$language_fallback";
      http_response_code(404);
    }
  }

  if (!preg_match(
      '%^/+(?:(' . implode("|", $languages) . ')/*)?(?:([^/]+)/*(?:/+(.+))?)?$%i',
      $_SERVER['REQUEST_URI'], $matches, PREG_UNMATCHED_AS_NULL))
  {
    http_response_code(404);
  } else {
    $inc_lang = $matches[1];
    if (is_null($inc_lang)) {
      if (array_key_exists("geoip2_data_country_code", $_SERVER)) {
        $inc_lang = strtolower($_SERVER['geoip2_data_country_code']);
      } else {
        $inc_lang = "en";
      }
      if (!in_array($inc_lang, $languages)) {
        $inc_lang = "en";
      }

      header("Location: /$inc_lang" . $_SERVER['REQUEST_URI']);
      die();
    } else {
      $inc_lang = strtolower($inc_lang);
      if (!in_array($inc_lang, $languages)) {
        $inc_lang = "en";
        header("Location: /$inc_lang" . preg_replace('|^/[a-z][a-z]/*|i', '/', $_SERVER['REQUEST_URI']));
        die();
      }
    }

    $inc_page = $matches[2];
    $inc_page_sub = $matches[3];

    if (is_null($inc_page)) {
      header("Location: /$inc_lang/about");
      die();
    }

    if (is_null($inc_page_sub)) {
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
    <title><?php include_title($inc_dir, $inc_lang, $inc_page) ?></title>
  </head>
  <body onload="kadeClick()">
    <?php include_include($inc_lang, "legend"); ?>
    <div class="div-empty"></div>
    <?php include_page($inc_dir, $inc_lang, $inc_page); ?>
    <div class="div-empty"></div>
    <?php include_include($inc_lang, "copyright"); ?>
  </body>
</html>

<!--
  vim:ts=2 sw=2 expandtab fenc=utf-8 foldmethod=marker nowrap tw=0
  -->
