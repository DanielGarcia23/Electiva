<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtApellido=(isset($_POST['txtApellido']))?$_POST['txtApellido']:"";
$txtCurso=(isset($_POST['txtCurso']))?$_POST['txtCurso']:"";
$txtContacto=(isset($_POST['txtContacto']))?$_POST['txtContacto']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";

$accionAgregar="";
$accionModificar=$accionEliminar=$accionCancelar="disabled";
$mostrarModal=false;

include("../Evaluacion4/Conexion/conexion.php");

switch($accion){
    case "btnA":

        $sentencia = $pdo->prepare("INSERT INTO estudiantes(nombre_e, apellido_e, curso_e, contacto_e) 
        VALUES (:nombre_e, :apellido_e, :curso_e, :contacto_e)");

        $sentencia->bindParam(':nombre_e',$txtNombre);
        $sentencia->bindParam(':apellido_e',$txtApellido);
        $sentencia->bindParam(':curso_e',$txtCurso);
        $sentencia->bindParam(':contacto_e',$txtContacto);
        $sentencia->execute();

        header('Location: index.php');

    break;

    case "btnM":

        $sentencia = $pdo->prepare("UPDATE estudiantes SET
        nombre_e=:nombre_e,
        apellido_e=:apellido_e,
        curso_e=:curso_e,
        contacto_e=:contacto_e WHERE
        id_estudiante=:id_estudiante");

        $sentencia->bindParam(':nombre_e',$txtNombre);
        $sentencia->bindParam(':apellido_e',$txtApellido);
        $sentencia->bindParam(':curso_e',$txtCurso);
        $sentencia->bindParam(':contacto_e',$txtContacto);
        $sentencia->bindParam(':id_estudiante',$txtID);
        $sentencia->execute();

        header('Location: index.php');

    break;

    case "btnE":

        $sentencia = $pdo->prepare(" DELETE FROM estudiantes  WHERE id_estudiante=:id_estudiante");

        $sentencia->bindParam(':id_estudiante',$txtID);
        $sentencia->execute();

        header('Location: index.php');

    break;

    case "btnC":
        header('Location: index.php');
    break;

    case "Seleccionar":
        $accionAgregar="disabled";
        $accionModificar=$accionEliminar=$accionCancelar="";
        $mostrarModal=true;

    break;

}

$sentencia=$pdo->prepare("SELECT * FROM `estudiantes` WHERE 1");
$sentencia->execute();
$listaEstudiantes=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//print_r($listaEstudiantes);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <div class="card" style="text-align: center;">
        <div class="card-body">
                <h2>LISTA DE ESTUDIANTES</h2>
        </div>
    </div>

    <div class="container">
        <form action="" method="POST">

        <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estudiante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">

                        <!-- Campos -->

                        <label for="">ID:</label>
                        <input type="text" class="form-control" name="txtID" placeholder="" value="<?php echo $txtID;?>" id="txtID" require="">
                        <br>

                        <label for="">Nombre:</label>
                        <input type="text" class="form-control" name="txtNombre" placeholder="" required value="<?php echo $txtNombre;?>" id="txtNombre" require="">
                        <br>

                        <label for="">Apellido:</label>
                        <input type="text" class="form-control" name="txtApellido" placeholder="" required value="<?php echo $txtApellido;?>" id="txtApellido" require="">
                        <br>
                        
                        <label for="">Curso:</label>
                        <input type="text" class="form-control" name="txtCurso" placeholder="" required value="<?php echo $txtCurso;?>" id="txtCurso" require="">
                        <br>

                        <label for="">Contacto:</label>
                        <input type="tel" class="form-control" name="txtContacto" placeholder="" required value="<?php echo $txtContacto;?>" id="txtContacto" require="">
                        <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Botones -->

                    <button value="btnA" <?php echo $accionAgregar;?> class="btn btn-primary" type="submit" name="accion">Agregar</button>
                    <button value="btnM" <?php echo $accionModificar;?> class="btn btn-warning" type="submit" name="accion">Modificar</button>
                    <button value="btnE" <?php echo $accionEliminar;?> class="btn btn-danger" type="submit" name="accion">Eliminar</button>
                    <button value="btnC" <?php echo $accionCancelar;?> class="btn btn-secondary" type="submit" name="accion">Cancelar</button>
                </div>
                </div>
            </div>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal">
            Agregar Informacion
            </button>
        </form>

            <!-- Tabla -->

    <div class="=row">

        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>Curso</th>
                    <th>Contacto</th>
                    <th>Acciones</th>
                </tr>
            </thead>

        <?php foreach($listaEstudiantes as $estudiante){ ?>
                <tr>
                    <td> <?php echo $estudiante['id_estudiante']; ?></td>
                    <td> <?php echo $estudiante['nombre_e']; ?> <?php echo $estudiante['apellido_e']; ?> </td>
                    <td> <?php echo $estudiante['curso_e']; ?></td>
                    <td> <?php echo $estudiante['contacto_e']; ?></td>

                    <td>
                    <form action="" method="POST">
                    <input type="hidden" name="txtID" value="<?php echo $estudiante['id_estudiante']; ?>">
                    <input type="hidden" name="txtNombre" value="<?php echo $estudiante['nombre_e']; ?>">
                    <input type="hidden" name="txtApellido" value="<?php echo $estudiante['apellido_e']; ?>">
                    <input type="hidden" name="txtCurso" value="<?php echo $estudiante['curso_e']; ?>">
                    <input type="hidden" name="txtContacto" value="<?php echo $estudiante['contacto_e']; ?>">

                    <input type="submit" class="btn btn-light" value="Seleccionar" name="accion">
                    <button value="btnE" class="btn btn-light" type="submit" name="accion">Eliminar</button>

                    </form>
                    </td>

                </tr>

        <?php } ?>
        </table>

    </div>

            <?php if($mostrarModal){?>
                <script>
                    $('#exampleModal').modal('show');
                </script>
            <?php }?>
    </div>

</body>

</html>