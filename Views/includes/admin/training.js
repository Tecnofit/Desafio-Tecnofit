$(document).ready(function(){
	$(document).on("click", "#new-training, .edit-training", function() {
		$("#modal-training").css("display", "block");
		$(".modal .modal-msg").css("display", "none");

		if(typeof $(this).data("id") !== "undefined") {
			$("#modal-training .modal-title").text("Editar Treino");
			$("#modal-training input[name='id']").val($(this).data("id"));

			$.ajax({
				method: "GET",
				url: localStorage.getItem("BASE_PROJECT") + "admin/training/get-training",
				data: {
					id: $(this).data("id"),
					return: "JSON"
				},
				dataType: 'json'
			}).done(function(data) {
				$("#modal-training input[name='name']").val(data.name);
				$("#modal-training input[name='login']").val(data.login);
				$("#modal-training input[name='pass']").val("");
			});
		} else {
			$("#modal-training .modal-title").text("Novo Treino");
			$("#modal-training input[name='id']").val("");
			$("#modal-training input[name='name']").val("");
			$("#modal-training input[name='login']").val("");
			$("#modal-training input[name='pass']").val("");
		}

		var divBackground = document.createElement("div");
		$(divBackground).attr("id", "block-body");
		$("body").append(divBackground);
	});

	$(document).on("click", ".link-exercise", function() {
		$("#modal-training-exercises").css("display", "block");
		$(".modal .modal-msg").css("display", "none");

		$("#modal-training-exercises input[name='id']").val($(this).data("id"));
		var name = $(this).parents("tr").find("td:first").text();
		$("#modal-training-exercises .modal-title span").text(name + " - Exercícios");

		$.ajax({
			method: "GET",
			url: localStorage.getItem("BASE_PROJECT") + "admin/training/get-training-exercise",
			data: {
				id: $(this).data("id"),
				return: "JSON"
			},
			dataType: 'json'
		}).done(function(data) {
			$("#modal-training-exercises .modal-content").html(data.htmlExercises);

			$("#modal-training-exercises select[name='exercise']").empty().append($("<option value=''>Selecione o Exercício</option>"));

			$.each(data.listExercises, function(i, value) {
				$("#modal-training-exercises select[name='exercise']").append($("<option></option>").val(value.id).text(value.name));
			});
			$("#modal-training-exercises input[name='session']").val("");
		});

		var divBackground = document.createElement("div");
		$(divBackground).attr("id", "block-body");
		$("body").append(divBackground);
	});

	$(document).on("click", ".add-exercise", function() {
		// event.preventDefault();

		if($("#modal-training-exercises input[name='session']").val() == "") {
			return false;
		}
		if($("#modal-training-exercises select[name='exercise'] option:selected").val() == "") {
			return false;
		}

		$.ajax({
			method: "POST",
			url: localStorage.getItem("BASE_PROJECT") + "admin/training/link-exercise",
			data: {
				id_training: $("#modal-training-exercises input[name='id']").val(),
				id_exercise: $("#modal-training-exercises select[name='exercise'] option:selected").val(),
				session: $("#modal-training-exercises input[name='session']").val(),
			},
			dataType: 'json'
		}).done(function(data) {
			$("#modal-training-exercises .modal-content").html(data.htmlExercises);
			$(".training-list").html(data.html);

			$("#modal-training-exercises select[name='exercise']").empty().append($("<option value=''>Selecione o Exercício</option>"));
			$.each(data.listExercises, function(i, value) {
				$("#modal-training-exercises select[name='exercise']").append($("<option></option>").val(value.id).text(value.name));
			});
			$("#modal-training-exercises input[name='session']").val("");
		});
	});

	$(document).on("click", ".remove-exercise", function() {
		// event.preventDefault();

		$.ajax({
			method: "POST",
			url: localStorage.getItem("BASE_PROJECT") + "admin/training/remove-exercise",
			data: {
				id: $(this).data("id"),
				id_training: $("#modal-training-exercises input[name='id']").val(),
			},
			dataType: 'json'
		}).done(function(data) {
			$("#modal-training-exercises .modal-content").html(data.htmlExercises);
			$(".training-list").html(data.html);

			$("#modal-training-exercises select[name='exercise']").empty().append($("<option value=''>Selecione o Exercício</option>"));
			$.each(data.listExercises, function(i, value) {
				$("#modal-training-exercises select[name='exercise']").append($("<option></option>").val(value.id).text(value.name));
			});
			$("#modal-training-exercises input[name='session']").val("");
		});
	});

	$(document).on("click", "#block-body", function() {
		$(".modal").css("display", "none");
		$("#block-body").remove();
	});

	$(document).on("click", ".remove-training", function() {
		var name = $(this).parents("tr").find("td:first").text();
		if(confirm("Tem certeza que deseja remove o Treino " + name)) {
			$.ajax({
				method: "POST",
				url: localStorage.getItem("BASE_PROJECT") + "admin/training/remove-training",
				data: {
					id: $(this).data("id")
				},
				dataType: 'json'
			}).done(function(data) {
				$(".body-msg").text(data.msg).css("display", "block");

				if(data.result == true) {
					$(".training-list").html(data.html);
				}
			});
		}
	});

	$("#form-training").on("submit", function(event) {
		event.preventDefault();

		$.ajax({
			method: "POST",
			url: $(this).attr("action"),
			data: {
				id: $("#modal-training input[name='id']").val(),
				login: $("#modal-training input[name='login']").val(),
				pass: $("#modal-training input[name='pass']").val(),
				name: $("#modal-training input[name='name']").val(),
			},
			dataType: 'json'
		}).done(function(data) {
			if(data.result == true) {
				$("#modal-training").css("display", "none");
				$("#block-body").remove();

				$(".body-msg").text(data.msg).css("display", "block");
				$(".training-list").html(data.html);
			} else {
				$(".modal .modal-msg").text(data.msg).css("display", "block");
			}
		});
	})
});