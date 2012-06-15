/*
 * login form
 */
$(document).ready(function() {
	$(".cpf").mask("999.999.999-99");

	$("#AlunoLoginForm, #AlunoSolicitarSenhaForm").validate({
		rules: {
			"data[Aluno][cpf]": {
				"required": true,
				"maxlength": 15
			},
			"data[Aluno][senha]": "required"
		},
		messages: {
			"data[Aluno][cpf]": {
				"required": "",
				"maxlength": ""
			},
			"data[Aluno][senha]": ""
		}
	});

	$("#SolicitarSenha").click(function(e) {
		window.location.replace("/alunos/solicitar_senha");
	});
});