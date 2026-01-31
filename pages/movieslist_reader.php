    <?php
      define("DATA_CACHE_FNAME", $_SERVER['DOCUMENT_ROOT'] . "/../lists/movies.txt.data_cache");
      define("DATA_CACHE_LOCK_FNAME", $_SERVER['DOCUMENT_ROOT'] . "/../lists/movies.txt.data_cache.lock");
      define("WRITER_LOCK_FNAME", $_SERVER['DOCUMENT_ROOT'] . "/../lists/writer.lock");

      $data_cache = NULL;
      $data_cache_lock_file = NULL;
      $writer_lock_file = NULL;


      $writer_lock_file = fopen(WRITER_LOCK_FNAME, "c");
      if (flock($writer_lock_file, LOCK_EX | LOCK_NB)) {
        exec("nohup php " . $_SERVER['DOCUMENT_ROOT'] . "/pages/movieslist_writer.php " . escapeshellarg($_SERVER['DOCUMENT_ROOT']) . " >/dev/null 2>&1 &");
        fclose($writer_lock_file);
      }

      $data_cache_lock_file = fopen(DATA_CACHE_LOCK_FNAME, "c");
      if (flock($data_cache_lock_file, LOCK_EX)) {
        if (($data_cache = file_get_contents(DATA_CACHE_FNAME)) !== false) {
          echo $data_cache;
        }
        flock($data_cache_lock_file, LOCK_UN);
      }
      fclose($data_cache_lock_file);
    ?>
<?php
// vim:ts=2 sw=2 expandtab fenc=utf-8 foldmethod=marker nowrap tw=145
?>
