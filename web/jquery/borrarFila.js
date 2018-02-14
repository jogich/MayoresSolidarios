function functionName(idE) {
  console.log(idE);
  $(document).ready(function(){
  	$(".eliminar").click(function(){
          $.ajax({url: "/user/"+idE+"/delete/", success: function(result){
                      type: 'DELETE'
                      alert("hola");
                      $(this).parent('td').parent('tr').hide(1000);
               				$(this).parent('td').parent('tr').remove(2000);
                  }});
                });
            });
          }

//
// function functionName(idE) {
//   $(document).ready(function(){
//   	$(".eliminar").click(function(){
//           $.ajax({url: "/user/"+idE+"/delete", success: function(result){
//               console.log("HOLA");
//
//               $(".eliminar").parent('td').parent('tr').hide(1000);
//               $(".eliminar").parent('td').parent('tr').remove(2000);
//
//
//                 }
//
//             });
//           });
//         });
//       }

/*$.ajax(
        '/user/{id}/delete/',{
			 	type: 'DELETE',
				id:$(this).attr('data-id'),
			},success: function(data,status){
            if (status=="success"){
							$(this).parent('td').parent('tr').hide(1000);
       				$(this).parent('td').parent('tr').remove(2000);
							alert("Data: " + data + "\nStatus: " + status);
							var content = "Su consulta ha sido efectuada";
						}else {
							alert("Data: " + data + "\nStatus: " + status);
							var content = "Su consulta no ha sido efectuada";
						}
			});*/
