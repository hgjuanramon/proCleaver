/**
 * Created by Solutions on 25/10/2016.
 */
// uso bootstrapDialogComponente.mostrarError(mensaje)
var notificacionComponente = (function() {
	var datax = null;
	
    function mostrarError(mensaje, data){
        nf = Lobibox.notify('error', {
            showClass: 'rollIn',
            hideClass: 'rollOut',
            delay: 5000,
            msg: mensaje,
            title: 'Error',
            sound: false,
            messageHeight: $(window).height(),
            width: $(window).width()
        });
        datax = data;
        ttt = setTimeout(function () {
        	notificacionComponenteEventofn();
        	}, 240000);
        nf.$el.on('click', {data:data}, function(e){
        	notificacionComponenteEventofn();
        	ttt = null;
        });
        
    }

    function mostrarCorrecto(mensaje, data){
    	
        nf = Lobibox.notify('success', {
            showClass: 'rollIn',
            hideClass: 'rollOut',
            delay: 7000,
            msg: mensaje,
            title: 'Exito',
            sound: false,
            width: $(window).width()
        });
        datax = data;
        ttt = setTimeout(function () {
        	notificacionComponenteEventofn();
        	}, 7000);
        nf.$el.on('click', {data:data}, function(e){
        	notificacionComponenteEventofn();
        	ttt = null;
        });
    }

    function mostrarCorrectoRedirecion(mensaje, url){

        nf = Lobibox.notify('success', {
            showClass: 'rollIn',
            hideClass: 'rollOut',
            delay: 7000,
            msg: mensaje,
            title: 'Exito',
            sound: false,
            width: $(window).width()
        });
        ttt = setTimeout(function () {
            window.location.replace(url);
        }, 7000);
        nf.$el.on('click', {data:data}, function(e){
            window.location.replace(url);
            ttt = null;
        });
    }
    
    function notificacionComponenteEventofn() {
        $(document).trigger('notificacionComponenteEvento', datax);        	
    }
    

    // public API
    return {
        mostrarCorrecto:mostrarCorrecto,
        mostrarError:mostrarError,
        mostrarCorrectoRedireccion:mostrarCorrectoRedirecion
    };
})();