    <?php
      define("DATA_CACHE_FNAME", $argv[1] . "/../lists/movies.txt.data_cache");
      define("DATA_CACHE_LOCK_FNAME", $argv[1] . "/../lists/movies.txt.data_cache.lock");
      define("DATA_CACHE_UPDATE_PERIOD", 3600);
      define("LIST_FNAME", $argv[1] . "/../lists/movies.txt");
      define("REPOSITORY_DNAME", $argv[1] . "/../lists/");

      $data_cache_file = NULL;
      $data_cache_lock_file = NULL;
      $git_result_code = NULL;
      $line = "";
      $list_file = NULL;
      $list_line = NULL;


      while (1) {
        if (!file_exists(DATA_CACHE_FNAME)
        ||  (exec("env LC_ALL=C sh -c 'cd " . REPOSITORY_DNAME . " && git fetch && if [ \"\$(git log -n 1 --pretty=format:%H 2>/dev/null)\" != \"\$(git ls-remote . refs/remotes/origin/HEAD 2>/dev/null | awk '\''{print \$1}'\'')\" ]; then git pull; return 0; else return 1; fi'", $_, $git_result_code)
        &&   ($git_result_code == 0)))
        {
          if (!($list_file = fopen(LIST_FNAME, "r"))) {
            // FIXME TODO XXX error handling
          } else {
            $data_cache_lock_file = fopen(DATA_CACHE_LOCK_FNAME, "c");
            if (flock($data_cache_lock_file, LOCK_EX)) {
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
              flock($data_cache_lock_file, LOCK_UN);
            }
            fclose($data_cache_lock_file);
            fclose($data_cache_file);
            fclose($list_file);
          }
        }

        // FIXME TODO XXX on-demand only?
        sleep(DATA_CACHE_UPDATE_PERIOD);
      }
    ?>
<?php
// vim:ts=2 sw=2 expandtab fenc=utf-8 foldmethod=marker nowrap tw=145
?>
