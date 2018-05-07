jQuery(document).ready(function() {
	$(".deleteBook").on('click', function(event) {
		event.preventDefault();
		if (window.confirm("Voulez-vous vraiment supprimé ce livre?")) { 
		  window.alert("Livre supprimé");
			/* Act on the event */
			// var bookValue = $(this).attr("data-idBook");
			// $.ajax({
			// 	url: 'deleteBook.php',
			// 	type: 'POST',
			// 	data: {idBook: bookValue},
			// })
			// .done(function() {
			// 	console.log("success");
			// })
			// .fail(function() {
			// 	console.log("error");
			// })
			$(this).parent().parent().addClass("hidden");
		}
		
	});

	$(".editBook").on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
			bookValue = $(this).attr("data-idBook");
			$.ajax({
				url: 'searchBook.php',
				type: 'POST',
				data: {idBook: bookValue},
			})
			.done(function(livre) {
				$(".modal").modal('show');
				$("#ISBN").val(livre["ISBN"]);
				$("#titreLivre").val(livre["titre"]);
				$("#editionLivre").val(livre["edition"]);
				$("#nomAuteur").val(livre["nomAuteur"]);
				$("#prenomAuteur").val(livre["prenomAuteur"]);
				$("#etatLivreEdit").val(livre["etat"]);
			})
			.fail(function() {
				console.log("error");
			})
		
	});

	$(".confirmEditBook").on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		$(".modal").modal('hide');

		var ISBN = $("#ISBN").val();
		var titreLivre = $("#titreLivre").val();
		var editionLivre = $("#editionLivre").val();
		var nomAuteur = $("#nomAuteur").val();
		var prenomAuteur = $("#prenomAuteur").val();
		var etatLivreEdit = $("#etatLivreEdit").val();

		$.ajax({
				url: 'editBook.php',
				type: 'POST',
				data: {
					ancienISBN: bookValue,
					ISBN: ISBN,
					titreLivre: titreLivre,
					editionLivre: editionLivre,
					nomAuteur: nomAuteur,
					prenomAuteur: prenomAuteur,
					etatLivreEdit: etatLivreEdit
				},
			})
			.done(function(livre) {

			})
			.fail(function() {
				console.log("error");
			})
	});

});