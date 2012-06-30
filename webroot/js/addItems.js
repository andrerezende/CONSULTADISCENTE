$.fn.addItems = function(data) {
	return this.each(function() {
		var list = $(this);
		list.empty();
		console.log(data);
		if (data.length != []) {
			$.each(data, function(index, text) {
				list.append("<option value="+index+">"+text+"</option>");
			});
		} else {
			list.append("<option>Nenhuma opção encontrada</option>");
		}
	})
}