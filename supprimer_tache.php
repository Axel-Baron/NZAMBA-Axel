<?php
// Connexion à la base de données
$connexion = mysqli_connect("localhost", "root", "", "gestion_de_tache");
if (!$connexion) {
  die("Erreur de connexion à la base de données: " . mysqli_connect_error());
}

// Vérification si l'ID de la tâche est passé en paramètre
if(isset($_GET['id'])) {
  $id = $_GET['id'];

  // Suppression de la tâche
  $deleteQuery = "DELETE FROM taches WHERE id = $id";
  if (mysqli_query($connexion, $deleteQuery)) {
    echo "La tâche a été supprimée avec succès.";
  } else {
    echo "Erreur lors de la suppression de la tâche: " . mysqli_error($connexion);
  }
} else {
  echo "ID de tâche non spécifié.";
  exit();
}

// Fermeture de la connexion à la base de données
mysqli_close($connexion);
?>
