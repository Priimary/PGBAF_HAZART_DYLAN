<?php
    session_start();
    if($_SESSION['loggedIn'] = true)
        {
           ?> 
			<div class="logo-gbaf-connected-container">
				<a href="index.php"><img src="img/logo_gbaf.png" alt="logo gbaf"></a>	
			</div>
			<div class="nav-menu-header-container">
				<nav class="nav-menu-header">
					<li class="dropdown"><a id="nomprenomheader"><?php echo $_SESSION['nom']," ", $_SESSION['prenom']; ?></a>
						<ul class="submenu">
							<li><a href="lien-gestion-compte">Gestion du compte</a></li>
							<li><a href="lien-deconnexion">Déconnexion</a></li>
						</ul>
					</li>
				</nav>		
			</div>
			<?php
		}
	else
		{
			?>
			<a class="logo-gbaf-disconnected" href="index.php"><img class="logo-gbaf-disconnected" src="img/logo_gbaf.png" alt="logo gbaf"></a>
			<?php
		}
			?>
