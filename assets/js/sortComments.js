$(document).ready(function () {
	var $comments = $(".pin-comment").get();
	var $parentDiv = $(".comments-container");

	function active($el) {
		$(".sort").removeClass("sort-active");
		$el.addClass("sort-active");
	}

	function sort() {
		var method = $(this).text() === "Oldest first" ? "asc" : "desc";
		switch (method) {
			case "asc":
				$comments = $comments.sort(function (a, b) {
					return a.id - b.id;
				});
				break;
			case "desc":
				$comments = $comments.sort(function (a, b) {
					return b.id - a.id;
				});
				break;
		}
		$parentDiv.append($comments);
		active($(this));
	}

	$(".sort").on("click", sort);
});