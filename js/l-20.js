$(function(){
		$("#cotizarbtn").click(function(){
		var cotizar=$("input[name='cotizar']");
		var alto1 = document.getElementById('alto').value;
		console.log(alto1);
	 		alto1 = alto1.replace(/\./g,'');
	 		alto1 = alto1.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
			alto1 = alto1.split('').reverse().join('').replace(/^[\.]/,'');
		var ancho1 = document.getElementById('ancho').value;
		console.log(ancho1);
	 		ancho1 = ancho1.replace(/\./g,'');
	 		ancho1 = ancho1.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
			ancho1 = ancho1.split('').reverse().join('').replace(/^[\.]/,'');
		var tipo = $('#cotizar').val();
		var tipocantidad = $('input:radio[name=precio]:checked').val();
		console.log(alto1);
		console.log(ancho1);
		console.log(tipo);
		console.log(tipocantidad);
		 if(tipo==="Ventana carpinteria de aluminio 2 hojas vidrio de color" && tipocantidad==="uno")
	 		{
		 	$('select').css("border","2px solid green");
		 	var ancho = ancho1;
			var alto = alto1;
			console.log(ancho);
			console.log(alto);
			if (ancho.length<=3) {
				ancho = "0."+ancho;
				alert(ancho);
			}
			if (alto.length<=3) {
				alto = "0."+alto
				alert(alto);
			}
			var cantidad = document.getElementById('cantidad').value; 
			if (ancho<=1.000 && alto<=1.000) {
				var precio = 350;
				var preciounitario = 350;
				var preciototal = precio * cantidad;
			}else{
				var precio = 55;
				var metrocuadrado = ancho *alto;
				var preciounitario = metrocuadrado * precio;
				preciounitario = preciounitario * 6.96;
				preciounitario = Math.round(preciounitario);
				var preciototal = preciounitario * cantidad;
			}
			console.log(preciounitario);
			console.log(preciototal);
			document.getElementById('preciounitario').innerHTML = "<label style='color:#449d44!important;'>Precio Unitario</label><br><input type='text' name='preciou' value='"+preciounitario+"' > Bs.<br>";
			document.getElementById('preciototal').innerHTML = "<label style='color:#449d44!important;'>Precio Total</label><br><input type='text' name='preciot' value='"+preciototal+"' > Bs.<br>";
			}
			if(tipo==="Ventana carpinteria de aluminio 2 hojas vidrio de color" && tipocantidad==="mas de tres")
	 		{
	 			
		 	$('select').css("border","2px solid green");
		 	var ancho = ancho1;
			var alto = alto1;
			if (ancho.length<=3) {
				ancho = "0."+ancho;
				alert(ancho);
			}
			if (alto.length<=3) {
				alto = "0."+alto
				alert(alto);
			}
			var cantidad = document.getElementById('cantidad').value; 
			if (ancho<=1.000 && alto<=1.000) {
				var precio = 350;
				var preciounitario = 350;
				var preciototal = precio * cantidad;
			}else{
				var precio = 50;
				var metrocuadrado = ancho *alto;
				var preciounitario = metrocuadrado * precio;
				preciounitario = preciounitario * 6.96;
				preciounitario = Math.round(preciounitario);
				var preciototal = preciounitario * cantidad;
			}
			document.getElementById('preciounitario').innerHTML = "<label style='color:#449d44!important;'>Precio Unitario</label><br><input type='text' name='preciou' value='"+preciounitario+"' > Bs.<br>";
			document.getElementById('preciototal').innerHTML = "<label style='color:#449d44!important;'>Precio Total</label><br><input type='text' name='preciot' value='"+preciototal+"' > Bs.<br>";
			}

///////////////////////////////////////////////////////////////
			if(tipo=="Ventana carpinteria de aluminio 2 hojas vidrio trasparente" && tipocantidad==="uno")
	 		{
		 	$('select').css("border","2px solid green");
		 	var ancho = ancho1;
			var alto = alto1;
			if (ancho.length<=3) {
				ancho = "0."+ancho;
				alert(ancho);
			}
			if (alto.length<=3) {
				alto = "0."+alto
				alert(alto);
			}
			var cantidad = document.getElementById('cantidad').value; 
			if (ancho<=1.000 && alto<=1.000) {
				var precio = 350;
				var preciounitario = 350;
				var preciototal = precio * cantidad;
			}else{
				var precio = 50;
				var metrocuadrado = ancho *alto;
				var preciounitario = metrocuadrado * precio;
				preciounitario = preciounitario * 6.96;
				preciounitario = Math.round(preciounitario);
				var preciototal = preciounitario * cantidad;
			}

			document.getElementById('preciounitario').innerHTML = "<label style='color:#449d44!important;'>Precio Unitario</label><br><input type='text' name='preciou' value='"+preciounitario+"' > Bs.<br>";
			document.getElementById('preciototal').innerHTML = "<label style='color:#449d44!important;'>Precio Total</label><br><input type='text' name='preciot' value='"+preciototal+"' > Bs.<br>";
			}
			if(tipo=="Ventana carpinteria de aluminio 2 hojas vidrio trasparente" && tipocantidad==="mas de tres")
	 		{
	 			
		 	$('select').css("border","2px solid green");
		 	var ancho = ancho1;
			var alto = alto1;
			if (ancho.length<=3) {
				ancho = "0."+ancho;
				alert(ancho);
			}
			if (alto.length<=3) {
				alto = "0."+alto
				alert(alto);
			}
			var cantidad = document.getElementById('cantidad').value; 
			if (ancho<=1.000 && alto<=1.000) {
				var precio = 350;
				var preciounitario = 350;
				var preciototal = precio * cantidad;
			}else{
				var precio = 45;
				var metrocuadrado = ancho *alto;
				var preciounitario = metrocuadrado * precio;
				preciounitario = preciounitario * 6.96;
				preciounitario = Math.round(preciounitario);
				var preciototal = preciounitario * cantidad;
			}
			document.getElementById('preciounitario').innerHTML = "<label style='color:#449d44!important;'>Precio Unitario</label><br><input type='text' name='preciou' value='"+preciounitario+"' > Bs.<br>";
			document.getElementById('preciototal').innerHTML = "<label style='color:#449d44!important;'>Precio Total</label><br><input type='text' name='preciot' value='"+preciototal+"' > Bs.<br>";
			}


		});
		});