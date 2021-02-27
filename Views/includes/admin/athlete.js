$(document).ready(function(){
	$(document).on("click", "#new-athlete, .edit-athlete", function() {
		$("#modal-athlete").css("display", "block");
		$(".modal .modal-msg").css("display", "none");

		if(typeof $(this).data("id") !== "undefined") {
			$("#modal-athlete .modal-title").text("Editar Atleta");
			$("#modal-athlete input[name='id']").val($(this).data("id"));

			$.ajax({
				method: "GET",
				url: localStorage.getItem("BASE_PROJECT") + "admin/athlete/get-user",
				data: {
					id: $(this).data("id"),
					return: "JSON"
				},
				dataType: 'json'
			}).done(function(data) {
				$("#modal-athlete input[name='name']").val(data.name);
				$("#modal-athlete input[name='login']").val(data.login);
				$("#modal-athlete input[name='pass']").val("");
			});
		} else {
			$("#modal-athlete .modal-title").text("Novo Atleta");
			$("#modal-athlete input[name='id']").val("");
			$("#modal-athlete input[name='name']").val("");
			$("#modal-athlete input[name='login']").val("");
			$("#modal-athlete input[name='pass']").val("");
		}

		var divBackground = document.createElement("div");
		$(divBackground).attr("id", "block-body");
		$("body").append(divBackground);

	});

	$(document).on("click", "#block-body", function() {
		$(".modal").css("display", "none");
		$("#block-body").remove();
	});

	$(document).on("click", ".remove-athlete", function() {
		var name = $(this).parents("tr").find("td:first").text();
		if(confirm("Tem certeza que deseja remove o Atleta " + name)) {
			$.ajax({
				method: "POST",
				url: localStorage.getItem("BASE_PROJECT") + "admin/athlete/remove-user",
				data: {
					id: $(this).data("id")
				},
				dataType: 'json'
			}).done(function(data) {
				$(".body-msg").text(data.msg).css("display", "block");

				if(data.result == true) {
					$(".athlete-list").html(data.html);
				}
			});
		}
	});

	$(document).on("click", ".link-training", function() {
		$("#modal-training").css("display", "block");
		$(".modal .modal-msg").css("display", "none");

		$("#modal-training input[name='id']").val($(this).data("id"));
		var name = $(this).parents("tr").find("td:first").text();
		$("#modal-training .modal-title span").text(name + " - Treinos");

		$.ajax({
			method: "GET",
			url: localStorage.getItem("BASE_PROJECT") + "admin/athlete/get-trainings",
			data: {
				id: $(this).data("id"),
				return: "JSON"
			},
			dataType: 'json'
		}).done(function(data) {
			$("#modal-training .modal-content").html(data.htmlTrainings);

			$("#modal-training select[name='training']").empty().append($("<option value=''>Selecione o Treino</option>"));
			$.each(data.listTrainings, function(i, value) {
				$("#modal-training select[name='training']").append($("<option></option>").val(value.id).text(value.name));
			});
		});

		var divBackground = document.createElement("div");
		$(divBackground).attr("id", "block-body");
		$("body").append(divBackground);
	});

	$(document).on("click", ".add-training", function() {
		// event.preventDefault();

		if($("#modal-training select[name='training'] option:selected").val() == "") {
			return false;
		}

		$.ajax({
			method: "POST",
			url: localStorage.getItem("BASE_PROJECT") + "admin/athlete/link-training",
			data: {
				id_user: $("#modal-training input[name='id']").val(),
				id_training: $("#modal-training select[name='training'] option:selected").val()
			},
			dataType: 'json'
		}).done(function(data) {
			$("#modal-training .modal-content").html(data.htmlTrainings);

			$("#modal-training select[name='training']").empty().append($("<option value=''>Selecione o Treino</option>"));
			$.each(data.listTrainings, function(i, value) {
				$("#modal-training select[name='training']").append($("<option></option>").val(value.id).text(value.name));
			});
		});
	});

	$(document).on("click", ".remove-training", function() {

		$.ajax({
			method: "POST",
			url: localStorage.getItem("BASE_PROJECT") + "admin/athlete/remove-training",
			data: {
				id: $(this).data("id"),
				id_user: $("#modal-training input[name='id']").val(),
			},
			dataType: 'json'
		}).done(function(data) {
			$("#modal-training .modal-content").html(data.htmlTrainings);

			$("#modal-training select[name='training']").empty().append($("<option value=''>Selecione o Treino</option>"));
			$.each(data.listTrainings, function(i, value) {
				$("#modal-training select[name='training']").append($("<option></option>").val(value.id).text(value.name));
			});
		});
	});

	$("#form-athlete").on("submit", function(event) {
		event.preventDefault();

		$.ajax({
			method: "POST",
			url: $(this).attr("action"),
			data: {
				id: $("#modal-athlete input[name='id']").val(),
				login: $("#modal-athlete input[name='login']").val(),
				pass: $("#modal-athlete input[name='pass']").val(),
				name: $("#modal-athlete input[name='name']").val(),
			},
			dataType: 'json'
		}).done(function(data) {
			if(data.result == true) {
				$("#modal-athlete").css("display", "none");
				$("#block-body").remove();

				$(".body-msg").text(data.msg).css("display", "block");
				$(".athlete-list").html(data.html);
			} else {
				$(".modal .modal-msg").text(data.msg).css("display", "block");
			}
		});
	})
});