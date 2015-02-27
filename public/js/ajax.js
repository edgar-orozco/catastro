function nuevoAjax(){ 
  var xmlhttp=false; 
  try { 
   // Creación del objeto ajax para navegadores diferentes a Explorer 
   xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); 
  } catch (e) { 
   // o bien 
   try { 
     // Creación del objet ajax para Explorer 
     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); } catch (E) { 
     xmlhttp = false; 
   } 
  } 

  if (!xmlhttp && typeof XMLHttpRequest!='undefined') { 
   xmlhttp = new XMLHttpRequest(); 
  } 
  return xmlhttp; 
} 

