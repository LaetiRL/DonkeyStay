$(document).ready(function () {
	var fileArr = [];
	$("#img").change(function () {
		// check if fileArr length is greater than 0
		if (fileArr.length > 0) fileArr = [];

		$('#image_preview').html("");
		var total_file = document.getElementById("img").files;
		console.log(total_file[0].name);
	
		if (!total_file.length) return;
		for (var i = 0; i < total_file.length; i++) {
			if (total_file.length > 20 || total_file.length < 5) {
				return false;
			} else {
			
				let ext = $("#img").val().split('.').pop();
				if (ext === 'jpg' || ext === 'jpeg' || ext === 'png') {
					fileArr.push(total_file[i]);
					$('#image_preview').append("<div class='img-div' id='img-div" + i + "'><img src='" + URL.createObjectURL(event.target.files[i]) + "' class='img-responsive image img-thumbnail' title='" + total_file[i].name + "'><div class='middle'><button id='action-icon' value='img-div" + i + "' class='btn btn-danger' role='" + total_file[i].name + "'><i class='fa fa-trash'></i></button></div></div>");
				} else {
					let message = document.querySelector('#imgErr');
					message.textContent = " * Format d'image invalide. Formats attendus: jpg, jpeg, png.";
					setTimeout(function () {
						$("#imgErr").hide();
					}, 10000);
				}
			}
		}
	});

	$('body').on('click', '#action-icon', function (evt) {
		var divName = this.value;
		var fileName = $(this).attr('role');
		$(`#${divName}`).remove();

		for (var i = 0; i < fileArr.length; i++) {
			if (fileArr[i].name === fileName) {
				fileArr.splice(i, 1);
			}
		}
		document.getElementById('img').files = FileListItem(fileArr);
		evt.preventDefault();
	});

	function FileListItem(file) {
		file = [].slice.call(Array.isArray(file) ? file : arguments)
		for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
		if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
		for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
		return b.files
	}
});