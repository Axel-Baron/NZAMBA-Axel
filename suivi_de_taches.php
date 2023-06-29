<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Suivi des tâches</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table th, table td {
      padding: 8px;
      border: 1px solid #ccc;
    }

    .btn-edit {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      text-decoration: none;
    }

    .btn-delete {
      background-color: #f44336;
      color: #fff;
      border: none;
      padding: 5px 10px;
      border-radius: 4px;
      text-decoration: none;
    }
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
  </style>
</head>
<body>
<div class="navbar">
    <a href="tache.php">taches</a>
    <a href="recherher.php">recherche</a>
    <a href="suivi_de_taches.php">suivi</a>
    <a href="recherche_taches.php">rechercher tache</a>
  </div>
  <div class="container">
    <h2>Suivi des tâches</h2>
    <?php
    // Connexion à la base de données
    $connexion = mysqli_connect("localhost", "root", "", "gestion_de_tache");
    if (!$connexion) {
      die("Erreur de connexion à la base de données: " . mysqli_connect_error());
    }

    // Requête pour récupérer les tâches
    $selectQuery = "SELECT * FROM taches";
    $result = mysqli_query($connexion, $selectQuery);
    if (mysqli_num_rows($result) > 0) {
      echo '<table>';
      echo '<tr>';
      echo '<th>ID</th>';
      echo '<th>Titre</th>';
      echo '<th>Description</th>';
      echo '<th>Début</th>';
      echo '<th>Fin</th>';
      echo '<th>Catégorie ID</th>';
      echo '<th>Priorité ID</th>';
      echo '<th>Actions</th>';
      echo '</tr>';

      // Affichage des tâches
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['titre'] . '</td>';
        echo '<td>' . $row['description'] . '</td>';
        echo '<td>' . $row['debut'] . '</td>';
        echo '<td>' . $row['fin'] . '</td>';
        echo '<td>' . $row['categorie_id'] . '</td>';
        echo '<td>' . $row['priorite_id'] . '</td>';
        echo '<td>';
        echo '<a href="modifier_tache.php?id=' . $row['id'] . '" class="btn-edit">Modifier</a>';
        echo '<a href="supprimer_tache.php?id=' . $row['id'] . '" class="btn-delete">Supprimer</a>';
        echo '</td>';
        echo '</tr>';
      }

      echo '</table>';
    } else {
      echo "Aucune tâche trouvée.";
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($connexion);
    ?>
  </div>
</body>
</html>
