(function(){  
	var initLayout = function() {
		var hash = window.location.hash.replace('#', '');
		var currentTab = $('ul.navigationTabs a')
							.bind('click', showTab)
							.filter('a[rel=' + hash + ']');
		if (currentTab.size() == 0) {
			currentTab = $('ul.navigationTabs a:first');
		}
		showTab.apply(currentTab.get(0));
		$('#date').DatePicker({
			flat: true,
			date: '2008-07-31',
			current: '2008-07-31',
			calendars: 1,
			starts: 1,
			view: 'years'
		});
		var now = new Date();
		now.addDays(-10);
		var now2 = new Date();
		now2.addDays(-5);
		now2.setHours(0,0,0,0);
		$('#date2').DatePicker({
			flat: true,
			date: ['2008-07-31', '2008-07-28'],
			current: '2008-07-31',
			format: 'Y-m-d',
			calendars: 1,
			mode: 'multiple',
			onRender: function(date) {
				return {
					disabled: (date.valueOf() < now.valueOf()),
					className: date.valueOf() == now2.valueOf() ? 'datepickerSpecial' : false
				}
			},
			onChange: function(formated, dates) {
			},
			starts: 0
		});
		$('#clearSelection').bind('click', function(){
			$('#date3').DatePickerClear();
			return false;
		});
		$('#date3').DatePicker({
			flat: true,
			date: ['2009-12-28','2010-01-23'],
			current: '2010-01-01',
			calendars: 3,
			mode: 'range',
			starts: 1
		});
		$('.inputDate').DatePicker({
			format:'Y/m/d',
			date: '2019/04/01',
			current: $('#inputDate').val(),
			starts: 1,
			position: 'right',
			onBeforeShow: function(){
				$('#inputDate').DatePickerSetDate($('#inputDate').val(), true);
			},
			onChange: function(formated, dates){
				$('#inputDate').val(formated);
				$('#inputDate').DatePickerHide();
				var fi=$("#inputDate").val();
				var ff=$("#inputDate1").val();
				var parametros = {
					"fi" : fi,
					"ff" : ff
				};
				$.ajax({
					data:  parametros,
					url:   'http://localhost/Ventas/Venta-Productos/consultarporfechadeventa.php',
					type:  'post',
					success: function(data)             
					{
					 $("#content-consvc").html(data);									 
					}
				});
			},
			onKeyUp: function(formated, dates){
				$('#inputDate').val(formated);
				$('#inputDate').DatePickerHide();
				var fi=$("#inputDate").val();
				var ff=$("#inputDate1").val();
				var parametros = {
					"fi" : fi,
					"ff" : ff
				};
				$.ajax({
					data:  parametros,
					url:   'http://localhost/Ventas/Venta-Productos/consultarporfechadeventa.php',
					type:  'post',
					success: function(data)             
					{
					 $("#content-consvc").html(data);									 
					}
				});
			}
		});
        $('.inputDate1').DatePicker({
			format:'Y/m/d',
			date: '2019/04/01',
			current: $('#inputDate1').val(),
			starts: 1,
			position: 'right',
			onBeforeShow: function(){
				$('#inputDate1').DatePickerSetDate($('#inputDate1').val(), true);
			},
			onChange: function(formated, dates){
				$('#inputDate1').val(formated);
				$('#inputDate1').DatePickerHide();
				var fi=$("#inputDate").val();
				var ff=$("#inputDate1").val();
				var parametros = {
					"fi" : fi,
					"ff" : ff
				};
				$.ajax({
					data:  parametros,
					url:   'http://localhost/Ventas/Venta-Productos/consultarporfechadeventa.php',
					type:  'post',
					success: function(data)             
					{
					 $("#content-consvc").html(data);									 
					}
				});
			},
			onKeyUp: function(formated, dates){
				$('#inputDate1').val(formated);
				$('#inputDate1').DatePickerHide();
				var fi=$("#inputDate").val();
				var ff=$("#inputDate1").val();
				var parametros = {
					"fi" : fi,
					"ff" : ff
				};
				$.ajax({
					data:  parametros,
					url:   'http://localhost/Ventas/Venta-Productos/consultarporfechadeventa.php',
					type:  'post',
					success: function(data)             
					{
					 $("#content-consvc").html(data);									 
					}
				});
			}
		});
		
		$(".elimventa").click(function(){ 
        var eliv=$(this).parent();	 
				$.confirm({
							'title'		: 'ELIMINAR VENTAS',
							'message'	: 'Esta Seguro de que desea eliminar esta Venta?',
							'buttons'	: {
								'Aceptar'	: {  
									'class'	: 'gray',
									'action': function(){
											eliv.parent().css("display","none");
											var id=eliv.parent().find(".valiventa").val();
											var parametros = {
													"id" : id
											};
											$.ajax({
													data:  parametros,
													url:   'http://localhost/Ventas/Venta-Productos/eliminarventas.php',
													type:  'post',
													success: function(data)             
													{
													 
													}
											});
																					
									}	    
								},
								'Cancelar'	: {
									'class'	: 'gray',
									'action': function(){}	
								}
							}
				});	    
        });
		
		$("#csesionp").click(function(){
	    var parametros = {};
		$.ajax({
                data:  parametros,
                url:   'http://localhost/Ventas/cerrar_sesion.php',
                type:  'post',               
                success:  function (response) { 
				  location.href="http://localhost/Ventas/";
                }
        });
        });
		$("#botvennueva").click(function(){
        var parametros = {};
		$.ajax({
											data:  parametros,
											url:   'http://localhost/Ventas/Venta-Productos/nuevaventa.php',
											type:  'post',
											success: function(data)             
											{										
											}
	    });
	 });
	 $("#botvennueva1").click(function(){
        var parametros = {};
		$.ajax({
											data:  parametros,
											url:   'http://localhost/Ventas/Venta-Productos/nuevaventa.php',
											type:  'post',
											success: function(data)             
											{										
											location.href="http://localhost/Ventas/Venta-Productos/buscarproductos.php";
											}
	    });
	 });
	 
	 $(".elimventa1").click(function(e){ 
     	    alert("hola");
     });
	 $("#botselventas").click(function(){
		    $.confirm({
					'title'		: 'ELIMINAR VENTAS SELECCIONADAS',
					'message'	: 'Esta Seguro de que desea eliminar las ventas seleccionadas?',
					'buttons'	: {
					    'Aceptar'	: {  
							'class'	: 'gray',
							'action': function(){
								    $("[name='seleccionvents[]']:checked").parent().parent().css("display","none");
									var arr = $('[name="seleccionvents[]"]:checked').map(function(){
									return this.value;
									}).get();
									var  seleccionados=arr.join(',');								
									var parametros = {
											"seleccionados" : seleccionados
									};
									$.ajax({
											data:  parametros,
											url:   'http://localhost/Ventas/Venta-Productos/eliminarseleccionadosventas.php',
											type:  'post',
											success: function(data)             
											{
												 
											}
									});			
							}	    
						},
						'Cancelar'	: {
							'class'	: 'gray',
							'action': function(){}	
						}
					}
		    });    
     });
	 $("#crvvc").click(function(){
			var tbus=$(this).val();
		    var fi=$("#inputDate").val();
			var ff=$("#inputDate1").val();
            if(tbus=="VER CANTIDAD DE REGISTROS")
			{
			tbus=10;
			}
			var parametros = {
					"tbus" : tbus,
					"fi" : fi,
					"ff" : ff
			};
			$.ajax({
					data:  parametros,
					url:   'http://localhost/Ventas/Venta-Productos/consultar_ventas_cantidad.php',
					type:  'post',
					success:  function (data) { 
							$('#content-consvc').html(data);
					}
			});
	    });
		var now3 = new Date();
		now3.addDays(-4);
		var now4 = new Date()
		$('#widgetCalendar').DatePicker({
			flat: true,
			format: 'd B, Y',
			date: [new Date(now3), new Date(now4)],
			calendars: 3,
			mode: 'range',
			starts: 1,
			onChange: function(formated) {
				$('#widgetField span').get(0).innerHTML = formated.join(' &divide; ');
			}
		});
		var state = false;
		$('#widgetField>a').bind('click', function(){
			$('#widgetCalendar').stop().animate({height: state ? 0 : $('#widgetCalendar div.datepicker').get(0).offsetHeight}, 500);
			state = !state;
			return false;
		});
		$('#widgetCalendar div.datepicker').css('position', 'absolute');
	};
	
	var showTab = function(e) {
		var tabIndex = $('ul.navigationTabs a')
							.removeClass('active')
							.index(this);
		$(this)
			.addClass('active')
			.blur();
		$('div.tab')
			.hide()
				.eq(tabIndex)
				.show();
	};
	EYE.register(initLayout, 'init');
	
})(jQuery)