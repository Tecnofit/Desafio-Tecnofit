$(document).ready(function(){

	$(document).on("click", ".play-training", function() {

		$.ajax({
			method: "POST",
			url: localStorage.getItem("BASE_PROJECT") + "athlete/play-training",
			data: {
				id: $(this).data("id")
			},
			dataType: 'json'
		}).done(function(data) {
			if(data.result) {
				window.location.href = localStorage.getItem("BASE_PROJECT") + "athlete/execute-training";
			}
		});
	});

	$(document).on("click", "#finish-session", function() {
		$.ajax({
			method: "POST",
			url: localStorage.getItem("BASE_PROJECT") + "athlete/finish-session",
			data: {
				id_user: $(this).data("user"),
				id_training: $(this).data("training"),
				id_exercise: $(this).data("exercise")
			},
			dataType: 'json'
		}).done(function(data) {
			console.log(data);
			$("#training-content").html(data.html);
		});
	});

	$(document).on("click", "#finish-exercise", function() {
		if(confirm("Tem certeza que deseja finalizar o exercício e completar todas as sessões?")) {
			$.ajax({
				method: "POST",
				url: localStorage.getItem("BASE_PROJECT") + "athlete/finish-exercise",
				data: {
					id_user: $(this).data("user"),
					id_training: $(this).data("training"),
					id_exercise: $(this).data("exercise")
				},
				dataType: 'json'
			}).done(function(data) {
				console.log(data);
				$("#training-content").html(data.html);
			});
		}
	});


	$(document).on("click", "#skip-exercise", function() {
		if(confirm("Tem certeza que deseja pular o exercício e sem completar todas as sessões?")) {
			$.ajax({
				method: "POST",
				url: localStorage.getItem("BASE_PROJECT") + "athlete/skip-exercise",
				data: {
					id_user: $(this).data("user"),
					id_training: $(this).data("training"),
					id_exercise: $(this).data("exercise")
				},
				dataType: 'json'
			}).done(function(data) {
				console.log(data);
				$("#training-content").html(data.html);
			});
		}
	});

	$(document).on("click", ".continue-training", function() {
		window.location.href = localStorage.getItem("BASE_PROJECT") + "athlete/execute-training";
	});
});