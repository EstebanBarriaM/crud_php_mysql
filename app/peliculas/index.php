<?php 
    require '../config/database.php';

    $sql = "SELECT p.id, p.nombre, p.descripcion, g.nombre AS genero FROM pelicula AS p
            INNER JOIN genero AS g
            ON p.id_genero=g.id";
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
                <?php while ($row_peliculas = $peliculas->fetch_assoc()) { ?>
                    <tr>
                        <td> <?php echo $row_peliculas['id'] ?> </td>
                        <td> <?php echo $row_peliculas['nombre'] ?> </td>
                        <td> <?php echo $row_peliculas['descripcion'] ?> </td>
                        <td> <?php echo $row_peliculas['genero'] ?> </td>
                        <td> IMAGEN </td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-id="<?php echo $row_peliculas['id'] ?>" data-bs-target="#editarModal" class="btn btn-sm btn-warning"> <i class="fa-regular fa-pen-to-square"></i> Editar</a>
                            <a href="#" data-bs-toggle="modal" data-bs-id="<?php echo $row_peliculas['id'] ?>" data-bs-target="#eliminaModal" class="btn btn-sm btn-danger"> <i class="fa-solid fa-trash"></i> Eliminar</a>
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
    <?php $generos->data_seek(0); ?>
    <?php include 'editarModal.php' ?>
    <?php include 'eliminaModal.php' ?>

    <script>

        let editModal = document.getElementById('editarModal');
        let eliminarModal = document.getElementById('eliminaModal');

        editModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-bs-id');

            let inputId = editModal.querySelector('.modal-body #id');
            let inputNombre = editModal.querySelector('.modal-body #nombre');
            let inputDescripcion = editModal.querySelector('.modal-body #descripcion');
            let inputGenero = editModal.querySelector('.modal-body #genero');

            let url = "getPelicula.php";
            let formData = new FormData();
            formData.append('id', id);

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response => response.json())
            .then(data => {
                inputId.value = data.id;
                inputNombre.value = data.nombre;
                inputDescripcion.value = data.descripcion;
                inputGenero.value = data.id_genero;
            }).catch(err => console.log(err))
        });

        eliminarModal.addEventListener('show.bs.modal', event => {
            let button = event.relatedTarget;
            let id = button.getAttribute('data-bs-id');

            eliminarModal.querySelector('.modal-footer #id').value = id;
        });

    </script>

    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>