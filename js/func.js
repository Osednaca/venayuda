   var nav4 = window.Event ? true : false;

  function ValidaNumero(evt,obj)
  {
    var key = nav4 ? evt.which : evt.keyCode;
    var referencia; var d=String; var dec=String("");
    var valor = String(obj.value); 
    if (key<=13 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key==188)
    {   
      for (x=0; x<=valor.length;x++)
      {
        if (valor.indexOf('.')>-1) 
        { valor=valor.substr(0,valor.indexOf('.')) + valor.substr(valor.indexOf('.')+1,valor.length); }
      }
      var ext=valor.length;
      if (valor.indexOf(',')>-1) 
      { 
        dec = valor.substr(valor.indexOf(','),ext); 
        valor=valor.substr(0,valor.indexOf(','));
        ext = ext - dec.length;
        for (x=0; x<=dec.length;x++)
        {
          if (dec.indexOf(',')>-1) 
          { dec=dec.substr(0,dec.indexOf(',')) + dec.substr(dec.indexOf(',')+1,dec.length); }
        }
        dec = "," + dec;
      }
      var nn=Number(ext); 
      for (x=0;x<ext; x++) { nn = nn -3; if (nn < 3) { break;} }
      d=valor;
      for (x=ext-3;x>0; x=x-3) { d=d.substr(0,x) + '.' + d.substr(x,ext-x+7); }
      d = d + dec;
    }
    else
    {   
      var car = Number(key);
      valor=valor.toUpperCase();
      valor=valor.replace(/(^\.*)|(\.*$)/g,"");
      d=valor.replace(d.fromCharCode(car),"");
    }
    return d;
  }

function mayusculas(campo)
{
    campo.value=campo.value.toUpperCase();
}

function soloNumeros()
{
if ((event.keyCode < 48) || (event.keyCode > 57)) 
 event.preventDefault();
}

function soloLetras(e)
{
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
   especiales = [8,37,39,46];

   tecla_especial = false
   for(var i in especiales){
        if(key == especiales[i]){
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}

function validarfecha(e)
{
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   letras = "1234567890/";
   especiales = [8,37,39,46];

   tecla_especial = false
   for(var i in especiales){
        if(key == especiales[i]){
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}

function validarposicion(e)
{
   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toLowerCase();
   letras = "1234567890.";
   especiales = [8,37,39,46];

   tecla_especial = false
   for(var i in especiales){
        if(key == especiales[i]){
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}

function validaCorreo(id)
{
    if(document.getElementById(id).value!="")
    {
         var partes_cor=document.getElementById(id).value.split("@");
         if(partes_cor[0]=="")
         {
            BootstrapDialog.show({
              title: '<b style="font-size:16px;">Informaci&oacute;n</b>',
              message: '<div style="margin:0 auto;text-align: center;font-size:16px;">¡Correo mal escrito!</div>',
              onhidden: function(dialogItself){
                             $("#"+id).val("");
                          },
                    buttons: 
                    [
                      {
                    label: 'Ok',
                    action: function(dialogItself){
                            dialogItself.close();
                        }
                    }
                    ]
                });
            return false;
         }
         if(partes_cor[1]== null || partes_cor[1]=="")
         {
            BootstrapDialog.show({
              title: '<b style="font-size:16px;">Informaci&oacute;n</b>',
              message: '<div style="margin:0 auto;text-align: center;font-size:16px;">¡Correo mal escrito!</div>',
              onhidden: function(dialogItself){
                             $("#"+id).val("");
                          },
                    buttons: 
                    [
                      {
                    label: 'Ok',
                    action: function(dialogItself){
                            dialogItself.close();
                        }
                    }
                    ]
                });
            return false;
         }
          else
          {
               var partes_ext=partes_cor[1].split(".");
               if(partes_ext[0]=="")
               {
                    BootstrapDialog.show({
                      title: '<b style="font-size:16px;">Informaci&oacute;n</b>',
                      message: '<div style="margin:0 auto;text-align: center;font-size:16px;">¡Correo mal escrito!</div>',
                      onhidden: function(dialogItself){
                                     $("#"+id).val("");
                                  },
                            buttons: 
                            [
                              {
                            label: 'Ok',
                            action: function(dialogItself){
                                    dialogItself.close();
                                }
                            }
                            ]
                        });
                    return false;
               }
               if(partes_ext[1]== null || partes_ext[1]=="")
               {
                  BootstrapDialog.show({
                    title: '<b style="font-size:16px;">Informaci&oacute;n</b>',
                    message: '<div style="margin:0 auto;text-align: center;font-size:16px;">¡Correo mal escrito!</div>',
                    onhidden: function(dialogItself){
                                   $("#"+id).val("");
                                },
                          buttons: 
                          [
                            {
                          label: 'Ok',
                          action: function(dialogItself){
                                  dialogItself.close();
                              }
                          }
                          ]
                      });
                  return false;
               }
          }
          return true;
      }
}

var patron = new Array(2,2,4);
var patron2 = new Array(1,3,3,3,3);
var patron3 = new Array(2,2);
var patron4 = new Array(4,7);
function mascara(d,sep,pat,nums){
if(d.valant != d.value){
  val = d.value
  largo = val.length
  val = val.split(sep)
  val2 = ''
  for(r=0;r<val.length;r++){
    val2 += val[r]  
  }
  if(nums){
    for(z=0;z<val2.length;z++){
      if(isNaN(val2.charAt(z))){
        letra = new RegExp(val2.charAt(z),"g")
        val2 = val2.replace(letra,"")
      }
    }
  }
  val = ''
  val3 = new Array()
  for(s=0; s<pat.length; s++){
    val3[s] = val2.substring(0,pat[s])
    val2 = val2.substr(pat[s])
  }
  for(q=0;q<val3.length; q++){
    if(q ==0){
      val = val3[q]
    }
    else{
      if(val3[q] != ""){
        val += sep + val3[q]
        }
    }
  }
  d.value = val
  d.valant = val
  }
}


function fechaPosterior(desde,hasta)
{
      //cambiarian lo que hay dentro del getElement... por los elementos que contienen las fechas a validar
      // la fecha debe tener el formato siguiente dd/mm/yyyy
      var fechaInicio = document.getElementById(desde);
      var fechaFin = document.getElementById(hasta);
      var anio = parseInt(fechaInicio.value.substring(6,10));
      var mes = fechaInicio.value.substring(3,5);
      var dia = fechaInicio.value.substring(0,2);
      var c_anio = parseInt(fechaFin.value.substring(6,10));
      var c_mes = fechaFin.value.substring(3,5);
      var c_dia = fechaFin.value.substring(0,2);
      if(c_anio > anio)
          return(true);
      else{
          if (c_anio == anio){
              if(c_mes > mes)
                  return(true);
              if(c_mes == mes)
                  if(c_dia >= dia)
                      return(true);
                  else
                      return(false);
              else
                  return(false);
          }else
              return(false);
      }
  }

        $(window).on("resize",function()
        {
            if(document.documentElement.clientWidth<400)
            {
                $(".parallax-1").hide("slow");
                  $("#nom").attr("placeholder","Nombre");
                  $("#tlf").attr("placeholder","Nro. Tlf.");
                  $("#mail").attr("placeholder","E-mail");
                  $("#estado").attr("placeholder","Estado");
                  $("#user").attr("placeholder","Usuario");
                  $("#pass").attr("placeholder","Pass");
                  $("#rep_pass").attr("placeholder","Repita Pass");
                    //==> Frm Sesion
                    $("#user_login").attr("placeholder","Usuario");
                    $("#pass_login").attr("placeholder","Pass");
                    $("#mail_rec").attr("placeholder","E-mail");
            }
            else
            {
                $(".parallax-1").show("slow");
                $("#nom,#tlf,#mail,#estado,#user,#pass,#rep_pass,#user_login,#pass_login,#mail_rec").attr("placeholder","");
            }
        });

        if(document.documentElement.clientWidth<400){
          $("#nom").attr("placeholder","Nombre");
          $("#tlf").attr("placeholder","Nro. Tlf.");
          $("#mail").attr("placeholder","E-mail");
          $("#estado").attr("placeholder","Estado");
          $("#user").attr("placeholder","Usuario");
          $("#pass").attr("placeholder","Pass");
          $("#rep_pass").attr("placeholder","Repita Pass");
            //===> Frm sesion
                $("#user_login").attr("placeholder","Usuario");
                $("#pass_login").attr("placeholder","Pass");
                $("#mail_rec").attr("placeholder","E-mail");
        }

function crear_dialog(titulo,mensaje,idfocus,funcioncerrar){

      BootstrapDialog.show({
      title: '<b style="font-size:16px;">'+titulo+'</b>',
      message: '<div style="margin:0 auto;text-align: center;font-size:16px;">'+mensaje+'</div>',
      onhidden: function(dialogItself){
                    if(funcioncerrar=="rel"){
                      window.location.reload();
                    }else{
                      funcioncerrar
                    }
                    if(idfocus!="" || idfocus!=undefined){
                      $("#"+idfocus).focus();
                    }
                  },
            buttons: 
            [
              {
            label: 'Ok',
            action: function(dialogItself){
                    dialogItself.close();
                }
            }
            ]
        });
}

//===> Calendario espaniol

 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);