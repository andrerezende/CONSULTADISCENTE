function AjaxTabHandler(tabType) {
	this.tabType = tabType;
}

AjaxTabHandler.prototype.handleResponse = function(data, tabId) {
	switch(this.tabType) {
		case "cursos-tab":
			return this.handleResponseCursos(data, tabId);
			break;
		case "notas-tab":
			return this.handleResponseNotas(data, tabId);
			break;
		case "faltas-tab":
			return this.handleResponseFaltas(data, tabId);
			break;
		case "avaliacoes_faltas-tab":
			return this.handleResponseAvaliacoesFaltas(data, tabId);
			break;
		case "conteudo_programatico-tab":
			break;
	}
}

AjaxTabHandler.prototype.handleResponseCursos = function(data, tabId) {
	$("ul", tabId).empty();
	$(data).each(function(i, e) {
		$("ul", tabId).append($("<li>").text(e[0].curso));
	});
}

AjaxTabHandler.prototype.handleResponseNotas = function(data, tabId) {
	$("#" + tabId + " tbody").empty();
	$(data).each(function(i, e) {
		tr = $("<tr>");
		tr.append($("<td>").text(e[0].etapa_avaliacao));
		tr.append($("<td>").text(e[0].desc_ava));
		tr.append($("<td>").text(e[0].nota));
		$("#" + tabId + " tbody").append(tr);
	});
}

AjaxTabHandler.prototype.handleResponseFaltas = function(data, tabId) {
	qtdAulas = 0;
	qtdPresencas = 0;
	qtdFaltas = 0;

	$("#" + tabId + " tbody").empty();
	$(data).each(function(i, e) {
		qtdAulas++;
		e[0].presenca ? qtdPresencas++ : qtdFaltas++;
		tr = $("<tr>");
		dataAula = e[0].data_aula.split("-");
		tr.prepend($("<td>").text((e[0].presenca ? "P" : "F")));
		tr.prepend($("<td>").text(dataAula[2] + "/" + dataAula[1] + "/" + dataAula[0]));
		$("#" + tabId + " tbody").append(tr);
	});

	tr = $("<tr>");
	tr.append($("<td>").html("<p><b><i class=\"icon-ok\"></i> Presenças: </b>" + qtdPresencas + "<br /><b><i class=\"icon-remove\"></i> Faltas: </b>" + qtdFaltas + "</p>").attr("colspan", 3));
	$("#" + tabId + " tbody").append(tr);
}

AjaxTabHandler.prototype.handleResponseAvaliacoesFaltas = function(data, tabId) {
	$(data).each(function(i, e) {
		$(e).each(function(ix, ex) {
			if (!ex[0].hasOwnProperty("data_aula")) {
				AjaxTabHandler.prototype.handleResponseNotas(e, "avaliacoes-table");
			} else {
				AjaxTabHandler.prototype.handleResponseFaltas(e, "faltas-table");
			}
		})
	});
}

$(document).ready(function() {
	$("#AlunoCurso").changeHandler({
		url: "/alunos/getElementosCurriculares",
		postName: "curso",
		updateId: "#AlunoElementoCurricular"
	});
	
	$("#AlunoIndexForm").validate({
		rules: {
			"data[Aluno][curso]": {
				"required": true
			},
			"data[Aluno][elemento_curricular]": {
				"required": true
			},
		},
		messages: {
			"data[Aluno][curso]": {
				"required": ""
			},
			"data[Aluno][elemento_curricular]": {
				"required": ""
			}
		},
		submitHandler: function() {
			var ajaxTabHandler = new AjaxTabHandler("avaliacoes_faltas-tab");

			tab = $("#avaliacoes_faltas-tab");
			tabId = $("a", tab).attr("href");
			matricula = $("#AlunoMatriculas option[value=" + $("#AlunoCurso option:selected").val() + "]").text();
			curso = $("#AlunoCurso option:selected").val();
			elementoCurricular = $("#AlunoElementoCurricular option:selected").val();
			url = $("#avaliacoes_faltas-tab").attr("href") + '?elementoCurricular=' + elementoCurricular + '&matricula=' + matricula + "&curso=" + curso;
			$.ajax({
				url: url,
				type: 'GET',
				dataType: "json",
				success: function(data, textStatus, jqXHR) {
					ajaxTabHandler.handleResponse(data, tabId);
				},
				beforeSend: function(jqXHR, settings) {
					$(tabId).append("<p id=\"loader\">Carregando...</p>");
					$("#faltas-table tbody").empty();
					$("#avaliacoes-table tbody").empty();
				},
				complete: function(jqXHR, textStatus) {
					$("#loader", tabId).remove();
				}
			});
			return false;
		}
	});

});