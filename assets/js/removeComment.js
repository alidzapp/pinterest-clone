$(document).ready(function () {
	function remove() {
		var id = $(this).closest(".pin-comment").attr("id");
		$.post("removecomment.php", { "id": id }, function (response) {
			if (!response.err) {
				$(this).closest(".pin-comment").fadeOut("400", function () {
					$(this).remove();
					$(".comment-amount").text($(".pin-comment").length);
				});
			}
		}.bind($(this)));
	}

	$(".remove-comment").on("click", remove);
});