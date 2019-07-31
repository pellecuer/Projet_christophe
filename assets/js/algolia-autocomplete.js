$(document).ready(function() {
    $('.js-project-autocomplete').each(function() {
        var autocompleteUrl = $(this).data('autocomplete-url');       
        hint: false
        $(this).autocomplete({hint: false}, [
            {
                source: function(query, cb) {
                    $.ajax({
                        url: autocompleteUrl+'?query='+query
                    }).then(function(result) {
                        cb(result.data);
                    });
                },
                displayKey: 'name',
                debounce: 50 // only request every 1000/50 second
            }
        ])    
    });
});