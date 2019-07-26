
//New function
function calculateForOneRowClickable(){
    var row = 0,
    col = 0,
    ncol = 0;
    var sum;                
    var arrayRowToCalculate = $("activity tbody .poleclickable").nextUntil('.lastRow').add('tr');
    
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
//end of function