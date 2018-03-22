/**
 * Created by Fercho on 12/09/2016.
 */
// uso baseComponente.inicializarAjax()
var handleBarsComponente = (function() {

    function compilar(selector,contexto){

        var source   = $(selector).html();
        var template = Handlebars.compile(source);
        if(contexto==undefined){
            contexto="";
        }
        return template(contexto);
    }

    function mostrarCompilado(selectorMostrar,selectorCompiler,contexto) {

        $(selectorMostrar).html(compilar(selectorCompiler,contexto));

    }

    // public API
    return {
        compilar:compilar,
        mostrarCompilado:mostrarCompilado
    };
})();