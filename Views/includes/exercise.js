$(document).ready(function(){
	$(document).on("click", "#new-exercise, .edit-exercise", function() {
		$("#modal-exercise").css("display", "block");
		$(".modal .modal-msg").css("display", "none");

		if(typeof $(this).data("id") !== "undefined") {
			$("#modal-exercise .modal-title").text("Editar Exercício");
			$("#modal-exercise input[name='id']").val($(this).data("id"));

			$.ajax({
				method: "GET",
				url: localStorage.getItem("BASE_PROJECT") + "exercise/get-exercise",
				data: {
					id: $(this).data("id"),
					return: "JSON"
				},
				dataType: 'json'
			}).done(function(data) {
				$("#modal-exercise input[name='name']").val(data.name);
				$("#modal-exercise input[name='login']").val(data.login);
				$("#modal-exercise input[name='pass']").val("");
			});
		} else {
			$("#modal-exercise .modal-title").text("Novo Exercício");
			$("#modal-exercise input[name='id']").val("");
			$("#modal-exercise input[name='name']").val("");
			$("#modal-exercise input[name='login']").val("");
			$("#modal-exercise input[name='pass']").val("");
		}

		var divBackground = document.createElement("div");
		$(divBackground).attr("id", "block-body");
		$("body").append(divBackground);

	});

	$(document).on("click", "#block-body", function() {
		$("#modal-exercise").css("display", "none");
		$("#block-body").remove();
	});

	$(document).on("click", ".remove-exercise", function() {
		var name = $(this).parents("tr").find("td:first").text();
		if(confirm("Tem certeza que deseja remove o Exercício " + name)) {
			$.ajax({
				method: "POST",
				url: localStorage.getItem("BASE_PROJECT") + "exercise/remove-exercise",
				data: {
					id: $(this).data("id")
				},
				dataType: 'json'
			}).done(function(data) {
				$(".body-msg").text(data.msg).css("display", "block");

				if(data.result == true) {
					$(".exercise-list").html(data.html);
				}
			});
		}
	});

	$("#form-exercise").on("submit", function(event) {
		event.preventDefault();

		$.ajax({
			method: "POST",
			url: $(this).attr("action"),
			data: {
				id: $("#modal-exercise input[name='id']").val(),
				login: $("#modal-exercise input[name='login']").val(),
				pass: $("#modal-exercise input[name='pass']").val(),
				name: $("#modal-exercise input[name='name']").val(),
			},
			dataType: 'json'
		}).done(function(data) {
			if(data.result == true) {
				$("#modal-exercise").css("display", "none");
				$("#block-body").remove();

				$(".body-msg").text(data.msg).css("display", "block");
				$(".exercise-list").html(data.html);
			} else {
				$(".modal .modal-msg").text(data.msg).css("display", "block");
			}
		});
	})
});