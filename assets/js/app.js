/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
var $ = require('jquery');
// import $ from 'jquery';

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
 // any CSS you require will output into a single css file (app.css in this case)
 import('bootstrap/dist/css/bootstrap.css'); 
 require('@fortawesome/fontawesome-free/css/all.min.css');
 import ('datatables.net-dt/css/jquery.dataTables.css');
 import ('datatables.net-select-dt/css/select.dataTables.min.css');
 import('../css/app.css');
 import('../css/algolia-autocomplete.css');
 
 

// lib
 require('popper.js');
 require('bootstrap');
 require('./collection.js');
 require( 'datatables.net-dt')();
 import('./columnTitle.js');
 require( 'datatables.net-select-dt')();
 require('@fortawesome/fontawesome-free/js/all.js');
 require('autocomplete.js/dist/autocomplete.jquery.js');
 require('./algolia-autocomplete.js');
 
 //main
 $(document).ready(function() {    
    //Initialize                       
    calculateForOneRowClickable();
    update();    

    //Initialize var DataTable
    var table = $('#activity').DataTable({                
            //ajax:'/ajax',
            "ordering": false,
            "paging": false,
            "dom": 'lrtip',

            //translation
            "language": {
                "sProcessing": "Traitement en cours ...",
                "sLengthMenu": "Afficher _MENU_ lignes",
                "sZeroRecords": "Aucun résultat trouvé",
                "sEmptyTable": "Aucune donnée disponible",
                "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
                "sInfoEmpty": "Aucune ligne affichée",
                "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
                "sInfoPostFix": "",
                "sSearch": "Chercher:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Chargement...",
                "oPaginate": {
                    "sFirst": "Premier", "sLast": "Dernier", "sNext": "Suivant", "sPrevious": "Précédent"
                },
                "oAria": {
                    "sSortAscending": ": Trier par ordre croissant", "sSortDescending": ": Trier par ordre décroissant"
                },
                "select": {
                    "rows": {
                        _: "%d lignes séléctionnées",
                        0: "Aucune ligne séléctionnée",
                        1: "1 ligne séléctionnée"
                    }
                }
            }            
    });

     //initialization 11 colums array
     var key = parseInt($('#key').text());
     var nbColumns = parseInt($('#nbColumns').text());         
     var range = parseInt(5);
     var keyRange = key+range;
     for ( var i=1; i<nbColumns; i++ ){
        table.column( i ).visible( false, false );
     }
     for ( var i=key; i<keyRange; i++ ){
        table.column( i ).visible( true, true );               
     }
     //button next
     $(".next").on("click", function(e){
         e.preventDefault(); 
         for ( var i=1; i<nbColumns; i++){
         table.column( i ).visible( false, false );
         } 
         if (keyRange<nbColumns){
            key++;
            keyRange++;     
         } 
         for ( var i=key ; i<keyRange ; i++ ) {
             table.column( i ).visible( true, true )
         }                
         table.columns.adjust().draw( false );
         var currentMonth = table.column( key ).title();
         $('#currentMonth').text(currentMonth);      
     });
 
     //button previous
     $(".previous").on("click", function(e){
         e.preventDefault();
         for ( var i=1; i<nbColumns; i++){
         table.column( i ).visible( false, false );
         } 
         if (key>1) {
            key--;
            keyRange--;     
         }         
         for ( var i=key ; i<keyRange ; i++ ) {
             table.column( i ).visible( true, true );                   
         }
         table.columns.adjust().draw( false );
         var currentMonth = table.column( key ).title();
         $('#currentMonth').text(currentMonth);
     });
    

    //function Calculate
    function calculateForOneRowClickable(){
        var row = 0,
        col = 0,
        ncol = 0;
        var sum;                
        var arrayRowToCalculate = $("activity tbody .poleclickable").nextUntil('.lastRow').add('tr');
        var newval = '';
        
        // sum by row                
        $(arrayRowToCalculate).each(function (rowindex) {
            sum = 0;
            col = 0;
            $(this).find("td.edit-for").each(function (colindex) {
                col++;
                //newval = $(this).find("input").val();                     
                //if (isNaN(newval)) {
                    //$(this).html(sum);
                    if (col > ncol) {
                        ncol = col - 1
                    }
                //} else {
                //  sum += parseInt(newval);
            //}
            });
        });
        // sum by col
        for (col = 2; col < ncol + 3; col++) {
            console.log("column: " + col);
            sum = 0;
            $($(arrayRowToCalculate).get().reverse()).each(function (rowindex) {
                $(this).find("td:nth-child(" + col + ")").each(function (rowindex) {
                    newval = $(this).find("input").val();
                    console.log(newval);
                    if ( (isNaN(newval)) && ($(this).hasClass("colSum")) ){
                        $(this).html(sum);
                        sum=0;
                    } else {
                        sum += parseInt(newval);
                    }
                });
            });
        }
    }
    

    //function slide down
    $(".child").hide();            
    $(".poleclickable").click(function(){
        $(this).closest('tr').nextUntil('.poleclickable').slideToggle();                              
    });       

    //function update
    function update(){
        $("#activity tbody :input").on("change paste", function(e){
            
            //function input value Regex                    
            $('#response').removeClass("visible").addClass("invisible");

            var error = 0;
            var element = $(this);
            var rank = parseInt(element.val());
            var availableRank = [0,1,2,3,4,5,6,7,8,9];
            if (jQuery.inArray(parseInt(rank), availableRank) ==-1){
                var error = 1;
                var errorMsg = 'Vous devez entrer un chiffre compris entre 1 et 9';
                $('#response').text(errorMsg);
                $('#response').addClass("visible alert alert-danger").removeClass("invisible");
                $( this).focus();
                $( this).addClass("text-danger");

            } else { 
                calculateForOneRowClickable();
                //Update on next, previous, enter
                var id = element.attr('id');                                                                                        
                var emptyMonth = table.column(element.closest('td')).title();              
                var projectName = $('#projectName').text();
                var profileName = table.row(element.parents('tr')).data()[0];                                                                                    
                var poleName = element.closest('tr').next().prevUntil('tr.poleclickable').last().prev('tr').children().first().text();
                        
                $.ajax({
                    url:'/activity/update',
                    type: "POST",
                    dataType: "json",
                    data: {
                        "rank": rank,
                        "id": id,
                        "emptyMonth": emptyMonth,                            
                        "projectName": projectName,
                        "profileName": profileName,
                        "poleName": poleName
                    },
                    async: true,
                    success: function (data)
                    {
                        console.log(data);
                        var successMsg = 'Vous avez atrtibué la note de ' + data.rank;
                        $('#response').text(successMsg); 
                        $('#response').removeClass("invisible alert alert-danger").addClass("visible alert alert-success"); 
                    }
                });
            } 
        })                    
    }

    //addRow
    //delete row
});
