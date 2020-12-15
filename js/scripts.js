$(function(){
	var urlg = "http://localhost/medicion/";
    $.confirm = function(params){
		if($('#confirmOverlay').length){
			
			
			// A confirm is already shown on the page:
			return false;
		}
		
		var buttonHTML = '';
		$.each(params.buttons,function(name,obj){
			
			// Generating the markup for the buttons:
			
			buttonHTML += '<a href="#" class="button  '+obj['class']+'">'+name+'<span></span></a>';
			
			if(!obj.action){
				obj.action = function(){};
			}
		});
		
		var markup = [
			'<div id="confirmOverlay">',
			'<div id="confirmBox">',
			'<h1>',params.title,'</h1>',
			'<p>',params.message,'</p>',
			'<div id="confirmButtons">',
			buttonHTML,
			'</div></div></div>'
		].join('');
		
		$(markup).hide().appendTo('body').fadeIn();
		
		var buttons = $('#confirmBox .button'),
			i = 0;

		$.each(params.buttons,function(name,obj){
			buttons.eq(i++).click(function(){
				
				// Calling the action attribute when a
				// click occurs, and hiding the confirm.
				
				obj.action();
				$.confirm.hide();
				return false;
			});
		});
	}
	$.confirm.hide = function(){
		$('#confirmOverlay').fadeOut(function(){
			$(this).remove();
		});
	}
	 $("#blogin").click(function(){	    
	    var url=url+"login.php";
        $.ajax({
           type: "post",                 
           url: url,                     
           data: $("#flogin").serialize(), 
           success: function(data)             
           {
				if(data==0)
				{
				  $("#mensajelogin").html("El usuario o contraseña ingresados son incorrectos");            
				}
				else
				{
				  location.href=urlg+"home.php";
				}
		   }
        });       
	 });
	  $("#proforma").click(function(){	    
	    var url=url+"Cotizacion/generar_numero_proforma.php";
	    $.ajax({
           type: "post",
           url: url,                     
           data: $("#fproforma").serialize(), 
           success: function(data)             
           {
				if(data==0)
				{
				  //$("#mensajelogin").html("El usuario o contraseña ingresados son incorrectos");            
				}
				else
				{
				  location.href=url+"Cotizacion/index.php";
				}
		   }
        });     
	 });
	  $("#articulobtncat").click(function(){
		var url=urlg+"Cotizacion/agregar_articulo.php";
	    $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: $("#artf").serialize(),
           success: function(data)             
           {
				if(data==0)
				{
				  $("#mensajelogin").html("El usuario o contraseña ingresados son incorrectos");            
				}
				else
				{
					
				 if (data==1) {
				 	swal({
					  icon: 'success',
					  title: 'Exelente!',
					  text: 'Agregado al carrito'
					})
				 }
				 if (data==2) {
				 	swal({
					  icon: 'error',
					  title: 'Ups ...',
					  text: 'Cantidad de producto insuficiente'
					})
				 }
				 $(".swal-button").click(function(){ location.href=urlg+"Cotizacion/index.php"; })
				 //location.href="http://justo-juez.com/medicion/Proforma/index.php";
				}
		   }
        }); 
					});
	  $("#agregarbtn").click(function(){	
	  		  
	    var url=url+"Cotizacion/adicionaraventaser.php";
	    $.ajax({                        
           type: "post",                 
           url: url,                     
           data: $("#datostrab").serialize(),
           success: function(data)             
           {//alert(data);
				if(data==0)
				{
				  $("#mensajelogin").html("El usuario o contraseña ingresados son incorrectos");            
				}
				else
				{
					swal({
					  icon: 'success',
					  title: 'Exelente!',
					  text: 'Agregado al carrito'
					})
				  location.href=urlg+"Cotizacion/index.php";
				}
		   }
        });   
	 });
	  $("#agregarbtnotros").click(function(){	    
	    var url=urlg+"Cotizacion/agregar_otros.php";
	    $.ajax({                        
           type: "post",                 
           url: url,                     
           data: $("#datosotros").serialize(),
           success: function(data)             
           {
				if(data==0)
				{
				  $("#mensajelogin").html("El usuario o contraseña ingresados son incorrectos");            
				}
				else
				{
				  location.href=urlg+"Cotizacion/index.php";
				}
		   }
        });     
	 });
	  $("#ingresarDatosCliente").click(function(){	    
	    var url=urlg+"Cotizacion/agregar_nombreCliente.php";
	    $.ajax({                        
           type: "post",                 
           url: url,                     
           data: $("#datoscliente").serialize(),
           success: function(data)             
           {
			alert(data);
			location.href=urlg+"Cotizacion/carrito.php";
			
		   }
        });     
	 });
	  $("#buscarcat").click(function(){	 
	    var url=url+"Cotizacion/categoriaproducto.php";
	    $.ajax({                        
           type: "post",                 
           url: url,                     
           data: $("#fcategoria").serialize(),
           success: function(data)             
           {
				if(data==0)
				{
				  $("#mensajelogin").html("El usuario o contraseña ingresados son incorrectos");            
				}
				else
				{
				  location.href=urlg+"Cotizacion/index.php";
				}
		   }
        });     
	 });
	 $("#csesion").click(function(){
	    var parametros = {};
	    var cerrar = urlg+'cerrar_sesion.php';
		$.ajax({
                data:  parametros,
                url:   cerrar,
                type:  'post',               
                success:  function (response) { 
				  location.href="http://localhost/medicion/";
                }
        });
	 });
	 $("#buscarcatobra").click(function(){	 
	    var url=urlg+"Obra/categoriaobra.php";
	    $.ajax({                        
           type: "post",                 
           url: url,                     
           data: $("#fcategoria").serialize(),
           success: function(data)             
           {
				if(data==0)
				{
				  $("#mensajelogin").html("El usuario o contraseña ingresados son incorrectos");            
				}
				else
				{
				  location.href=urlg+"Obra/ver_obra.php?pagina=1&categoria="+data;
				}
		   }
        });     
	 });
	$("#vertodoobra").click(function(){	 
	    location.href=urlg+"Obra/ver_obra.php?pagina=1";
	 });
    $("#ingresarDatosNuevaObra").click(function(){	 
	    var url=urlg+"Obra/ingresar_datos_cl_ob.php";
	    $.ajax({                        
           type: "post",                 
           url: url,                     
           data: $("#fnobra").serialize(),
           success: function(data)             
           {
				if(data==0)
				{
				  $("#mensajeerror").html("error en introducir los datos");            
				}
				else
				{
				  location.href=urlg+"Obra/ver_obra.php?pagina=1";
				}
		   }
        });     
	 });
    $("#ingresarDatosdecompra").click(function(){	 
	    var url=urlg+"Obra/ingresar_datos_compra.php";
	    $.ajax({                        
           type: "post",                 
           url: url,                     
           data: $("#fformuagregar").serialize(),
           success: function(data)             
           {
				if(data==0)
				{
				  $("#mensajeerror").html("error en introducir los datos");            
				}
				else
				{
				  location.href=urlg+"Obra/detalle_obra.php?id="+data;
				}
		   }
        });     
	 });
    $("#ingresarDatosdepago").click(function(){	 
	    var url=urlg+"Obra/ingresar_datos_pago.php";
	    $.ajax({                        
           type: "post",                 
           url: url,                     
           data: $("#fformuagregarpago").serialize(),
           success: function(data)             
           {
				if(data==0)
				{
				  $("#mensajeerror").html("error en introducir los datos");            
				}
				else
				{
				  location.href=urlg+"Obra/detalle_obra.php?id="+data;
				}
		   }
        });     
	 });
 	$("#ingresardatosextras").click(function(){	 
	    var url=urlg+"Obra/ingresar_datos_extra.php";
	    $.ajax({                        
           type: "post",                 
           url: url,                     
           data: $("#fformuextra").serialize(),
           success: function(data)             
           {
				if(data==0)
				{
				  $("#mensajeerror").html("error en introducir los datos");            
				}
				else
				{
				  location.href=urlg+"Obra/detalle_obra.php?id="+data;
				}
		   }
        });     
	 });
 	$("#ingresarproveedor").click(function(){	 
	    var url=urlg+"Proveedores/ingresar_nuevo_proveedor.php";
	    $.ajax({                        
           type: "post",                 
           url: url,                     
           data: $("#ffnuevoproveedor").serialize(),
           success: function(data)             
           {
				if(data==0)
				{
				  $("#mensajeerror").html("error en introducir los datos");            
				}
				else
				{
				  location.href=urlg+"Proveedores/index.php?pagina=1";
				}
		   }
        });     
	 });
	$(document).on("click",".vent",function(e){ 
        var ven=$(this).parent();	 
		$.confirm({
					'title'		: 'Añadir Producto',
					'message'	: 'Esta Seguro que quiere añadir este producto?',
					'buttons'	: {
					    'Aceptar'	: {  
							'class'	: 'gray btn btn-primary btn-icon-split btn-sm',
							'action': function(){
							        var id=ven.parent().find(".valiv").val();
								    var parametros = {
											"id" : id
									};
									$.ajax({
											data:  parametros,
											url:   urlg+'Cotizacion/adicionaraventa.php',
											type:  'post',
											success: function(data)             
											{		
											swal({
											  icon: 'success',
											  title: 'Exelente!',
											  text: 'Agregado al carrito'
											})									 	 
											 var tot=data;
											 $("#valtotal").html("<b>TOTAL DE VENTA: </b> Bs."+tot);
											}
									});
                                    										
							}	    
						},
						'Cancelar'	: {
							'class'	: 'gray btn btn-secondary btn-icon-split',
							'action': function(){}	
						}
					}
		});	    
     });
	$(document).on("change",".canti",function(e){	    
			var eliv=$(this).parent();
			var id=eliv.parent().find(".valive").val();
            var ca=$(this).val();
			var pv=eliv.parent().find(".pven").html();
			var t=parseInt(ca)*parseInt(pv);
		    eliv.parent().find(".tot").html(t.toFixed(2));
			var parametros = {
											"id" : id,
											"cant" : ca,
											"total" : t
									};
									$.ajax({
											data:  parametros,
											url:   urlg+'Cotizacion/modificarcantidad.php',
											type:  'post',
											success: function(data)             
											{
											var tot=data;
										    $("#valtotal").html("<b>TOTAL DE VENTA: Bs.: </b>"+tot);
											}
									});
     });
	$(document).on("keyup",".canti",function(e){	    
			var eliv=$(this).parent();
			var id=eliv.parent().find(".valive").val();
            var ca=$(this).val();
			var pv=eliv.parent().find(".pven").html();
			var t=parseInt(ca)*parseInt(pv);
		    eliv.parent().parent().find(".tot").html(t.toFixed(2));
			var parametros = {
											"id" : id,
											"total" : t
									};
									$.ajax({
											data:  parametros,
											url:   urlg+'Cotizacion/modificarcantidad.php',
											type:  'post',
											success: function(data)             
											{
												var tot=data;
											    $("#valtotal").html("<b>TOTAL DE VENTA: Bs.</b>"+tot);				 
											}
									});
     });
	 $(document).on("click",".elimvent",function(e){ 
	 	alert('entra');
        var eli=$(this).parent();	 
		$.confirm({
					'title'		: 'ELIMINAR PRODUCTOS',
					'message'	: 'Esta Seguro de que desea eliminar este Producto?',
					'buttons'	: {
					    'Aceptar'	: {  
					    'class'	: 'gray  btn btn-primary btn-icon-split btn-sm',
							'action': function(){
							        eli.parent().css("display","none");
									var id=eli.parent().find(".valive").val();
								    var parametros = {
											"id" : id
									};						
									$.ajax({
											data:  parametros,
											url:   urlg+'Cotizacion/eliminardeventa.php',
											type:  'post',
											success: function(data)             
											{
											  $("#valtotal").html("<b>TOTAL DE VENTA: Bs.</b>"+data);
											  //location.href="http://localhost/Ventas/Venta-Productos/ventas.php";	
											}
									});
                                    									
							}	    
						},
						'Cancelar'	: {
							'class'	: 'gray  btn btn-secondary btn-icon-split',
							'action': function(){}	
						}
					}
		});	    
     });

});
function validar()
{  
	var sw=1;
	var sw1=1;
	var sw2=1;
	var sw3=1;
	var re=/^[a-zA-ZÀ-ÿ\s0-9\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
	var descripcion=$("input[name='descripcion']");
	if(!re.test(descripcion.val()) || descripcion.val()=="")
    {                        descripcion.val("");
	                         descripcion.attr("placeholder","Ingrese una descripción válida");
							 descripcion.css("border","2px solid red");
							 sw=0;
							
    }
	else
	{
	                         descripcion.attr("placeholder","");
							 descripcion.css("border","1px solid #ccc");
							 sw=1;
							 
	}
	var re1=/^[0-9]+(\.[0-9]+)?$/;
	var precioventa=$("input[name='precventa']");
	if(!re1.test(precioventa.val()) || precioventa.val()=="")
    {                        precioventa.val("");
	                         precioventa.attr("placeholder","Ingrese un precio de venta válido");
							 precioventa.css("border","2px solid red");
							 sw1=0;
							
    }
	else
	{
	                         precioventa.attr("placeholder","");
							 precioventa.css("border","1px solid #ccc");
							 sw1=1;
							 
	}
	var re2=/^[0-9]+(\.[0-9]+)?$/;
	var preciocompra=$("input[name='preccompra']");
	if(!re2.test(preciocompra.val()) || preciocompra.val()=="")
    {                        preciocompra.val("");
	                         preciocompra.attr("placeholder","Ingrese un precio de compra válido");
							 preciocompra.css("border","2px solid red");
							 sw2=0;
							
    }
	else
	{
	                         preciocompra.attr("placeholder","");
							 preciocompra.css("border","1px solid #ccc");
							 sw2=1;
							 
	}
	var re3=/^([0-9])*$/;
	var existencia=$("input[name='existencia']");
	if(!re3.test(existencia.val()) || existencia.val()=="")
    {                        existencia.val("");
	                         existencia.attr("placeholder","Ingrese una existencia válida");
							 existencia.css("border","2px solid red");
							 sw3=0;
							
    }
	else
	{
	                         existencia.attr("placeholder","");
							 existencia.css("border","1px solid #ccc");
							 sw3=1;
							 
	}
	if(sw==0 || sw1==0 || sw2==0 || sw3==0)
	 {
	  return false;
	 }
	 else
	 {
	  return true;
	 }
    
}
function validaru()
{  
	var sw=1;
	var sw1=1;
	var sw2=1;
	var sw3=1;
	var re=/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
	var nombre=$("input[name='nombre']");
	if(!re.test(nombre.val()) || nombre.val()=="")
    {                        nombre.val("");
	                         nombre.attr("placeholder","Ingrese una nombre válido");
							 nombre.css("border","2px solid red");
							 sw=0;
							
    }
	else
	{
	                         nombre.attr("placeholder","");
							 nombre.css("border","1px solid #ccc");
							 sw=1;
							 
	}
	var re1=/^[a-zA-ZÀ-ÿ\s0-9\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/;
	var usuario=$("input[name='usuario']");
	if(!re1.test(usuario.val()) || usuario.val()=="")
    {                        usuario.val("");
	                         usuario.attr("placeholder","Ingrese un usuario válido");
							 usuario.css("border","2px solid red");
							 sw1=0;
							
    }
	else
	{
	                         usuario.attr("placeholder","");
							 usuario.css("border","1px solid #ccc");
							 sw1=1;
							 
	}
	var password=$("input[name='password']");
	if(password.val()=="")
    {                        password.val("");
	                         password.attr("placeholder","Ingrese un password válido");
							 password.css("border","2px solid red");
							 sw2=0;
							
    }
	else
	{
	                         password.attr("placeholder","");
							 password.css("border","1px solid #ccc");
							 sw2=1;
							 
	}
	var tipo=$("select[name='tipo']");
	if(tipo.val()=="Seleccionar Tipo de Usuario")
    {                        
	                         tipo.css("border","2px solid red");
							 sw3=0;
    }
	else
	{
	                         tipo.attr("placeholder","");
							 tipo.css("border","1px solid #ccc");
							 sw3=1;
							 
	}
	if(sw==0 || sw1==0 || sw2==0 || sw3==0)
	 {
	  return false;
	 }
	 else
	 {
	  return true;
	 }
    
}