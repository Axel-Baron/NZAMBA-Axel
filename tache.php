<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Formulaire de saisie</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .container h2 {
      text-align: center;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="datetime-local"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-group select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-group button {
      padding: 10px 20px;
      background-color: #4CAF50;
      border: none;
      color: #fff;
      cursor: pointer;
      border-radius: 4px;
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
    <a href="recherher.php">rechercher</a>
    <a href="suivi_de_taches.php">suivi</a>
    <a href="recherche_taches.php">taches rechercher</a>
  </div>
  <div class="container">
    <h2>Formulaire de saisie de tâche</h2>
    <form action="traitement.php" method="POST">
      <div class="form-group">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required>
      </div>
      <div class="form-group">
        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea>
      </div>
      <div class="form-group">
        <label for="debut">Date de début :</label>
        <input type="datetime-local" id="debut" name="debut" required>
      </div>
      <div class="form-group">
        <label for="fin">Date de fin :</label>
        <input type="datetime-local" id="fin" name="fin" required>
      </div>
      <div class="container">
    <h2>Formulaire de saisie de tâche</h2>
    <form action="traitement.php" method="POST">
      <!-- ... autres champs de formulaire ... -->
      <div class="form-group">
        <label for="categorie">Catégorie :</label>
        <select id="categorie" name="categorie" required>
          <option value="">Sélectionnez une catégorie</option>
          <?php
          // Connexion à la base de données
          $connexion = mysqli_connect("localhost", "root", "", "gestion_de_tache");
          if (!$connexion) {
            die("Erreur de connexion à la base de données: " . mysqli_connect_error());
          }
          
          // Récupération des catégories depuis la table "categories"
          $requeteCategories = mysqli_query($connexion, "SELECT id, nom FROM categories");
          if (mysqli_num_rows($requeteCategories) > 0) {
            while ($categorie = mysqli_fetch_assoc($requeteCategories)) {
              echo '<option value="' . $categorie["id"] . '">' . $categorie["nom"] . '</option>';
            }
          }
          mysqli_free_result($requeteCategories);
          
          // Fermeture de la connexion à la base de données
          mysqli_close($connexion);
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="priorite">Priorité :</label>
        <select id="priorite" name="priorite" required>
          <option value="">Sélectionnez une priorité</option>
          <?php
          // Connexion à la base de données (réutilisation de la connexion précédente)
          $connexion = mysqli_connect("localhost", "root", "", "gestion_de_tache");
          if (!$connexion) {
            die("Erreur de connexion à la base de données: " . mysqli_connect_error());
          }
          
          // Récupération des priorités depuis la table "priorites"
          $requetePriorites = mysqli_query($connexion, "SELECT id, nom FROM priorites");
          if (mysqli_num_rows($requetePriorites) > 0) {
            while ($priorite = mysqli_fetch_assoc($requetePriorites)) {
              echo '<option value="' . $priorite["id"] . '">' . $priorite["nom"] . '</option>';
            }
          }
          mysqli_free_result($requetePriorites);
          
          // Fermeture de la connexion à la base de données
          mysqli_close($connexion);
          ?>
        </select>
      </div>
      <div class="form-group">
        <button type="submit">Enregistrer</button>
      </div>
    </form>
  </div>
</body>
</html>
