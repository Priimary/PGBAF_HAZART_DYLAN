<?php
    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true)
        {
?> 
			<div class="logo-gbaf-connected-container">
				<a href="index.php"><img src="img/logo_gbaf.png" alt="logo gbaf"></a>	
			</div>
			<div class="nav-menu-header-container">
				<nav class="nav-menu-header">
					<li class="dropdown"><a id="nomprenomheader"><?php echo $_SESSION['nom']," ", $_SESSION['prenom']; ?></a>
						<ul class="submenu">
							<li><a href="account.php">Gestion du compte</a></li>
							<li><a href="disconnect.php">Déconnexion</a></li>
						</ul>
					</li>
				</nav>		
			</div>
			<?php
		}
	else
		{
			?>
			<a class="logo-gbaf-disconnected-container" href="index.php"><img class="logo-gbaf-disconnected" src="img/logo_gbaf.png" alt="logo gbaf"></a>
			<?php
		}
			?>
