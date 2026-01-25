    <?php
      define("DATA_CACHE_FNAME", $_SERVER['DOCUMENT_ROOT'] . "/../lists/movies.txt.data_cache");
      define("DATA_CACHE_LAST_FNAME", $_SERVER['DOCUMENT_ROOT'] . "/../lists/movies.txt.data_cache.last");
      define("LIST_FNAME", $_SERVER['DOCUMENT_ROOT'] . "/../lists/movies.txt");
      define("REPOSITORY_DNAME", $_SERVER['DOCUMENT_ROOT'] . "/../lists/");

      $data_cache = NULL;
      $data_cache_file = NULL;
      $data_cache_last = 0;
      $git_result_code = NULL;
      $line = "";
      $list_file = NULL;
      $list_line = NULL;
      $ts = 0;


      if (file_exists(DATA_CACHE_LAST_FNAME)
      &&  ($data_cache_last = file_get_contents(DATA_CACHE_LAST_FNAME)))
      {
        $data_cache_last = intval($data_cache_last);
      } else {
        $data_cache_last = 0;
      }

      $ts = date("U");
      if (($ts > $data_cache_last)
      &&  (($ts - $data_cache_last) >= 3600))
      {
        file_put_contents(DATA_CACHE_LAST_FNAME, date("U"));
        if (exec("env LC_ALL=C sh -c 'cd " . REPOSITORY_DNAME . " && git fetch && if [ \"\$(git log -n 1 --pretty=format:%H 2>/dev/null)\" != \"\$(git ls-remote . refs/remotes/origin/HEAD 2>/dev/null | awk '\''{print \$1}'\'')\" ]; then git pull; return 0; else return 1; fi'", $_, $git_result_code)
        &&  ($git_result_code == 0))
        {
          if (file_exists(DATA_CACHE_FNAME)) {
            unlink(DATA_CACHE_FNAME);
          }
        }
      }

      if (file_exists(DATA_CACHE_FNAME)
      &&  (($data_cache = file_get_contents(DATA_CACHE_FNAME)) !== false))
      {
        echo $data_cache;
      } else
      if (!($list_file = fopen(LIST_FNAME, "r"))) {
        /* ... */
      } else {
        $data_cache_file = fopen(DATA_CACHE_FNAME, "w");
        while (!feof($list_file)) {
          $list_line = rtrim(fgets($list_file));
          if (preg_match('|^(\d+)\s+(.+?)\s*(\**)$|i',
              $list_line, $matches, PREG_UNMATCHED_AS_NULL))
          {
            $line = sprintf("                  ['%s', '%s', '%s'],\n",
              addslashes($matches[1]),
              addslashes($matches[2]),
              addslashes(str_replace("*", "⭐", $matches[3])));
            fwrite($data_cache_file, $line);
            echo $line;
          }
        }
        fclose($data_cache_file);
        fclose($list_file);
      }
    ?>
<?php
// vim:ts=2 sw=2 expandtab fenc=utf-8 foldmethod=marker nowrap tw=145
?>
