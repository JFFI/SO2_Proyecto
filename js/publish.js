$(function () {
    $(document).ready(function () {
      
    var socket = io('http://192.168.1.20:3000');
    var circle = new ProgressBar.Circle('#progress', {
        color: '#FCB03C',
	strokeWidth: 2,
        duration: 500,
        //easing: 'easeInOut',
	text:{
		value:'0%'
	},
	step: function(state,bar){
		bar.setText((bar.value() * 100).toFixed(0)+'%');
	}
    });

	var wuju = 1;
	setInterval(function(){
		if (ident != 0 && wuju ==1) {
			console.log('video:' + ident);
			socket.emit('video',ident);
		}
	},500);

      
      socket.on('avance',function(data){
	console.log('funciona');
	if(data != null){
		circle.animate(data);
		console.log(data);
	}
	if(data == 1){
		setTimeout(function(){
			var node= document.getElementById('result');
			node.innerHTML = "<h3>Exito</h3><br><h4>Elija la calidad:</h4><br><a href='http://192.168.1.30/Reproductor.html?id="+ident+"&nombre="+ nident +"&resolucion=low'>Baja</a><br><a  href='http://192.168.1.30/Reproductor.html?id="+ident+"&nombre="+ nident +"&resolucion=med'>Media</a><br><a href='http://192.168.1.30/Reproductor.html?id="+ident+"&nombre="+ nident +"&resolucion=high'>Alta</a><br><br><br>";
			wuju =0;
		},100);
	}
      });
  });
});
