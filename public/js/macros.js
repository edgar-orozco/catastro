$(document).ready(function()
{
    alert("prueba");
    $("input[name=opcion]").click(function() {
        if ($(this).val() == "moral")
        {
          alert('Tipo de persona '.$(this).val());
          $("#id_tipo").val(2);
          //oculta label de apellido_paterno
          $('#apellido_paterno').hide();
          //oculta input de apellido_paterno
          var apaterno = "persona[apellido_paterno]";
          $( "#" + apaterno.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).hide();
          //oculta label de apellido_materno
          $('#apellido_materno').hide();
          //oculta input de apellido_materno
          var amaterno = "persona[apellido_materno]";
          $( "#" + amaterno.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).hide();
          //oculta label de apellido_paterno
           $('#curp').hide();
          //oculta input de apellido_paterno
          var curp = "persona[curp]";
          $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).hide();
          $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).removeAttr('required');
                  }
           if ($(this).val() == "fisica")
        {
          alert('Tipo de persona '.$(this).val());
          $("#id_tipo").val(1);
          //muestra label de apellido_paterno
          $('#apellido_paterno').show();
          //muestra input de apellido_paterno
          var id = "persona[apellido_paterno]";
          $( "#" + id.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).show();
          //oculta label de apellido_materno
          $('#apellido_materno').show();
          //oculta input de apellido_materno
          var amaterno = "persona[apellido_materno]";
          $( "#" + amaterno.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).show();
          //muestra label de apellido_paterno
           $('#curp').show();
          //muestra input de apellido_paterno
          var curp = "persona[curp]";
          $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).show();
          $( "#" + curp.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr("required", "true");
                  }
    });
});