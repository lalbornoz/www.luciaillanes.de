      <script src="/assets/jspreadsheet/jspreadsheet.js"></script>
      <script src="/assets/jsuites/jsuites.js"></script>
      <link rel="stylesheet" href="/assets/jspreadsheet/jspreadsheet.css" type="text/css">
      <link rel="stylesheet" href="/assets/jsuites/jsuites.css" type="text/css">

      <div class="div-box div-content-etc">
        <div class="div-box div-content-etc-movies">
          <h1 style="margin-bottom: 0">Películas y series que he visto</h1>
          <span style="font-size: 1.5em; text-align: center"
              title="Lā qibiti, lā amāru, lā ṭēmi, lā šēmi, ṣilittu&#10;No voices, no sight, no senses, no sound, silence">
            𒆷 𒆠𒁉𒋾 𒆷 𒀀𒈠𒊑 𒆷 𒋼𒈪 𒆷 𒊺𒉿 𒍣𒇻𒌈
          </span><br>

          <noscript>
            Por favor habilite JavaScript.
          </noscript>

          <div id="spreadsheet" style="margin-top: 1em"></div>

          <script>
            jspreadsheet(document.getElementById('spreadsheet'), {
              worksheets: [{
              data: [
<?php include $_SERVER['DOCUMENT_ROOT'] . "/pages/movieslist.php" ?>
                ],
                columns: [
                  { type: 'text', title: 'Año', width: 75 },
                  { type: 'text', title: 'Título', width: 500 },
                  { type: 'text', title: 'Calificación', width: 150 },
                ],
              }],
            });
          </script>

          <p style="font-style: italic; text-align: center">
            (generado con <a href="https://github.com/jspreadsheet/ce">jspreadsheet/ce</a>
            en base de <a href="https://github.com/lalbornoz/lists/blob/master/movies.txt">lalbornoz/lists/movies.txt</a>)
          </p>
        </div>
      </div>

  <!--
    vim:ts=2 sw=2 expandtab fenc=utf-8 foldmethod=marker nowrap tw=0
    -->
