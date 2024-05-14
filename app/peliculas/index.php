<?php 
    require '../config/database.php';

    $sql = "SELECT * FROM pelicula";
    $peliculas = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD MODAL</title>

    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/all.min.css">
</head>
<body>
    
    <div class="container py-3">

        <h2 class="text-center">Peliculas</h2>

        <div class="row justify-content-end">
            <div class="col-auto">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal"> <i class="fa-solid fa-plus"></i> Nuevo Registro</a>
            </div>
        </div>

        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Genero</th>
                    <th>Poster</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($peliculas as $pelicula) { ?>
                <tr>
                    <td> <?php echo $pelicula['id'] ?> </td>
                    <td> <?php echo $pelicula['nombre'] ?> </td>
                    <td> <?php echo $pelicula['descripcion'] ?> </td>
                    <td> <?php echo $pelicula['id_genero'] ?> </td>
                    <td> IMAGEN </td>
                    <td>
                        Editar|Eliminar
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

    <?php 
        $sqlGenero = "SELECT id, nombre FROM genero";
        $generos = $conn->query($sqlGenero);
    ?>

    <?php include 'nuevoModal.php'; ?>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>