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
	$("table tbody", tabId).empty();
	$(data).each(function(i, e) {
		tr = $("<tr>");
		tr.append($("<td>").text(e[0].curso));
		tr.append($("<td>").text(e[0].nome_elemento_curricular));
		tr.append($("<td>").text(e[0].desc_ava));
		tr.append($("<td>").text(e[0].nota));
		$("table tbody", tabId).append(tr);
	});
}

AjaxTabHandler.prototype.handleResponseFaltas = function(data, tabId) {
	qtdAulas = 0;
	qtdPresencas = 0;
	qtdFaltas = 0;

//	total = $("table tbody tr.total", tabId);
	$("table tbody", tabId).empty();
//	$("table tbody", tabId).append(total);
	$(data).each(function(i, e) {
		qtdAulas++;
		e[0].presenca ? qtdPresencas++ : qtdFaltas++;
		tr = $("<tr>");
		dataAula = e[0].data_aula.split("-");
		tr.prepend($("<td>").text((e[0].presenca ? "P" : "F")).attr("colspan", 2));
		tr.prepend($("<td>").text(dataAula[2] + "/" + dataAula[1] + "/" + dataAula[0]));
		tr.prepend($("<td>").text(qtdAulas));
		$("table tbody", tabId).append(tr);
	});

	tr = $("<tr>");
	tr.append($("<td>").html("<p><b><i class=\"icon-ok\"></i> Presenças: </b>" + qtdPresencas + "<br /><b><i class=\"icon-remove\"></i> Faltas: </b>" + qtdFaltas + "</p>").attr("colspan", 3));
	$("table tbody", tabId).append(tr);
}

$(document).ready(function() {
	$(".tab").click(function(e) {
		var ajaxTabHandler = new AjaxTabHandler($(this).attr("id"));

		tab = $(this);
		tabId = $("a", tab).attr("href");
		$.ajax({
			url: $(this).attr("href"),
			dataType: "json",
			success: function(data, textStatus, jqXHR) {
				ajaxTabHandler.handleResponse(data, tabId);
			},
			beforeSend: function(jqXHR, settings) {
				$(tabId).append("<p id=\"loader\">Carregando...</p>");
			},
			complete: function(jqXHR, textStatus) {
				$("#loader", tabId).remove();
			}
		})
	});
});