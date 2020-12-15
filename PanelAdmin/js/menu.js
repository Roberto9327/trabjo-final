$(function(){
	//URL Global
	var urlmp = "http://localhost/medicion/PanelAdmin/"
	var urlmph = "http://localhost/medicion/"
	$("#agreusua").click(function(){	    
	    location.href=urlmp+"Usuarios/registrar_usuarios.php"; 
	 });
	$("#verusuar").click(function(){	    
	    location.href=urlmp+"Usuarios/ver_usuarios.php?pagina=1"; 
	 });
	$("#verprod").click(function(){	    
	    location.href=urlmp+"Productos/ver_producto.php?pagina=1"; 
	 });
	$("#regprod").click(function(){	    
	    location.href=urlmp+"Productos/registrar_producto.php"; 
	 });
	$("#catprod").click(function(){	    
	    location.href=urlmp+"Productos/agregar_categoria.php?pagina=1"; 
	 });
	$("#recpro").click(function(){	    
	    location.href=urlmp+"Productos/recargar_producto.php"; 
	 });
	$("#listrec").click(function(){	    
	    location.href=urlmp+"Productos/ver_recargas.php?pagina=1"; 
	 });
	$("#ubpro").click(function(){	    
	    location.href=urlmp+"Productos/agregar_ubicacion.php?pagina=1"; 
	 });
	$("#repventas").click(function(){	    
	    location.href=urlmp+"Productos/reportes_ventas.php?pagina=1"; 
	 });
	$("#vercot").click(function(){	    
	    location.href=urlmp+"Proforma/ver_proforma.php?pagina=1"; 
	 });
	$("#home").click(function(){	    
	    location.href=urlmph+"home.php"; 
	 });
});