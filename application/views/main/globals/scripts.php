<!-- <script src="<?=base_url()?>assets/"></script> -->
<script>
$(document).ready(function() {
	// Table functionalities
	// ~ setting default text titles for sorting icons to refresh later
	$('.standard-table th, .standard-table-nodesign th').each(function() {
		$(this).attr('data-defaulttext', $(this).text());
	});
	// ~ sorting icons
	$('body').on('click', '.standard-table th, .standard-table-nodesign th', function() {
		$('.standard-table th, .standard-table-nodesign th').each(function() {
			$(this).text($(this).data('defaulttext'));
		});
		let textTitle = $(this).text();
		if ($(this).hasClass('sorting_asc')) {
			$(this).html(textTitle + '<i class="bi bi-caret-up"></i>');
		} else if ($(this).hasClass('sorting_desc')) {
			$(this).html(textTitle + '<i class="bi bi-caret-down"></i>');
		}
	});
	// ~ redirect on row click
	$('body').on('click', '.standard-table tr, .standard-table-nodesign tr', function() {
		let url = $(this).data('urlredirect');
		if (url) {
			window.location.href = url;
		}
	});
	// ~ little loading animation when clicking on a sidebar link
	$('body').on('click', 'a.sidebar-link, .standard-table-nodesign tr', function() {
		let defaultText = $(this).text();
		$(this).html('<i class="spinner-border spinner-border-sm"></i> <span>' + defaultText + "</span>");
	});
	$('.generatereport-btn').on('click', function() {
		$('#generateReport').modal('toggle');
	});
});
</script>
<noscript>
	<h5>
		Enable Javascript to continue.
	</h5>
</noscript>