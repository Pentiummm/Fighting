$(document).ready(function(){
  $("#deleteCategory").click(function(){
    if(confirm("Chắc chắn muốn xóa dữ liệu này !")){
      return true;
    }
    return false;
  });
});
