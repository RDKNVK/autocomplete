//  
//  Autocomplete form in PHP, MySQL and jQuery's AJAX.
//  
//  --------------------------------------------------
//  use with for example:
//  
//  <div id="autocomplete">
//  	<input list="words" type="text" id="in">
//  	<div id="results"></div>
//  </div>
//  

(function() {

$('#in').keyup(function() {
	var input_letters = $(this).val();
	var param_searchby = $('input[name=search-by]:checked').val();

	jQuery.get('autocomplete.php', {letters: input_letters, searchby: param_searchby}, function(data, textStatus, xhr) {
		$("#results .option").remove();

		var opt_id = 0;
		$.each(JSON.parse(data), function (index, val) {
			$('<div />',{
	  				text: val,
	  				class: 'option',
	  				id: 'autocomplete-option-' + opt_id
	  		}).appendTo('#results');
	  		opt_id++;
		});

		$(".option").click(function () {
			$("#in").val($(this).text());
		});
	});
});

})();