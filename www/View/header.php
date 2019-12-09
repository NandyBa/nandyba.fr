<header id="header">
	<span><a title="" href="https://nandyba.fr">Nandyba.fr</a></span>
	<nav class="links">
		<ul>
			<li><a title="accéder au blog" href="https://nandyba.fr/blog/">Blog</a></li>
			<li><a title="revenir à l'accueil" href="https://nandyba.fr">Accueil</a></li>
			
			<li><a title="me contacter" rel="nofollow" href="mailto:contact@nandyba.fr">Contact</a></li>
			<?php if($this->backoffice == true): ?>
			<li><a rel="nofollow" href="https://nandyba.fr/backoffice/">Backoffice</a></li>

			<?php endif; ?>
		</ul>
	</nav>
	<nav class="main">
		<ul>
			<!-- <li class="search">
				<a title="faire une recherche" class="fa-search" href="#search">Search</a>
				<form id="search" method="get" action="#">
					<input type="text" name="query" placeholder="Search" />
				</form>
			</li> -->
			<li class="menu">
				<a title="menu" class="fa-bars" href="#menu" style="color: rgba(0,0,0,0.7);">Menu</a>
			</li>
		</ul>
	</nav>
</header>

<!-- Menu -->
<nav id="menu">

	<!-- Search -->
	<!-- 	<section>
			<form class="search" method="get" action="#">
				<input type="text" name="query" placeholder="Search" />
			</form>
		</section> -->

	<!-- Links -->
		<div>
			<ul class="links">
				<li>
					<a title="accéder au blog" href="https://nandyba.fr/blog/">
						<span>Blog</span>
					</a>
				</li>
<!-- 				<li>
					<a title="revenir à l'accueil"  href="https://nandyba.fr">
						<span>Acceuil</span>
					</a>
				</li> -->
				<li>
					<a title="me contacter" rel="nofollow" href="mailto:contact@nandyba.fr">
						<span>Contact</span>
					</a>
				</li>
			</ul>
		</div>
		<?php if($this->backoffice == true): ?>
		<div>
			<ul class="links">
				<li>
					<a rel="nofollow" href="https://nandyba.fr/backoffice/">Backoffice</a>
				</li>
				<li>
					<a rel="nofollow" href="https://nandyba.fr/backoffice/article.php">Crée un nouvel article</a>
				</li>
			</ul>
		</div>

		<?php endif; ?>
</nav>