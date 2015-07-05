$(function () {
    $(document).ready(function () {
      
      var socket = io();

      $('#aasig').submit(function(){
        socket.emit('aasig',{'bus':$('#aasigbus').val(),'ruta':$('#aasigruta').val()});
        return false;
      });
      
      socket.on('avance',function(data){
	
	//var node = document.getElementById('node-id');
        //node.innerHTML = data['todo'];
      });
  });
});