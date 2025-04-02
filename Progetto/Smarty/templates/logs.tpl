<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <title>OnlyFans: Logs</title>
  <link rel="stylesheet" href="Progetto/Smarty/css/logs.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script>
        function aggiornaContenuto() {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('contenuto-file').innerHTML = xhr.responseText;
                }
            };
            xhr.open('GET', 'Progetto/Utility/LeggiLog.php', true);
            xhr.send();
        }

        setInterval(aggiornaContenuto, 1000); // Aggiorna ogni secondo
    </script>
</head>
<body>

  <!-- Barra superiore unificata -->
  <header class="top-bar">
    <div class="left-section">
      <div class="logo">OnlyFans</div>
      <nav class="main-nav">
        <a href="/">HOMEPAGE</a>
        <a href="/prodotti">PRODOTTI</a>
      </nav>
    </div>
    <div class="right-section">
      <div class="search-box">
        <input type="text" placeholder="Cerca prodotti..." />
        <button>&#128269;</button>
      </div>
    </div>
  </header>

  <!-- Contenuto principale -->
  <div class="main-content">
    <!-- Box Spazio -->
    <div class="box">
      <h2>File di log</h2>
      <div id="contenuto-file"></div>
    </div>
  </div>

</body>
</html>
