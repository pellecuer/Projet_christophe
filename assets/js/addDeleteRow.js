//addRow
$('.addRow').on( 'click', function (e) {
    e.preventDefault();

    //Rajouter la mise en mémoire du index, 
    //Puis rendre visible tout
    
    //initialization 11 colums array
    var key = parseInt($('#key').text());
    var nbColumns = parseInt($('#nbColumns').text());         
    var range = parseInt(5);
    var keyRange = key+range;  

    //Set all columns visible and Copy it
    for ( var i=1; i<nbColumns; i++ ){
    table.column( i ).visible( true, true );
    }

    //addRow + class
    var col = [""];
    for (i= 0; i<nbColumns-1; i++) {
       col.push('');  
    }
    col.push('<i class="fas fa-trash-alt"></i>')              
    var rowNode = table.row.add(col).draw().node();
    
    $(rowNode).find('td').addClass('edit-for');
    $(rowNode).find('td').eq(-1).removeClass("edit-for").addClass("trash");                
    $(rowNode).find('td').eq(0).removeClass("edit-for").addClass("profile");
    autocomplete();

    //set all columns invisible and make visible from index
    for ( var i=1; i<nbColumns; i++ ){
   table.column( i ).visible( false, false );
    }
    for ( var i=key; i<keyRange; i++ ){
    table.column( i ).visible( true, true );               
    }
});


//delete row
 $('#activity tbody').on('click', "td.trash", function () {
    if ( confirm( "Etes vous sûr de vouloir supprimer cette ligne ?" ) ) {
         table
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    }               
});