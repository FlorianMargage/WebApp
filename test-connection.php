<?php
try {
    $pdo = new PDO('mysql:host=mysql-fmargage.alwaysdata.net;dbname=fmargage_anime', 'fmargage', 'root11092002');
    echo "Connexion réussie à la base de données.";

    // Requête SELECT
    $query = 'SELECT * FROM animes';
    $stmt = $pdo->query($query);

    // Récupérer les résultats
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Utiliser les données récupérées
        // $row contient les colonnes de la table sous forme d'associations clé-valeur
        // Par exemple, $row['colonne1'], $row['colonne2'], etc.
        // Vous pouvez afficher les données ou effectuer d'autres opérations ici
        print_r($row);
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
