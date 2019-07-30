$(document).ready(function() {
    $('.js-project-autocomplete').autocomplete({hint: false}, [
        {
            source: function(query, cb) {
                cb([
                    {value: 'foo'},
                    {value: 'bar'}
                ])
            }
        }
    ]);
});