function gotopage1(municipio,manzana) {

    url="/cartografia/consultamz?muncipio="+municipio+"&manzana="+manzana+"&layer[]=Estado&layer[]=Carreteras&layer[]=Predios&layers[]=Manzanas";

if (manzana == 0) {
    alert('Debe selecionar correctamente todos los campos');
}else{
                location.href=url;

}
}

