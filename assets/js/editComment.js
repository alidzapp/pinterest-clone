$(document).ready(function () {
	var $modal = $("#edit-modal");
	var $textarea = $(".new-comment");
	var id;

	function toggleModal() {
		id = $(this).closest(".pin-comment").attr("id");
		var $commentEl = $(this).siblings(".comment-body");
		var commentBody = $commentEl.text();
		$textarea.val(commentBody);
		$modal.modal("show");
	}

	function edit() {
		var newComment = $textarea.val();
		$.post("editcomment.php", { "id": id, "newComment": newComment }, function (response) {
			if (response.edited) {
				$("#" + id).find(".comment-body").text(newComment);
			}
			id = null;
			$modal.modal("hide");
		});
	}

	$(".edit-comment").on("click", toggleModal);
	$(".edit-btn").on("click", edit);
});