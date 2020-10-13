<?php


if(isset ($_POST['forminscri']))
{	
	$pseudo= htmlspecialchars($_POST['pseudo']);
		$mail= htmlspecialchars($_POST['mail']);
		$mail2= htmlspecialchars($_POST['mail2']);
		$mdp= sha1($_POST['mdp']);
		$mdp2= sha1($_POST['mdp2']);

	if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
	{

		$pseudolenght= strlen($pseudo);
			if($pseudolenght <= 255){	
				if($mail == $mail2){
					if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
						$reqpseudo=$bdd->prepare("SELECT * FROM membre WHERE pseudo = ?");
						$reqpseudo->execute(array($pseudo));
						$pseudoexist = $reqpseudo->rowCount();
						if($pseudoexist == 0){
							
						
					if($mdp == $mdp2){
						$insertmbr= $bdd->prepare("INSERT INTO membre (pseudo, mail, motdepasse) VALUES(?, ?, ?)");
						$insertmbr->execute(array($pseudo, $mail, $mdp));
						$erreur="Votre compte à bien été crée";		
						header('location: index.html');

						
					}
					
					else { 
					$erreur = " Vos mots de passe ne matchent pas !";
					}
						}else{
							$erreur ="pseudo deja use !";
						}
					}
					else {
						$erreur =" Votre adresse mail n'est pas valide !";
					}
				}
				else{
					$erreur = "Vos mails ne matchent pas !";
				}
			}
			else{
				$erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
			}
	}
	else{
		$erreur= "Tous les champs doivent etre remplis !";
	}
}

?>
<html>
	<head>
		<title>php espace membre</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./css/main.css">
	</head>
	<body>
		<div align="center">
			<h2>Inscription</h2>
			<br><br> 
			<form method="POST" action="">
				<table>
					<tr>	
						<td align="right">
							<label for="pseudo">Pseudo :</label>
						</td>
						<td>
							<input type="text"
							placeholder="Tapez votre pseudo" 
							id="pseudo"
							name="pseudo"
							value= "<?php if (isset($pseudo)) {echo "$pseudo";}?>"/>
						</td>
					</tr>
					<tr>	
						<td align="right">
							<label for="mail">Mail :</label>
						</td>
						<td>
							<input type="email"
							placeholder="Votre adresse mail" 
							id="mail"
							name="mail" 
							value= "<?php if (isset($mail)) {echo "$mail";}?>"/>
						</td>
					</tr>
					<tr>	
						<td align="right">
							<label for="mail2">Confirmation du mail :</label>
						</td>
						<td>
							<input type="email"
							placeholder="Confirmez votre mail" 
							id="mail2"
							name="mail2" 
							value= "<?php if (isset($mail2)) {echo "$mail2";}?>"/>
						</td>
					</tr>
					<tr>	
						<td align="right">
							<label for="mdp">Mot de passe :</label>
						</td>
						<td>
							<input type="password"
							placeholder="Votre mot de passe" 
							id="mdp"
							name="mdp" 
							
						</td>
					</tr>
					<tr>	
						<td align="right">
							<label for="mdp2">Confirmez mot de passe :</label>
						</td>
						<td>
							<input type="password"
							placeholder="Confirmez votre passe"
							id="mdp2"
							name="mdp2" 
							
						</td>
					</tr>
				</table> <br>	
				<input type="submit" name= "forminscri"value="Je m'inscris"/>
				
			</form>
			<?php
				if (isset($erreur)){
					echo '<font color="red">' .$erreur. '</font>';
				}
									
			?>
		</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<footer>Tous droits réservés YAGASSA Koolah &copy; 2020</footer>

	</body>
</html>
