/*
 * alterar senha form
 */
$(document).ready(function() {
	$("#AlunoAlterarSenhaForm").validate({
		rules: {
			"data[Aluno][senha_atual]": {
				"required": true,
				"minlength": 6
			},
			"data[Aluno][nova_senha]": {
				"required": true,
				"minlength": 6
			},
			"data[Aluno][confirmar_senha]": {
				"required": true,
				"minlength": 6
			}
		},
		messages: {
			"data[Aluno][senha_atual]": {
				"required": "",
				"minlength": "No mínimo 6 caracteres"
			},
			"data[Aluno][nova_senha]": {
				"required": "",
				"minlength": "No mínimo 6 caracteres"
			},
			"data[Aluno][confirmar_senha]": {
				"required": "",
				"minlength": "No mínimo 6 caracteres"
			}
		}
	});
});