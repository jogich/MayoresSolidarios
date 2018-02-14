

    // alert(id);

    $(document).ready(function(){
        $(".eliminar").click(function(){
          var id=$(this).data("id");
          var elemento=$(this);
            $.ajax({
              url: "/user/"+id+"/delete/",
              type: 'DELETE',
              success: function(result){
              elemento.parent('td').parent('tr').hide(1000);
              // $(".eliminar").parent('td').parent('tr').hide(1000);
              // $(".eliminar").parent('td').parent('tr').remove(2000);
              //   console.log('hola');
            }
          });
        });
    });


  // jordi
    // function functionName(id) {
    //   // alert(id);
    //
    //   $.ajax({
    //     url: "/user/"+id+"/delete/",
    //     type: 'DELETE',
    //     success: function(result){
    //       console.log('hola');
    //       var_dump(result);
    //      $(".eliminar").parent('td').parent('tr').hide(1000);
    //      $(".eliminar").parent('td').parent('tr').remove(2000);
    //
    //   }});
    // }
