</div> <!-- End of page content -->
</div>

<script src="./scripts/jquery-1.10.2.min.js"></script>
<script src="./scripts/bootstrap/js/bootstrap.min.js"></script>

<script src="./scripts/prettyphoto/js/jquery.prettyPhoto.js" type="text/javascript"></script>
<script src="./scripts/scripts.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function ($) {
	init()
});
function init(){
	$("[data-toggle=tooltip]").tooltip();
	$("[data-toggle=popover]").popover();
	$('.dropdown').on('show.bs.dropdown', function(){
		$(this).find('.dropdown-menu').slideDown(250);
	});
	$('.dropdown').on('hide.bs.dropdown', function(){
		$('.dropdown-menu').slideUp();
	});
	$('.carousel').carousel();
	$('.carousel .carousel-control.left').click(function (e) {
		$(this).parent().carousel('prev');
		e.stopImmediatePropagation();
		e.preventDefault();
	});
	$('.carousel .carousel-control.right').click(function (e) {
		$(this).parent().carousel('next');
		e.stopImmediatePropagation();
		e.preventDefault();
	});
	$('.carousel').on('slide.bs.carousel', function() {
		$('.carousel-caption').animate({'opacity': '0'}, 300);
	});
	$('.carousel').on('slid.bs.carousel', function() {
		$('.carousel-caption').animate({'opacity': '1'}, 300);
	});
	$("a[data-gal^='prettyPhoto']").prettyPhoto({ hook: 'data-gal', social_tools: false });
	$("a[data-gal^='prettyPhoto'] img").hover(function () {
		$(this).stop(true, true).animate({ opacity: 0.7 }, 300)
	}, function () {
		$(this).stop(true, true).animate({ opacity: 1 }, 300)
	});
}
</script>
    
</body>
</html>
