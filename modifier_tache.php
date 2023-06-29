<?php
// Connexion à la base de données
$connexion = mysqli_connect("localhost", "root", "", "gestion_de_tache");
if (!$connexion) {
  die("Erreur de connexion à la base de données: " . mysqli_connect_error());
}

// Vérification si l'ID de la tâche est passé en paramètre
if(isset($_GET['id'])) {
  $id = $_GET['id'];

  // Récupération des données de la tâche à modifier
  $selectQuery = "SELECT * FROM taches WHERE id = $id";
  $result = mysqli_query($connexion, $selectQuery);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $titre = $row['titre'];
    $description = $row['description'];
    $debut = $row['debut'];
    $fin = $row['fin'];
    $categorie_id = $row['categorie_id'];
    $priorite_id = $row['priorite_id'];
  } else {
    echo "Tâche introuvable.";
    exit();
  }
} else {
  echo "ID de tâche non spécifié.";
  exit();
}

// Vérification si le formulaire a été soumis pour la mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupération des nouvelles valeurs des champs
  $titre = $_POST['titre'];
  $description = $_POST['description'];
  $debut = $_POST['debut'];
  $fin = $_POST['fin'];
  $categorie_id = $_POST['categorie'];
  $priorite_id = $_POST['priorite'];

  // Requête de mise à jour de la tâche
  $updateQuery = "UPDATE taches SET titre = '$titre', description = '$description', debut = '$debut', fin = '$fin', categorie_id = '$categorie_id', priorite_id = '$priorite_id' WHERE id = $id";
  if (mysqli_query($connexion, $updateQuery)) {
    echo "La tâche a été mise à jour avec succès.";
  } else {
    echo "Erreur lors de la mise à jour de la tâche: " . mysqli_error($connexion);
  }
}

// Fermeture de la connexion à la base de données
mysqli_close($connexion);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Modifier une tâche</title>
  <style>
    /* ... styles CSS ... */
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
    <a href="rechercher.php">recherche</a>
    <a href="suivi_de_taches.php">suivi</a>
    <a href="recherche_taches.php">recherche tache</a>
    
  </div>
  <div class="container">
    <h2>Modifier une tâche</h2>
    <form action="modifier_tache.php?id=<?php echo $id; ?>" method="POST">
      <div class="form-group">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" value="<?php echo $titre; ?>" required>
      </div>
      <div class="form-group">
        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?php echo $description; ?></textarea>
      </div>
      <div class="form-group">
        <label for="debut">Date de début :</label>
        <input type="datetime-local" id="debut" name="debut" value="<?php echo $debut; ?>" required>
      </div>
      <div class="form-group">
        <label for="fin">Date de fin :</label>
        <input type="datetime-local" id="fin" name="fin" value="<?php echo $fin; ?>" required>
      </div>
      <div class="form-group">
        <label for="categorie">Catégorie :</label>
        <select id="categorie" name="categorie" required>
          <option value="">Sélectionnez une catégorie</option>
          <!-- ... Options des catégories ... -->
        </select>
      </div>
      <div class="form-group">
        <label for="priorite">Priorité :</label>
        <select id="priorite" name="priorite" required>
          <option value="">Sélectionnez une priorité</option>
          <!-- ... Options des priorités ... -->
        </select>
      </div>
      <div class="form-group">
        <button type="submit">Enregistrer les modifications</button>
      </div>
    </form>
  </div>
</body>
</html>
