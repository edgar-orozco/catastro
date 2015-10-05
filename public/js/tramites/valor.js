/**
 * Reglas de negocio del valor catastral
 */

var valCalle, valPredio, valCatastral, valUnitario, valAjustado, valTerreno, valSueloRustico;

var demFrente, demProf, demIrreg, demExc, demDniv, demPredIn, incEsquina;

var demConstruccionConservacion, demConstruccionEdad, demConstruccionTerminado;

var incRusticoViasCom, incRusticoDisCabecera, incRusticoCentroPob;

var actualizaValores, calculaValorConstrucciones, calculaDemeritosConstrucciones;

//Fija numeros con dos decimales.
var fixed = function(num){return Highcharts.numberFormat(num, 2, '.', ',');}

$(function () {

    //Cuando se aprieta este boton se actualizan los valores.
    $("#btn-actualizar-valor").on('click',function(e){
        e.preventDefault();
        actualizaValores();

        return false;
    });


    valTerreno = function(valCalle, supPredio){
        console.log("vc * sp = %s * %s", valCalle, supPredio);
        return valCalle * supPredio;
    }

    valAjustado = function(valCatastral, demeritos){
        return valCatastral * demeritos;
    }

    actualizaValores = function(){

        var dems = [];

        //Predios

        var supPredio = $('#sup_terreno').val();
        var valCalle = $('#valor_calle').val();
        var incEsquinaId = $('#inc_esquina_id').val();

        //parametros demeritos predio
        var parFrente = $('#dem_frente').val();
        var parProfFrente = $('#dem_prof_frente').val();
        var parProfProf = $('#dem_prof_prof').val();

        var parIrregular = $('#dem_irregular').val();
        var parSupExcavada = $('#dem_sup_excavada').val();
        var parProfExcavada = $('#dem_prof_excavada').val();

        var parDesnivelArea = $('#dem_desnivel_area').val();
        var parDesnivelPct = $('#dem_desnivel_pct').val();

        //Si el terreno es rústico entonces leemos datos de la forma
        var demPctRustico, incViasId, incDistCabmunId, incDistCenpobId;

        if(tipoTerreno == 'R') {
            demPctRustico = $('#dem_pct_rustico').val();
            incViasId = $('#inc_vias_rustico').val();
            incDistCabmunId = $('#inc_dist_cabmun').val();
            incDistCenpobId = $('#inc_dist_cenpob').val();
        }

        //TODO: ver que onda con este que se calcula muy diferente en el manual. En el manual no se solicita sup del paso de serv
        var demSupPasoServidumbre = $('#sup_paso_servidumbre').val();

        //Cálculos de deméritos

        var df = demFrente(parFrente);
        var dp = demProf(parProfFrente, parProfProf);
        var di = demIrreg(parIrregular, supPredio);

        var demsTerr = [];
        demsTerr.push(df);
        demsTerr.push(dp);
        demsTerr.push(di);

        var demCompuesto = 1;

        for(k in demsTerr){
            //console.log(" K %s, d[k] %s", k, demsTerr[k]);
            if(demsTerr[k]) {
                demCompuesto *= demsTerr[k];
            }
        }
        if(demCompuesto == 1 ) demCompuesto = 0;

        var de = demExc(parProfExcavada)  * parSupExcavada;
        var dd = demDniv(parDesnivelPct) * parDesnivelArea;

        var demTerreno = supPredio * demCompuesto + de + dd;

        var incPredio = incEsquina(incEsquinaId);

        var valorTerreno =  valTerreno(valCalle, supPredio) ;
        var demeritosTerreno = demTerreno;
        var incrementosTerreno = incPredio * valorTerreno;
        var valorAjustadoTerreno = valorTerreno - demeritosTerreno + incrementosTerreno;

        var valorConstrucciones = calculaValorConstrucciones();
        var demeritosConstrucciones = calculaDemeritosConstrucciones();
        var valorAjustadoConstruccion = valorConstrucciones - demeritosConstrucciones;


        if(tipoTerreno == 'R'){
            var incCompuesto = [];

            valorTerreno = valSueloRustico(supPredio) * supPredio;
            if(valorTerreno == 0) valorTerreno = 2500;
            var demori = demPctRustico;
            demPctRustico = demPctRustico / 100;
            if (demPctRustico > 0.5) demPctRustico = 0.5;
            console.log("Dem INP: %s Dem Lim: %s", demori, demPctRustico);
            demeritosTerreno = demPctRustico * valorTerreno;

            incCompuesto.push(incRusticoCentroPob(incDistCenpobId));
            incCompuesto.push(incRusticoDisCabecera(incDistCabmunId));
            incCompuesto.push(incRusticoViasCom(incViasId));

            console.log("IncRusCP: %s IncRusDC: %s IncRusVC: %s", incRusticoCentroPob(incDistCenpobId), incRusticoDisCabecera(incDistCabmunId), incRusticoViasCom(incViasId));

            var incrementos = 0;
            for(i in incCompuesto){
                if(incCompuesto[i] && incrementos == 0) incrementos = incCompuesto[i];
                else if(incCompuesto[i] && incrementos != 0 ) incrementos += incCompuesto[i];
            }

            if(incrementos > 0.3) incrementos = 0.3;

            incrementosTerreno = valorTerreno * incrementos;
            console.log("IncRustico = %s * %s = %s", valorTerreno, incrementos, incrementosTerreno);
            valorAjustadoTerreno = valorTerreno - demeritosTerreno + incrementosTerreno;

        }


        $('.valor-terreno').text(fixed(valorTerreno));
        $('.dem-terreno').text(fixed(demeritosTerreno));
        $('.inc-terreno').text(fixed(incrementosTerreno));

        $('.valor-construccion').text(fixed(valorConstrucciones));
        $('.dem-construccion').text(fixed(demeritosConstrucciones));
        $('.inc-construccion').text(fixed(0));

        $('.vajust-terreno').text(fixed(valorAjustadoTerreno));
        $('.vajust-construccion').text(fixed(valorAjustadoConstruccion));
        $('.valor-catastral').text(fixed(valorAjustadoTerreno + valorAjustadoConstruccion));

    }

    calculaValorConstrucciones = function(){
        var valorConstrucciones = 0;
        for(i in registrosConstrucciones.construcciones){
            if(i !== 'sup_albercas') {
                valorConstrucciones += Number(valuaBloqueConstruccion(i, municipio));
            }
        }
        return valorConstrucciones;
    }

    calculaDemeritosConstrucciones = function () {
        var demConstrucciones = 0;
        for(i in registrosConstrucciones.construcciones){
            if(i !== 'sup_albercas') {
                console.log("Dem B %s => %s x %s = %s",i,valuaBloqueConstruccion(i, municipio), demBloquesConstruccion(i), Number(valuaBloqueConstruccion(i, municipio)) * demBloquesConstruccion(i));
                demConstrucciones += Number(valuaBloqueConstruccion(i, municipio)) * demBloquesConstruccion(i);
            }
        }
        console.log("Dm ConstruccionesTot: %s", demConstrucciones);
        return demConstrucciones;

    }

//Deméritos

    //Dem por frente
    /**
     * El valor del terreno se reducirá solamente si el frente es menor de 7 metros. La
     formula que se aplica para calcular el Coeficiente de Castigo del demérito por
     frente es la siguiente:

     CCF = sqr(F/7)

     En donde, F = Frente del predio, en metros y siempre es menor a 7.
     La medida del frente se expresa en metros y centímetros y así se emplea en la
     formula.

     El Coeficiente de Castigo nunca será menor a 0.5; en caso de que el
     resultado de la operación sea inferior a ese valor, se tomara 0.5 como factor de
     demérito por frente.
     Ejemplo:
     Frente
     */

    demFrente = function(f){
        if(f > 7 || !f) return 0;
        var CCf = Math.sqrt(f/7);
        if(CCf < 0.5) CCf = 0.5;
        return CCf;
    }


    //Dem por profundidad
    /**
     * El valor del terreno urbano se reducirá cuando la relación profundidad/frente sea menor a 3.0
     */
    demProf = function(f,p){
        if( f/p > 3 || !f || !p) return 0;
        var CCp = Math.sqrt((f/p) * 3);
        return CCp;
    }

    //Dem por irregularidad terreno
    //Area regular, Area total del terreno
    demIrreg = function(ar, at){
        if(!ar || !at) return 0;
        var CC = Math.sqrt(ar/at);
        return CC;
    }

    //Dem excavaciones
    demExc = function(p){
        var pctDem = 0;
        var coef = 0;
        //Profundidad de la excavacion
        if(0 < p && p <= 1) {
            pctDem = 0; coef = 1;
        }
        if(1 < p && p <= 2) {
            pctDem = 10; coef = 0.9;
        }
        if(2 < p && p <= 4) {
            pctDem = 20; coef = 0.8;
        }
        if(4 < p && p <= 6) {
            pctDem = 30; coef = 0.7;
        }
        if(6 < p ) {
            pctDem = 50; coef = 0.5;
        }
        return coef;
    }

    //Dem por desnivel
    demDniv = function(p){
        var pctDem = 0;
        var coef = 0;
        //Profundidad de la excavacion
        if(0 < p && p <= 20) {
            pctDem = 0; coef = 1;
        }
        if(20 < p && p <= 30) {
            pctDem = 10; coef = 0.9;
        }
        if(30 < p && p <= 40) {
            pctDem = 20; coef = 0.8;
        }
        if(40 < p && p < 50) {
            pctDem = 30; coef = 0.7;
        }
        if(50 < p ) {
            pctDem = 50; coef = 0.5;
        }
        return coef;
    }

    //Dem por predio interior
    demPredIn = function(){
        //TODO: preguntar
        //No se especifica que hacer el manual de valuación con la sup del paso de servidumbre
    }

    //incremento de predio por esquina
    incEsquina = function(tipoEsquina){

        if(!tipoEsquina) return 0;

        //Comercial no comercial es 5%
        if(tipoEsquina == 1) return 0.05;
        //Comercial baja incremento es 15%
        if(tipoEsquina == 2) return 0.15;
        //Comercial alta incremento es 25%
        if(tipoEsquina == 3) return 0.25;


    }

    ///////////////////// De las construcciones

    demConstruccionConservacion = function(estado){
        if(!estado) return 0;
        //bueno
        var pctDem = 0;
        var coef = 1;
        if(estado == 1){
            pctDem = 0;
            coef = 1;
        }
        //estado regular
        if(estado == 2){
            pctDem = 10;
            coef = 0.9;
        }
        //estado malo
        if(estado == 3){
            pctDem = 20;
            coef = 0.8;
        }
        //Estado ruinoso (no se puso en la app)
        if(estado == 4){
            pctDem = 50;
            coef = 0.5;
        }
        return coef;
    }


    demConstruccionEdad = function(anioCons, anioHoy){
        if(!anioHoy || !anioCons) return 0;
        var edad = anioHoy - anioCons;
        if(!edad) return 0;
        var pctDem = 0;
        var coef = 1;
        if(edad <= 10){
            pctDem = 0;
        }
        if(10 < edad && edad <= 20){
            pctDem = 0.1;
        }
        if(20 < edad && edad <= 30){
            pctDem = 0.20;
        }
        if(30 < edad){
            pctDem = 0.30;
        }
        return pctDem;
    }

    demConstruccionTerminado = function(pct){
        if(!pct) return 0;
        var coef = 0;
        if(pct == 100){
            coef = 0;
        }
        if(80 <= pct && pct < 100){
            coef = 0.2;
        }
        if(0 < pct && pct < 80){
            coef = 0.4;
        }
        return coef;
    }

    /////////////////////// De los terrenos rústicos

    incRusticoViasCom = function(tipoVia){
        if(!tipoVia) return 0;
        //Carretera pavimentada
        var inc = 0;
        if(tipoVia == 1){
            inc = 0.2;
        }

        //carretera terracería
        if(tipoVia == 2){
            inc = 0.05;
        }
        return inc;
    }

    incRusticoDisCabecera = function(distId){
        if(!distId) return 0;

        var inc = 0;
        if(distId == 1){
            inc = 0.15;
        }
        if(distId == 2){
            inc = 0.10;
        }
        if(distId == 3){
            inc = 0.05;
        }
        return inc;
    }

    incRusticoCentroPob = function(distId){
        var inc = 0;
        if(distId == 1){
            inc = 0.10;
        }
        if(distId == 2){
            inc = 0.05;
        }
        return inc;
    }


    /**
     * Determina el valor de suelo rústico
     * Estas reglas salen de un documento llamado Tabla de Valores para predios rústicos
     * Emitida por la Secretaría de Administración y Finanzas, Subsecretaría de Ingresos, Dirección de Catastro de Tabasco.
     * @param m
     * @returns {number}
     */
    valSueloRustico = function(m){

        if(!m) return 0;
        if( 0 < m && m <= 5000) return 0;
        if( 5000 < m && m <= 50000) return 0.5;
        if( 50000 < m && m <= 100000) return 0.4;
        if( 100000 < m && m <= 150000) return 0.3;
        if( 150000 < m && m <= 250000) return 0.2;
        if( 250000 < m ) return 0.1;
    }


    /**
     * Valor de las albercas
     */
    valorAlberca = function(tipo, sup){
        return sup * valoresAlbercas[tipo];
    }

});