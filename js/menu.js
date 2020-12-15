$(function(){
	//URL Global
	var urlgm = "http://localhost/medicion/";

	$("#inicio").click(function(){	    
	    location.href=urlgm+"home.php"; 
	 });
	$("#paneladm").click(function(){	    
	    location.href=urlgm+"PanelAdmin/"; 
	 });
	$("#cotizacion").click(function(){	    
	    location.href=urlgm+"Cotizacion/index.php"; 
	 });
	$("#inventario").click(function(){	    
	    location.href=urlgm+"inventario/index.php?pagina=1"; 
	 });
	$("#verobra").click(function(){	    
	    location.href=urlgm+"Obra/ver_obra.php?pagina=1"; 
	 });
	$("#newobra").click(function(){	    
	    location.href=urlgm+"Obra/nueva_obra.php"; 
	 });
	$("#verproveedores").click(function(){	    
	    location.href=urlgm+"proveedores/index.php?pagina=1"; 
	 });
	$("#newproveedores").click(function(){	    
	    location.href=urlgm+"Proveedores/nuevo_proveedor.php"; 
	 });
	$("#verdirectorio").click(function(){	    
	    location.href=urlgm+"Directorio/index.php?pagina=1"; 
	 });
	
});