(function($){

	if( $.cookie('cookiebar') === undefined ) {
		$.cookie('cookiebar', "viewed", { expires: 30*12 });
		$('body').append('<div class="cookie" id="cookie">En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de cookies pour réaliser des statistiques de visites annonymes.<a rel="nofollow" href="https://policies.google.com/technologies/cookies?hl=fr">en savoir plus</a><div class="cookie_btn" id="cookie_btn" href="#">Ok</div></div>');
		$('#cookie_btn').on('click', function(e) {
			$('#cookie').fadeOut();
		});
	}


})(jQuery);