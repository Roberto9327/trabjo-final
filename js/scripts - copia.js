$(function(){
    $.confirm = function(params){
		if($('#confirmOverlay').length){
			
			
			// A confirm is already shown on the page:
			return false;
		}
		
		var buttonHTML = '';
		$.each(params.buttons,function(name,obj){
			
			// Generating the markup for the buttons:
			
			buttonHTML += '<a href="#" class="button '+obj['class']+'">'+name+'<span></span></a>';
			
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
	 $("#blogin").click(function(){	    
	    var url="http://justo-juez.com/medicion/login.php";
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
				  location.href="http://justo-juez.com/medicion/home.php";
				}
		   }
        });       
	 });
	  $("#proforma").click(function(){	    
	    var url="http://justo-juez.com/medicion/Proforma/generar_numero_proforma.php";
	    $.ajax({                        
           type: "POST",                 
           url: url,                     
           data: $("#fproforma").serialize(),
           success: function(data)             
           {
           	alert(data);
				if(data==0)
				{
				  $("#mensajelogin").html("El usuario o contraseña ingresados son incorrectos");            
				}
				else
				{
				  location.href="http://justo-juez.com/medicion/Proforma/index.php";
				}
		   }
        });     
	 });
	 
	 $("#csesion").click(function(){
	    var parametros = {};
		$.ajax({
                data:  parametros,
                url:   'http://justo-juez.com/medicion/cerrar_sesion.php',
                type:  'post',               
                success:  function (response) { 
				  location.href="http://justo-juez.com/medicion/";
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