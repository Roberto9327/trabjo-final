$(function(){
	//URL Global
	var urlgm = "http://localhost/medicion/";

	$("#inicio").click(function(){	    
	    location.href="http://localhost/medicion/home.php"; 
	 });
	$("#paneladm").click(function(){	    
	    location.href="http://localhost/medicion/PanelAdmin/"; 
	 });
	$("#cotizacion").click(function(){	    
	    location.href="http://localhost/medicion/Cotizacion/index.php"; 
	 });
	$("#inventario").click(function(){	    
	    location.href="http://localhost/medicion/inventario/index.php?pagina=1"; 
	 });
	$("#verobra").click(function(){	    
	    location.href="http://localhost/medicion/Obra/ver_obra.php?pagina=1"; 
	 });
	$("#newobra").click(function(){	    
	    location.href="http://localhost/medicion/Obra/nueva_obra.php"; 
	 });
	$("#verproveedores").click(function(){	    
	    location.href="http://localhost/medicion/proveedores/index.php?pagina=1"; 
	 });
	$("#newproveedores").click(function(){	    
	    location.href="http://localhost/medicion/Proveedores/nuevo_proveedor.php"; 
	 });
	$("#verdirectorio").click(function(){	    
	    location.href="http://localhost/medicion/Directorio/index.php?pagina=1"; 
	 });
	
});