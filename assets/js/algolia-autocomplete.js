$(document).ready(function() {
    $('.js-project-autocomplete').each(function() {
        var autocompleteUrl = $(this).data('autocomplete-url');
        hint: false
        $(this).autocomplete({hint: false}, [
            {
                source: function(query, cb) {
                    $.ajax({
                        url: autocompleteUrl
                    }).then(function(data) {
                        cb(data.projectsName);
                    });
                },
                displayKey: 'nom',
                debounce: 500 // only request every 1/2 second
            }
        ])    
    });
});