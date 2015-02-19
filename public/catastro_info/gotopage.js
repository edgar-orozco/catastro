function openWindow2(url)
{

    var w = window.open (url, "win", "height=250,width=650,resizable,scrollbars,status");
    if (window.focus) {w.focus()}
        return false;

}



function gotopage1i(region,manzana,img) {

    
    var urll="";

    urll="/cgi-bin/geografica/reporte.pl?region="+region+"&manzana="+manzana+"&img="+img;
	
    openWindow2(urll);	
                //location.href=url;



	




}

function gotopage1(municipio,manzana) {

    url="/cartografia/consultamz?muncipio="+municipio+"&manzana="+manzana+"&layer[]=Estado&layer[]=Carreteras&layer[]=Predios&layers[]=Manzanas";


                location.href=url;

}

function gotopage3() {

    var dina = "Hola";
    var url="";

    url="/cgi-bin/geografica/catastro_info.pl";


                location.href=url;








}

function gotopage4(vmat,ont) {

    url="/cgi-bin/geografica/catastro_info.pl?vmat="+vmat+"&ontoy="+ont;


                location.href=url;

}
function gotopage5(td,fi,ff,chk,ont) {

    url="/cgi-bin/geografica/catastro_info.pl?td="+td+"&fi="+fi+"&ff="+ff+"&gen="+chk+"&ontoy="+ont;


    location.href=url;

}





function getLocation(){

	//pos_x = event.offsetX?(event.offsetX):event.pageX-document.getElementById("mapimg").offsetLeft;
	//pos_y = event.offsetY?(event.offsetY):event.pageY-document.getElementById("mapimg").offsetTop;

		x=document.getElementById('mapimg').x-value
		y=document.getElementById('mapimg').y-value
					
			alert("x"+x+" y"+y);
			//alert(y);
				
}

function catchme(evt)
{
	if (!evt) var evt = window.event;
	alert("Mouse X: " + evt.clientX + "\nMouse Y: " + evt.clientY);
	//document.getElementById("secretHidden").value = evt.clientX.concat(",") + evt.clientY;
} 
