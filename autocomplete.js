//  
//  Autocomplete form in PHP, MySQL and jQuery's AJAX.
//  http://github.com/RDKNVK/autocomplete
//  --------------------------------------------------
//  use with for example:
//  
//  <div id="autocomplete">
//  	<input list="words" type="text" id="in">
//  	<div id="results"></div>
//  </div>
//  

(function() {

$('#in').keyup( function() {
	var input_letters = $(this).val();
	// choosing which method of search we use
	var param_searchby = $('input[name=search-by]:checked').val();

	jQuery.get('autocomplete.php', {letters: input_letters, searchby: param_searchby}, function(data, textStatus, xhr) {
		// first remove old 
		$("#results .option").remove();

		$.each(JSON.parse(data), function (index, val) {
			$('<div />',{
	  				text: val,
	  				class: 'option'
	  		}).appendTo('#results');
		});

		// after clicking on one of the options, input field changes
		$(".option").click(function () {
			$("#in").val($(this).text());
		});
	});
});

})();