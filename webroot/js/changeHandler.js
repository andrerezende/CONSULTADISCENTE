$.fn.changeHandler = function(options) {
	var opts = $.extend({}, $.fn.changeHandler.defaults, options);
	
	this.bind("change", opts, function(event) {
		var selected = $("option:selected", this).val();
		var postData = {};
		postData[event.data.postName] = selected;
		$.ajax({
			type: "POST",
			url: event.data.url,
			data: postData,
			dataType: 'json',
			success: function(data) {
				$(event.data.updateId).addItems(data)
				$(event.data.updateId).removeAttr('disabled')
			}
		});
		return false;
	});
}