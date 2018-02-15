
    $(document).ready(function(){
        var table;
        if (location.href.indexOf("user")!=-1){
          table = "user";
        }else if (location.href.indexOf("project")!=-1){
          table = "project";
        }

        $(".eliminar").click(function(){
          var id=$(this).data("id");
          var elemento=$(this);
            $.ajax({
              url: "/"+table+"/1/delete/",
              type: 'DELETE',
              success: function(result){
              elemento.parent('td').parent('tr').hide(1000);
              // elemento.parent('td').parent('tr').delay(9000).remove();

            }
          });
          $(document).ajaxError(function(){
            $(".alert-warning").show(1000);
            setTimeout(function(){  $(".alert-warning").hide(1000); }, 5000);
          });
        });
    });
