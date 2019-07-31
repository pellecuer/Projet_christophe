$(document).ready(function() {
    $('.js-project-autocomplete').each(function() {
        var autocompleteUrl = $(this).data('autocomplete-url');       
        hint: false
        $(this).autocomplete({hint: false}, [
            {
                source: function(query, cb) {
                    $.ajax({
                        url: 'autoCompleteProject'+'?query='+query
                    }).then(function(result) {
                        cb(result.data);
                    });
                },
                displayKey: 'name',
                debounce: 200 // only request every 1/2 second
            }
        ])    
    });
});