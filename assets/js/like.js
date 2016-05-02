$(document).ready(function () {
	// like
	$(".likes").on("click", function () {
		var id = $(this).closest(".masonry-grid-item").data("pinid");
		$.post("likeapin.php", { pinid: id }, function (response) {
			response = JSON.parse(response);
			if (response.err) {
				switch (response.err) {
					case "not logged in":
						window.location.href = "login.php";
						break;
					default:
						return false;
				}
			} else {
				var $el = $(this).find(".likes-amount");
				if (!response.liked) {
					$el.text(parseInt($el.text(), 10) + 1);
				} else {
					$el.text(parseInt($el.text(), 10) - 1);
				}
			}
		}.bind($(this)));
	});

	// repost
	$(".reposts").on("click", function () {
		var id = $(this).closest(".masonry-grid-item").data("pinid");
		$.post("repostapin.php", { pinid: id }, function (response) {
			response = JSON.parse(response);
			if (response.err) {
				switch (response.err) {
					case "not logged in":
						window.location.href = "login.php";
						break;
					default:
						return false;
				}
			} else {
				var $el = $(this).find(".reposts-amount");
				if (!response.reposted) {
					$el.text(parseInt($el.text(), 10) + 1);
				} else {
					$el.text(parseInt($el.text(), 10) - 1);
					if (page(window.location.pathname) === "mypins.php") {
						var $el = $(this).closest(".masonry-grid-item");
						removeEl($el);
					}
				}
			}
		}.bind($(this)));
	});

	function removeEl($el) {
		// remove element and reload the grid
		$el.fadeOut("medium", function () {
			$el.remove();
			$(".masonry-grid").masonry("layout");
		});
	}

	function page(path) {
		var index = path.lastIndexOf("/") + 1;
		return path.substr(index);
	}
});