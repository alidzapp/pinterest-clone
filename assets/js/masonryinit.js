$(document).ready(function () {
	var $grid = $(".masonry-grid").imagesLoaded(function () {
		// init Masonry after all images have loaded
		$grid.masonry({
			itemSelector: ".masonry-grid-item",
			columnWidth: ".masonry-grid-sizer",
			percentPosition: true
		});
	});
});