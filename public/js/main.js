$(document).ready(function(){
  $("#deleteCategory").click(function(){
    if(confirm("Chắc chắn muốn xóa dữ liệu này !")){
      return true;
    }
    return false;
  });


  $(document).ready(function(){
      var maxField = 10; //Input fields increment limitation
      var addButton = $('.add_button'); //Add button selector
      var wrapper = $('.wrapper'); //Input field wrapper
      var fieldHTML = '<div><input type="text" class="form-control" name="sku[]" placeholder="SKU" style="width: 120px;"/> <input type="text" class="form-control" name="size[]" placeholder="Size" style="width: 120px;"/> <input type="text" class="form-control" name="price[]" placeholder="Price" style="width: 120px;"/> <input type="text" class="form-control" name="stock[]" placeholder="Stock" style="width: 120px;"/><a href="javascript:void(0);" class="remove_button">Remove -</a></div>'; //New input field html
      var x = 1; //Initial field counter is 1

      //Once add button is clicked
      $(addButton).click(function(){
          //Check maximum number of input fields
          if(x < maxField){
              x++; //Increment field counter
              $(wrapper).append(fieldHTML); //Add field html
          }
      });

      //Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e){
          e.preventDefault();
          $(this).parent('div').remove(); //Remove field html
          x--; //Decrement field counter
      });
  });


});
