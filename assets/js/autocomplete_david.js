
    //function Autocomplete Ajax
    $("#searchNameInput").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/project/search",
                dataType: "json",
                data: {
                    term: request.term
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            log("Selected: " + ui.item.value + " aka " + ui.item.id);
        }
    });

    //function autocomplete search
    $(function (){
         var projects = [
            "Projet1",
            "Projet2",
            "Amilnote",
            "Babiltone",
            "CvGenerator"                    
        ];
        $( "#recherche" ).autocomplete({
        source: projects
        });
    });

    //function autocomplete search
    function autocomplete(){
         var profiles = [
            "Junior",
            "Design",
            "Lead",
            "Confirmé",
            "Projet Web",
            "Projet Web",
            "Projet mobile Android",
            "Expert",
            "Projet Mobile IOS",
            "Projet Jira Interne 4",
            "Projet Jira Externe",
        ];
        $( ".profile" ).autocomplete({
        source: profiles
        });
    };