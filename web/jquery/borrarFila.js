
    $(document).ready(function(){
        $(".eliminar").click(function(){
          var id=$(this).data("id");
          var elemento=$(this);
            $.ajax({
              url: "/user/"+id+"/delete/",
              type: 'DELETE',
              success: function(result){
              elemento.parent('td').parent('tr').hide(1000);
              elemento.parent('td').parent('tr').remove(3000);

            }
          });
          $(document).ajaxError(function(){
            $(".alert-warning").css("display", "block");
            setTimeout(function(){  $(".alert-warning").css("display", "none"); }, 5000);
          });
        });
    });
