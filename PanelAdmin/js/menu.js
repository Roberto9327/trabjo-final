$(function(){
	//URL Global
	var urlmp = "http://localhost/medicion/PanelAdmin/";
	var urlmph = "http://localhost/medicion/";
	$("#agreusua").click(function(){	    
	    location.href="http://localhost/medicion/PanelAdmin/Usuarios/registrar_usuarios.php"; 
	 });
	$("#verusuar").click(function(){	    
	    location.href="http://localhost/medicion/PanelAdmin/Usuarios/ver_usuarios.php?pagina=1"; 
	 });
	$("#verprod").click(function(){	    
	    location.href="http://localhost/medicion/PanelAdmin/Productos/ver_producto.php?pagina=1"; 
	 });
	$("#regprod").click(function(){	    
	    location.href="http://localhost/medicion/PanelAdmin/Productos/registrar_producto.php"; 
	 });
	$("#catprod").click(function(){	    
	    location.href="http://localhost/medicion/PanelAdmin/Productos/agregar_categoria.php?pagina=1"; 
	 });
	$("#recpro").click(function(){	    
	    location.href="http://localhost/medicion/PanelAdmin/Productos/recargar_producto.php"; 
	 });
	$("#listrec").click(function(){	    
	    location.href="http://localhost/medicion/PanelAdmin/Productos/ver_recargas.php?pagina=1"; 
	 });
	$("#ubpro").click(function(){	    
	    location.href="http://localhost/medicion/PanelAdmin/Productos/agregar_ubicacion.php?pagina=1"; 
	 });
	$("#repventas").click(function(){	    
	    location.href="http://localhost/medicion/PanelAdmin/Productos/reportes_ventas.php?pagina=1"; 
	 });
	$("#vercot").click(function(){	    
	    location.href="http://localhost/medicion/PanelAdmin/Proforma/ver_proforma.php?pagina=1"; 
	 });
	$("#homep").click(function(){	    
	    location.href="http://localhost/medicion/home.php"; 
	 });
	$("#inicio").click(function(){	    
	    location.href="http://localhost/medicion/PanelAdmin/index.php"; 
	 });
});