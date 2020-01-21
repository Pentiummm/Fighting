$(document).ready(function(){
  $("#deleteCategory").click(function(){
    if(confirm("Chắc chắn muốn xóa dữ liệu này !")){
      return true;
    }
    return false;
  });

  $(".btn-submit-service").click(function(e){
    
    e.preventDefault();
    
    var form_datas = $( "form" ).serialize();

    function step5(){
       $.ajax({
          url:"/admin/addservice/adddb",
          method: 'POST',
          data:form_datas,
          success:function(res){
             console.log('step5 (add db, import db)');
             console.log(res);
             if (res) {
                var timer = setTimeout(function(){
                  progress_bar_process(100, timer);
                }, 1000);
                console.log('  --> step5 -> done');
              } else {
                console.log('  --> step5 -> error');
             }
          }
       });
    }

    function step4(){
       $.ajax({
          url:"/admin/addservice/upsource",
          method: 'POST',
          data:form_datas,
          success:function(res){
             console.log('step4 (remove file, upload source)');
             console.log(res);
             if (res) {
                var timer = setTimeout(function(){
                  progress_bar_process(80, timer);
                }, 1000);
                console.log('  --> step4 -> done');
                var timer = setTimeout(function(){
                   step5();
                }, 1000);
              } else {
                console.log('  --> step4 -> error');
             }
          }
       });
    }

    function step3(){
       $.ajax({
          url:"/admin/addservice/addftp",
          method: 'POST',
          data:form_datas,
          success:function(res){
             console.log('step3 (create ftp)');
             if (res.result = 'ok') {
                var timer = setTimeout(function(){
                  progress_bar_process(60, timer);
                }, 1000);
                console.log('  --> step3 -> done');
                var timer = setTimeout(function(){
                   step4();
                }, 1000);
              } else {
                console.log('  --> step3 -> error');
             }
          }
       });
    }

    function step2(){
      $.ajax({
        url: "/admin/addservice/addsubdomain",
        type:'POST',
        data: form_datas,
        beforeSend:function() {
          $('#submit_handle').attr('disabled', 'disabled');
          $('#process').css('display', 'block');
        },
        success: function(res) {
          if(res.result = 'ok'){
            console.log('step2 (create subdomain)');
            var timer = setTimeout(function(){
              progress_bar_process(40, timer);
            }, 2000);
            console.log('  --> step2 -> done');
            var timer = setTimeout(function(){
               step3();
            }, 1000);
          } else {
            console.log('  --> step2 -> error');
          }
          /* if( $.isEmptyObject(data.error) ){ console.log(data.success); } else { printErrorMsg(data.error); } */
        }
      });
    }

    $.ajax({
      url: "/admin/addservice/add",
      type:'POST',
      data: form_datas,
      beforeSend:function() {
        $('#submit_handle').attr('disabled', 'disabled');
        $('#process').css('display', 'block');
      },
      success: function(res) {
        
        if(res['success'] == 'ok'){
          console.log('step1 (add db)');
          var timer = setTimeout(function(){
            progress_bar_process(20, timer);
          }, 3000);
          console.log('  --> step1 -> done');
          var timer = setTimeout(function(){
            step2();
          }, 1000);
        } else {
          console.log('  --> step1 -> error');
        }

      }
    });

  });

  function progress_bar_process(percentage, timer) {
     $('.progress-bar').css('width', percentage + '%');
     if(percentage > 100) {
        clearInterval(timer);
        $('#sample_form')[0].reset();
        $('#process').css('display', 'none');
        $('.progress-bar').css('width', '0%');
        $('#save').attr('disabled', false);
        $('#success_message').html("<div class='alert alert-success alert-block'><button type='button' class='close' data-dismiss='alert'>×</button><strong>OK men. Thành công nha!</strong></div>");
        setTimeout(function(){
           $('#success_message').html('');
        }, 5000);
     }
  }

  function printErrorMsg (msg) {
      $(".print-error-msg").find("ul").html('');
      $(".print-error-msg").css('display','block');
      $.each( msg, function( key, value ) {
          $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
      });
  }


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
