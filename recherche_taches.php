<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Recherche des tâches</title>
  <style>
    /* Styles CSS pour la navbar */
    .navbar {
      background-color: #f1f1f1;
      overflow: hidden;
    }

    .navbar a {
      float: left;
      display: block;
      color: #333;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    .navbar a:hover {
      background-color: #ddd;
    }

    .navbar a.active {
      background-color: #4CAF50;
      color: white;
    }

    /* Styles CSS pour la page recherche_taches */
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    h2 {
      margin-bottom: 20px;
    }

    .resultats {
      margin-top: 20px;
    }

    .resultat-tache {
      margin-bottom: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
  </style>
</head>
<body>
<div class="navbar">
    <a href="tache.php">taches</a>
    <a href="recherher.php">recherche</a>
    <a href="suivi_de_taches.php">suivi</a>
    <a href="recherche_taches.php">recherche tache</a>
  </div>

  <div class="container">
    <h2>Recherche des tâches</h2>
    <form action="recherche_taches.php" method="GET">
      <div class="form-group">
        <label for="recherche">Recherche :</label>
        <input type="text" id="recherche" name="recherche" required>
      </div>
      <div class="form-group">
        <button type="submit">Rechercher</button>
      </div>
    </form>

    <div class="resultats">
      <?php
      // Connexion à la base de données
      $connexion = mysqli_connect("localhost", "root", "", "gestion_de_tache");
      if (!$connexion) {
        die("Erreur de connexion à la base de données: " . mysqli_connect_error());
      }

      // Récupération des termes de recherche
      $recherche = $_GET['recherche'];

      // Requête pour récupérer les tâches correspondantes à la recherche
      $selectQuery = "SELECT * FROM taches WHERE titre LIKE '%$recherche%' OR description LIKE '%$recherche%'";
      $result = mysqli_query($connexion, $selectQuery);

      // Affichage des tâches
      if (mysqli_num_rows($result) > 0) {
        echo '<h3>Résultats de recherche pour "' . $recherche . '" :</h3>';
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class="resultat-tache">';
          echo 'ID: ' . $row['id'] . '<br>';
          echo 'Titre: ' . $row['titre'] . '<br>';
          echo 'Description: ' . $row['description'] . '<br>';
          echo 'Début: ' . $row['debut'] . '<br>';
          echo 'Fin: ' . $row['fin'] . '<br>';
          echo 'Catégorie ID: ' . $row['categorie_id'] . '<br>';
          echo 'Priorité ID: ' . $row['priorite_id'] . '<br>';
          echo '</div>';
        }
      } else {
        echo 'Aucun résultat trouvé pour "' . $recherche . '".';
      }

      // Fermeture de la connexion à la base de données
      mysqli_close($connexion);
      ?>
    </div>
  </div>
</body>
</html>
