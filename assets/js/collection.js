$(document).ready(function() {
    var $collectionHolder;
  
    //add new items (experience forms)
    var $addNewItem = $(
      '<a href="#" class="btn btn-info mt-4">Ajouter un TJM</a>'
    );
  
   
      //getTheCollection Holder
      $collectionHolder = $("#exp_list");
  
      //Append the add new item to the collection holder
      $collectionHolder.append($addNewItem);
      $collectionHolder.data("index", $collectionHolder.find(".card").length);
  
      //add remove button to existing items
      $collectionHolder.find(".card").each(function() {
        addRemoveButtton($(this));
      });
  
      //handle the click event for addNew item
      $addNewItem.click(function(e) {
        e.preventDefault();
        //create a new form and append it to collectionHolder
        addNewForm();
      });
   
  
    function addNewForm() {
      //getting the prototype
      var prototype = $collectionHolder.data("prototype");
  
      //get the index
      var index = $collectionHolder.data("index");
  
      //create the form
      var newForm = prototype;
  
      newForm = newForm.replace(/_name_/g.index);
  
      $collectionHolder.data("index", index + 1);
      //create the card
      var $card = $("<div class='card'></div>");
  
      //create the card body and append the form to it
      var $cardBody = $("<div class='card-body'></div>").append(newForm);
  
      //append the body to the card
      $card.append($cardBody);
  
      //append the remove button to the new card
      addRemoveButtton($card);
  
      //append the $card to the addNewItem
      $addNewItem.before($card);
    }
  
    function addRemoveButtton($card) {
      //create remove button
      var $removeButton = $("<a href='#' class='btn btn-danger'>Supprimer</a>");
  
      //appending the remove button to the card footer
      var $cardFooter = $("<div class='card-footer'></div>").append(
        $removeButton
      );
  
      //handle the click eventg of the remove button
      $removeButton.click(function(e) {
        e.preventDefault();
        $(e.target)
          .parents(".card")
          .slideUp(1000, function() {
            $(this).remove();
          });
      });
  
      //append the footer to the card
      $card.append($cardFooter);
      console.log($card);
    }
  });
  