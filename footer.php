<footer id="footer" class="top-space">

		<div class="footer1">
			<div class="container">
				<div class="row">
					
					<div class="col-md-3 widget">
						<h3 class="widget-title" id="contact">Contact</h3>
						<div class="widget-body">
							<p>+337 12 23 55 66<br>
								<a href="mailto:#">miobr@bibliopmf.fr</a><br>
								<br>
								90 rue Tolbiac 75013 Paris
							</p>	
						</div>
					</div>

					<div class="col-md-3 widget">
						<h3 class="widget-title">Follow us</h3>
						<div class="widget-body">
							<p class="follow-me-icons">
								<a href=""><i class="fa fa-twitter fa-2"></i></a>
								<a href=""><i class="fa fa-dribbble fa-2"></i></a>
								<a href=""><i class="fa fa-github fa-2"></i></a>
								<a href=""><i class="fa fa-facebook fa-2"></i></a>
							</p>	
						</div>
					</div>

					<div class="col-md-6 widget">
						<div class="widget-body">
							<h4>Nombre de visiteurs :</h4>
							<p><?php include "visiteurs.php"; ?></p>
							
							<?php
								if(isset($_SESSION["idUser"])){
									$heureConnexion = $_SESSION["timeConnect"];
									$diff = abs(strtotime(date("H:i:s")) - strtotime($heureConnexion));
									$tempsConnexion = intval($diff / 60);
							?>
									<h4>Temps de connexion :</h4>
									<p>Vous êtes connecté depuis <?php echo $tempsConnexion; ?> minutes</p>
							<?php 
								}
							?>
						</div>
					</div>

				</div> 
			</div>
		</div>

		<div class="footer2">
			<div class="container">
				<div class="row">

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="text-right">
								Copyright &copy; 2018, MioBr.
							</p>
						</div>
					</div>

				</div> 
			</div>
		</div>

	</footer>	