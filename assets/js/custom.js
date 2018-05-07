jQuery(document).ready(function() {
addListerner();

	function addListerner(){
	
		$(".deleteBook").on('click', function(event) {
			event.preventDefault();
			if (window.confirm("Voulez-vous vraiment supprimé ce livre?")) { 
			  window.alert("Livre supprimé");
				/* Act on the event */
				var bookValue = $(this).attr("data-idBook");
				$.ajax({
					url: 'deleteBook.php',
					type: 'POST',
					data: {idBook: bookValue},
				})
				.done(function() {
					console.log("success");
				})
				.fail(function() {
					console.log("error");
				})
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
					$(".modalEdit").modal('show');
					$("#ISBN").val(livre["ISBN"]);
					$("#titreLivre").val(livre["titre"]);
					$("#editionLivre").val(livre["edition"]);
					$("#nomAuteur").val(livre["nomAuteur"]);
					$("#prenomAuteur").val(livre["prenomAuteur"]);
					$("#etatLivreEdit").val(livre["etat"]);
				})
				.fail(function(err) {
					console.log("error");
				})
			
		});
	}
	$(".confirmEditBook").on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		$(".modalEdit").modal('hide');
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
				if(livre["error"] != undefined){
					alert(livre["error"]);
				}else{
					$(".editBook").each(function(index) {
						//On prend la valeur du ISBN du livre auquel on a modifié, on veut changer uniquement cette ligne
						if($(this).attr('data-idbook') == bookValue){
							console.log($(this).attr('data-idbook'));
							$(this).attr('data-idbook', livre["ISBN"]);
							$(this).parent().children(".deleteBook").attr('data-idbook', livre["ISBN"]);
							$(this).parent().parent().children(".ISBN_Livre").text(livre["ISBN"]);
							$(this).parent().parent().children(".titre_Livre").text(livre["titre"]);
							$(this).parent().parent().children(".edition_Livre").text(livre["edition"]);
							$(this).parent().parent().children(".idAuteur_livre").text(livre["prenomAuteur"] + " " + livre["nomAuteur"]);
							console.log(livre["ISBN"]);
							if(livre["etat"] == "Disponible"){
								color = "green";
							}else if(livre["etat"] == "Non Disponible"){
								color = "red";
							}else if (livre["etat"] == "Commandé"){
								color = "orange";
							}
							$(this).parent().parent().children(".etat_Livre").text(livre["etat"]);
							$(this).parent().parent().children(".etat_Livre").css("color", color);
						}
					});
				}
				
				
			})
			.fail(function(err) {
				console.log(err);
			})
	});



	$(".addBook").on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		$(".modalAdding").modal('show');
	});

	$(".confirmAddingBook").on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		$(".modalAdding").modal('hide');
		var ISBNAdding = $("#ISBNAdding").val();
		var titreLivreAdding = $("#titreLivreAdding").val();
		var editionLivreAdding = $("#editionLivreAdding").val();
		var nomAuteurAdding = $("#nomAuteurAdding").val();
		var prenomAuteurAdding = $("#prenomAuteurAdding").val();
		var etatLivreAdding = $("#etatLivreAdding").val();

		$.ajax({
				url: 'addingBook.php',
				type: 'POST',
				data: {
					ISBNAdding: ISBNAdding,
					titreLivreAdding: titreLivreAdding,
					editionLivreAdding: editionLivreAdding,
					nomAuteurAdding: nomAuteurAdding,
					prenomAuteurAdding: prenomAuteurAdding,
					etatLivreAdding: etatLivreAdding
				},
			})
			.done(function(livre) {
				if(livre["error"] != undefined){
					alert(livre["error"]);
				}else{

					addManage = "<td> <i data-idBook='" + livre["ISBN"] + "' class='fa fa-edit editBook' style='cursor:pointer;'></i> <i class='fa fa-times deleteBook' data-idBook='" + livre["ISBN"] + "' style='color:red; padding-left:20px; cursor:pointer;'></i> </td>";
					if(livre["etat"] == "Disponible"){
						livreEtat = 'green;';
					}else if(livre["etat"] == "Non Disponible"){
						livreEtat = 'red;';
					}else if(livre["etat"] == "Commandé"){
						livreEtat = 'orange;';
					}
					
					$("table").append('<tr style="background-color:#52D017;" data-idbook = ' + livre["ISBN"] + '><td class="ISBN_Livre">'+ livre["ISBN"] +'</td><td class="titre_Livre">'+ livre["titre"] +'</td><td class="edition_Livre">'+ livre["edition"] +'</td><td class="idAuteur_livre">'+ livre["prenomAuteur"] + " " + livre["nomAuteur"] +'</td><td style="color:' + livreEtat + '" class="etat_Livre">'+ livre["etat"] +'</td>' + addManage + '</tr>');
					setTimeout(function(){
						$("tr").css('background-color', 'white');
					},2000);
				}

				addListerner();
				
			})
			.fail(function(err) {
				console.log(err);
			})
	});

});