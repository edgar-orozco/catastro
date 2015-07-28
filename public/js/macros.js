$(document).ready(function()
{
    $("input[type='radio']").click(function() {



           if ($(this).data('tipo') == "enajenante")
        {
          //alert( $(this).attr('id'));
          var tipo = $(this).val();
          //alert(tipo);
              if ($(this).val() == 2) {
                $("#id_tipo").val(2);
              var id = $(this).attr('id');
          //oculta label de apellido_paterno
          $('.'+id).hide();
          //oculta input de apellido_paterno
          var curp = id+"[curp]";
          $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).removeAttr('required');
        }



                  else if ($(this).val() ==1) {
                $("#id_tipo").val(1);
              var id = $(this).attr('id');
          //oculta label de apellido_paterno
          $('.'+id).show();
          //oculta input de apellido_paterno
          var curp = id+"[curp]";
          $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).removeAttr('required');
        }

}

       if ($(this).data('tipo') == "adquiriente")
        {
          //alert( $(this).attr('id'));
          var tipo = $(this).val();
          //alert(tipo);
              if ($(this).val() == 2) {
                $("#id_tipo").val(2);
              var id = $(this).attr('id');
          //oculta label de apellido_paterno
          $('.'+id).hide();
          //oculta input de apellido_paterno
          var curp = id+"[curp]";
          $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).removeAttr('required');
        }



                  else if ($(this).val() ==1) {
                $("#id_tipo").val(1);
              var id = $(this).attr('id');
          //oculta label de apellido_paterno
          $('.'+id).show();
          //oculta input de apellido_paterno
          var curp = id+"[curp]";
         $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr("required", "true");
        }

}


    });
});