<?php


/**
**
**  BY iCODEART
**
**********************************************************************
**                      REDES SOCIALES                            ****
**********************************************************************
**                                                                ****
** FACEBOOK: https://www.facebook.com/icodeart                    ****
** TWIITER: https://twitter.com/icodeart                          ****
** YOUTUBE: https://www.youtube.com/c/icodeartdeveloper           ****
** GITHUB: https://github.com/icodeart                            ****
** TELEGRAM: https://telegram.me/icodeart                         ****
** EMAIL: info@icodeart.com                                       ****
**                                                                ****
**********************************************************************
**********************************************************************
**/

// Definimos nuestra zona horaria
date_default_timezone_set("America/Mazatlan");

// incluimos el archivo de funciones
include 'funciones.php';

// incluimos el archivo de configuracion
include 'config.php';

// Verificamos si se ha enviado el campo con name from
if (isset($_POST['from'])) 
{

    // Si se ha enviado verificamos que no vengan vacios
    if ($_POST['from']!="" AND $_POST['to']!="") 
    {

        // Recibimos el fecha de inicio y la fecha final desde el form

        $inicio = _formatear($_POST['from']);

        // y la formateamos con la funcion _formatear

        $final = _formatear($_POST['to']);

        //Horas formateadas 
        $iniciofor = _formatearhora($_POST['timefrom']);

        //Horas formateadas
        $finalfor = _formatearhora($_POST['timeto']);

        // Recibimos el fecha de inicio y la fecha final desde el form
        $inicio_normal = $_POST['from'];

        // y la formateamos con la funcion _formatear
        $final_normal  = $_POST['to'];


        $horas_inicio = $_POST['timefrom'];


        $horas_final = $_POST['timeto'];

        // Recibimos los demas datos desde el form
        $profe = $_POST['profe'];

        // Recibimos el nombre de la materia
        $materia = $_POST['materia'];

        // y con la funcion evaluar
        $descr   = $_POST['descr'];

        // reemplazamos los caracteres no permitidos
        $clase  = evaluar($_POST['class']);

        // Recibimos la variable de el numero de laboratorio 
        $numlab = $_POST['nolab'];

        // Recibimos la variable de el grupo
        $grupo = $_POST['grupo'];

        // Recibimos la variable de el estado de el laboratorio
        $estlab = $_POST['estalab'];

        // insertamos el evento 
        $query="INSERT INTO eventos VALUES(null,'$materia','$profe','','event-important','$inicio','$final','$inicio_normal','$final_normal',$numlab,'$estlab','$horas_inicio','$horas_final','$descr','$iniciofor','$finalfor','$grupo')";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query); 

        // Obtenemos el ultimo id insetado
        $im=$conexion->query("SELECT MAX(id) AS id FROM eventos");
        $row = $im->fetch_row(); 
        $id = trim($row[0]);

        // para generar el link del evento
        $link = "$base_url"."descripcion_evento.php?id=$id";

        // y actualizamos su link
        $query="UPDATE eventos SET url = '$link' WHERE id = $id";

        // Ejecutamos nuestra sentencia sql
        $conexion->query($query); 

        // redireccionamos a nuestro calendario
        header("Location:$base_url");
    }
}

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="utf-8">
        <title>Calendario</title>
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=$base_url?>css/calendar.css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <script type="text/javascript" src="<?=$base_url?>js/es-ES.js"></script>
        <script src="<?=$base_url?>js/jquery.min.js"></script>
        <script src="<?=$base_url?>js/moment.js"></script>
        <script src="<?=$base_url?>js/bootstrap.min.js"></script>
        <script src="<?=$base_url?>js/bootstrap-datetimepicker.js"></script>
        <link rel="stylesheet" href="<?=$base_url?>css/bootstrap-datetimepicker.min.css" />
        <script src="<?=$base_url?>js/bootstrap-datetimepicker.es.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
        <script src="https://www.gstatic.com/firebasejs/3.6.7/firebase.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>

</head>
<body style="background: white;">
<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
  <div class="container2">
    <div class="navbar-header">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="./" class="navbar-brand">UTNAY</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
          <a href="auth.php">Configurar Horarios</a>
        </li>
      </ul>
        <ul class="nav navbar-nav navbar-right">

        <li>
          <a id="btnLogout" class="btn-action btn glyphicon glyphicon-log-out">Salir</a>
        </li>
        </ul>
    </nav>
  </div>
</header>

        
        <div class="container">

                <div class="row">
                        <div class="page-header"><h2></h2></div>
                                <div class="pull-left form-inline"><br>
                                        <div class="btn-group">
                                            <button class="btn btn-primary" data-calendar-nav="prev"><< Anterior</button>
                                            <button class="btn" data-calendar-nav="today">Hoy</button>
                                            <button class="btn btn-primary" data-calendar-nav="next">Siguiente >></button>
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn btn-warning" data-calendar-view="year">Año</button>
                                            <button class="btn btn-warning active" data-calendar-view="month">Mes</button>
                                            <button class="btn btn-warning" data-calendar-view="week">Semana</button>
                                            <button class="btn btn-warning" data-calendar-view="day">Dia</button>
                                        </div>

                                </div>
                                    <div class="pull-right form-inline"><br>
                                        <button class="btn btn-info" data-toggle='modal' data-target='#add_evento'>Añadir Evento</button>
                                    </div>

                </div><hr>

                <div class="row">
                        <div id="calendar"></div> <!-- Aqui se mostrara nuestro calendario -->
                        <br><br>
                </div>

                <!--ventana modal para el calendario-->
                <div class="modal fade" id="events-modal">
                    <div class="modal-dialog">
                            <div class="modal-content">
                                    <div class="modal-body" style="height: 400px">
                                        <p>One fine body&hellip;</p>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
        </div>

    <script src="<?=$base_url?>js/underscore-min.js"></script>
    <script src="<?=$base_url?>js/calendar.js"></script>
    <script type="text/javascript">
        (function($){
                //creamos la fecha actual
                var date = new Date();
                var yyyy = date.getFullYear().toString();
                var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
                var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

                //establecemos los valores del calendario
                var options = {

                    // definimos que los eventos se mostraran en ventana modal
                        modal: '#events-modal', 

                        // dentro de un iframe
                        modal_type:'iframe',    

                        //obtenemos los eventos de la base de datos
                        events_source: '<?=$base_url?>obtener_eventos.php', 

                        // mostramos el calendario en el mes
                        view: 'month',             

                        // y dia actual
                        day: yyyy+"-"+mm+"-"+dd,   


                        // definimos el idioma por defecto
                        language: 'es-ES', 

                        //Template de nuestro calendario
                        tmpl_path: '<?=$base_url?>tmpls/', 
                        tmpl_cache: false,


                        // Hora de inicio
                        time_start: '07:00', 

                        // y Hora final de cada dia
                        time_end: '20:00',   

                        // intervalo de tiempo entre las hora, en este caso son 30 minutos
                        time_split: '30',    

                        // Definimos un ancho del 100% a nuestro calendario
                        width: '100%', 

                        onAfterEventsLoad: function(events)
                        {
                                if(!events)
                                {
                                        return;
                                }
                                var list = $('#eventlist');
                                list.html('');

                                $.each(events, function(key, val)
                                {
                                        $(document.createElement('li'))
                                                .html('<a href="' + val.url + '">' + val.title + '</a>')
                                                .appendTo(list);
                                });
                        },
                        onAfterViewLoad: function(view)
                        {
                                $('.page-header h2').text(this.getTitle());
                                $('.btn-group button').removeClass('active');
                                $('button[data-calendar-view="' + view + '"]').addClass('active');
                        },
                        classes: {
                                months: {
                                        general: 'label'
                                }
                        }
                };


                // id del div donde se mostrara el calendario
                var calendar = $('#calendar').calendar(options); 

                $('.btn-group button[data-calendar-nav]').each(function()
                {
                        var $this = $(this);
                        $this.click(function()
                        {
                                calendar.navigate($this.data('calendar-nav'));
                        });
                });

                $('.btn-group button[data-calendar-view]').each(function()
                {
                        var $this = $(this);
                        $this.click(function()
                        {
                                calendar.view($this.data('calendar-view'));
                        });
                });

                $('#first_day').change(function()
                {
                        var value = $(this).val();
                        value = value.length ? parseInt(value) : null;
                        calendar.setOptions({first_day: value});
                        calendar.view();
                });
        }(jQuery));
    </script>

<div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Agregar nuevo evento</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post">

         <label for="nolab">Laboratorio No.</label>
                    <select class="form-control" name="nolab" id="nolab">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                    </select>

                    <br>

                    <label for="from">Inicio</label>
                    <div class='input-group date datetimepicker' id='from'>
                         <input class="form-control" data-format="yyyy-dd-MM" type="text" name="from" id="from" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div>

                    <br>

                    <label for="to">Final</label>
                    <div class='input-group date datetimepicker' id='to'>
                        <input type='text' name="to" id="to" data-format="yyyy-dd-MM" class="form-control" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div>

                    <br>
                    
                    <label for="timefrom">Tiempo inicio</label>
                    <div class='input-group date datetimepicker3' id='timefrom'>
                    <input type='text' name="timefrom" id="timefrom" class="form-control" readonly/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
    
                    <br>

                    <label for="timeto">Tiempo final</label>
                    <div class='input-group date datetimepicker3' id='timeto'>
                    <input type='text' name="timeto" id="timefrom" class="form-control" readonly/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
    
                    <br>

                    <label for="tipo">Estado del Laboratorio</label>
                    <select class="form-control" name="estalab" id="estalab">
                        <option value="Ocupado">Ocupado</option>
                        <option value="Disponible">Disponible</option>
                        <option value="En mantenimiento">En mantenimiento</option>
                        <option value="event-warning">...</option>
                        <option value="event-special">....</option>
                    </select>

                    <br>


                    <label for="profe">Profesor</label>
                    <input type="text" required autocomplete="off" name="profe" class="form-control" id="profe" placeholder="Introduce el nombre del profesor">

                    <br>

                    <label for="materia">Materia</label>
                    <input type="text" required autocomplete="off" name="materia" class="form-control" id="materia" placeholder="Introduce el nombre de materia">

                       <br>

                    <label for="grupo">Grupo</label>
                    <input type="text" required autocomplete="off" name="grupo" class="form-control" id="grupo" placeholder="Introduce el grupo correspondiente ejemplo(ITI-101, SP-12, PAL-42)">


                    <br>

                    <label for="descr">Descripcion</label>
                    <textarea id="descr" name="descr" required class="form-control" rows="3"></textarea>
                    <script type="text/javascript">
            $(function () {
                $('.datetimepicker3').datetimepicker({
                    format: 'HH:mm',
                    pickDate:false
                });
            });
        </script>
<script type="text/javascript">
  $(function() {
    // Bootstrap DateTimePicker v4
    $('.datetimepicker').datetimepicker({
      format: 'DD/MM/YYYY'
    });
  });
</script>

      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
          <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Agregar</button>
        </form>
    </div>
  </div>
</div>
</div>
    <script src="js/app2.js"></script>
</body>
</html>
