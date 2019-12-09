$(document).ready(function() {

	function articleMakePresvious(){
		markdown = marked($('#markdown').val());
    	$('#content').html(markdown); 			//On affiche une prévisualisation
		$('#markdown-data').html(markdown); 	//On stocke le code markdown
	}

	articleMakePresvious(); //Au charge l'aperçu au chargement de la page
	$('#markdown').on('keyup', function(){
		setTimeout(function(){
			articleMakePresvious(); //on charge l'aperçu
		}, 200); 	//Pour être sur que toutes les modifications de #markdown soient prise en compte
	});

	length = $('#meta-description').val().length;
	$('#counter').html(length);
		if(length > 200){
		$('#counter').css('color', 'green');	
	}
	if(length >= 130 & length <= 200){
		$('#counter').css('color', 'orange');
	}
	if(length < 130){
		$('#counter').css('color', 'red');
	}

	$('#meta-description').on('keydown', function(){
		length = $('#meta-description').val().length;
		$('#counter').html(length);
			if(length > 200){
			$('#counter').css('color', 'green');	
		}
		if(length >= 130 & length <= 200){
			$('#counter').css('color', 'orange');
		}
		if(length < 130){
			$('#counter').css('color', 'red');
		}
		
	})
  	$('#markdown').keyup(function() {
	 
	    // var nombreCaractere = $(this).val().length;
	 
	    var nombreMots = jQuery.trim($(this).val()).split(' ').length;
	    if($(this).val() === '') {
	     	nombreMots = 0;
	    }
	 
	    var msg = nombreMots + ' mot(s) environ';
	    $compteur = $('#compteur');
	    $compteur.text(msg);
    });
    function CountTitleCaractere(){
    	var nombreCaractere = $('#meta-title').val().length;
	    $compteur = $('#compteur-title');
	    $compteur.text(nombreCaractere);
    }
    CountTitleCaractere(); //initialization
    $('#meta-title').keyup(function() {
    	CountTitleCaractere();
    });

    function CountH1Caractere(){
    	var nombreCaractere = $('#title').val().length;
	    $compteur = $('#compteur-h1');
	    $compteur.text(nombreCaractere);
    }
    CountH1Caractere(); //initialization
    $('#title').keyup(function() {
    	CountH1Caractere();
    });
			
});