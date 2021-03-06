<h1>Formulaire de contact</h1>

<?php
if (isset($_POST['frmcontact'])) {

  $nom = checkInput($_POST['nom']);
  $prenom = checkInput($_POST['prenom']);
  $mail = checkInput($_POST['mail']);
  $tel = checkInput($_POST['tel']);
  $msg = checkInput($_POST['msg']);
  $erreur = array();
  if ($nom === "")
    array_push($erreur, "Veuillez saisir votre nom");
  if ($prenom === "")
    array_push($erreur, "Veuillez saisir un prénom");
  if ($mail === "")
    array_push($erreur, "Veuillez saisir une adresse mail");
  if ($tel === "")
    array_push($erreur, "Veuillez saisir un numéro de téléphone");
  if ($msg === "")
    array_push($erreur, "Veuillez saisir un message");
  if (count($erreur) > 0) {
    $message = '<ul>';
    for($i = 0 ; $i < count($erreur) ; $i++) {
      $message .= '<li>';
      $message .= $erreur[$i];
      $message .= '</li>';
    }
    $message .= '</ul>';
    echo $message;
    require 'frmcontact.php';
  }
  else {
    $sqlVerif = "SELECT COUNT(*) FROM clients";

        $sql = "INSERT INTO clients (nom, prenom, mail, tel, msg) VALUES ('" . $nom . "', '" . $prenom . "', '" . $mail ."', '" . $tel ."', '" . $msg ."')";
        $query = $pdo->prepare($sql);
        $query->bindValue('nom', $nom, PDO::PARAM_STR);
        $query->bindValue('prenom', $prenom, PDO::PARAM_STR);
        $query->bindValue('mail', $mail, PDO::PARAM_STR);
        $query->bindValue('tel', $tel, PDO::PARAM_STR);
        $query->bindValue('msg', $msg, PDO::PARAM_STR);
        $query->execute();

        echo $sql;
        echo "Enregistrement OK";

  }
}
else {
  $nom = $prenom = $mail = $tel = $msg = "";
  require 'frmcontact.php';
}
