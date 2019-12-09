(function($) {
	function InitializeOccurences($element_words_backup){
		words = $element_words_backup.val().split(',');
		
		// on vérifie que le dernier élement n'est pas un espace vide, si s'en est un un l'enlève
		a = words.pop();
		if (a != ''){
			words.push(a);
		}

		return words;
	}
	function wordsOccurences( $element, words ){
		occurences = [];
		$.each(words, function( index, word ) {
			occurence = wordOccurences( $element, word.toLowerCase() );
			// upperCaseoccurences = wordOccurences( capitalize(word) );
		    occurences.push( occurence );
		});
		return occurences;
	}
	function wordOccurences( $element, word ) {
		return $element[0].value.toLowerCase().split(word).length -1;
	};


	function showOccurences($element_tracked, $element_response, words){
		$element_response.html('');
		occurences = wordsOccurences( $element_tracked, words );
		$.each(words, function( index, word ) {
			$element_response.append('<span>'+word+' <span class="number">'+occurences[index]+'</span></span>');
		});
		$element_response.append('<span id="plus">+</span>');
	}

	addTrackedWord = function(word) {
		words.push(word);
		wordsval = $words.attr('value');
		if(wordsval == undefined){
			wordsval = '';
		}
		$words.attr('value', wordsval + word + ',');
	}

	$elem = $( '#markdown' );
	$elem_response = $('#result');
	$words = $('#words');
	words = InitializeOccurences($words);
	showOccurences($elem, $elem_response, words); //Initialisation
	$('#markdown').on('keyup', function(){
		setTimeout(function(){
			showOccurences($elem, $elem_response, words);
		}, 200);
	});

	/* Modal */
	$modal = $('#mymodal');
	$modal.hide();
	$elem_response.on('click', '#plus', function() {
		$modal.show();
	})
	$modal.on('click', '.close', function(){
		$modal.hide();
	});
	$modal.on('click', '.add', function(e){
		e.stopPropagation();
		if ($('#mymodal input').val() != ''){
			addTrackedWord($('#mymodal input').val())
			showOccurences($elem, $elem_response, words);
			$('#mymodal input').val('');
		}
		
	});

	$.each(words, function( index, word ) {
		if(index >= 1){
			wordsval = $words.attr('value');
			if(wordsval == undefined){
				wordsval = '';
			}
		}else{
			wordsval = '';
		}
		
		$words.attr('value', wordsval + word + ',');
	});

})(jQuery);