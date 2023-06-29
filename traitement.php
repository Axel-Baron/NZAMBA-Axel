<?php
// Connexion à la base de données
$connexion = mysqli_connect("localhost", "root", "", "gestion_de_tache");
if (!$connexion) {
  die("Erreur de connexion à la base de données: " . mysqli_connect_error());
}

// Récupération des données du formulaire
$titre = $_POST['titre'];
$description = $_POST['description'];
$debut = $_POST['debut'];
$fin = $_POST['fin'];
$categorie_id = $_POST['categorie'];
$priorite_id = $_POST['priorite'];

// Requête d'insertion dans la table "taches"
$insertQuery = "INSERT INTO taches (titre, description, debut, fin, categorie_id, priorite_id)
               VALUES ('$titre', '$description', '$debut', '$fin', '$categorie_id', '$priorite_id')";
if (mysqli_query($connexion, $insertQuery)) {
  echo "Les données ont été enregistrées avec succès.";
} else {
  echo "Erreur lors de l'enregistrement des données: " . mysqli_error($connexion);
}
// ...
if (mysqli_query($connexion, $insertQuery)) {
    // Redirection vers la page suivi_de_taches.php
    header("Location: suivi_de_taches.php");
    exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
  } else {
    echo "Erreur lors de l'enregistrement des données: " . mysqli_error($connexion);
  }
  // ...
  
// Fermeture de la connexion à la base de données
mysqli_close($connexion);
?>
