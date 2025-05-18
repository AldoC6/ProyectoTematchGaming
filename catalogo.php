<!--La linea 2 representa el inicio de la estructura html5 y el navbar. includes/header.php -->
<?php include("includes/header.php"); ?>
<!--Inicio de Body -->
<div class="mt-5">
    <h3 class="text-center text-white">Juegos</h3>
</div>
<div class="container mt-2 p-5">
    <div class="row mb-3">
        <div class="col-md-3 mb-2">  <label for="genero" class="form-label text-white">Filtrar por género:</label>
            <select class="form-select" id="genero" name="genero">
                <option value="">Todos los géneros</option>
                <option value="Terror">Terror</option>
                <option value="Infantil">Infantil</option>
                <option value="Survival">Survival</option>
                <option value="Acción">Acción</option>
                <option value="Historia">Historia</option>
                <option value="Souls-Like">Souls-Like</option>
            </select>
        </div>
        <div class="col-md-3 mb-2"> <label for="anio" class="form-label text-white">Filtrar por año:</label>
            <select class="form-select" id="anio" name="anio">
                <option value="">Todos los años</option>
                </select>
        </div>
        <div class="col-md-3 mb-2"> <label for="orden" class="form-label text-white">Ordenar por:</label>
            <select class="form-select" id="orden" name="orden">
                <option value="">Sin ordenar</option>
                <option value="alfabetico_asc">Alfabético (A-Z)</option>
                <option value="alfabetico_desc">Alfabético (Z-A)</option>
                <option value="anio_asc">Año (Más antiguo primero)</option> <option value="anio_desc">Año (Más reciente primero)</option> </select>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4" id="lista-juegos">
        <?php
        // Supongamos que tienes una conexión a la base de datos llamada $conexion
        // y una tabla llamada 'juegos' con las columnas 'id', 'nombreJ', 'imagen', 'genero' y 'anio'.

        // Ejemplo de datos de juegos (esto se reemplazaría con tu consulta a la base de datos)
        $juegos_data = [
            ['id' => 1, 'nombreJ' => 'Balatro', 'imagen' => 'imagenesJuego/Balatro.jpg', 'genero' => 'Historia', 'anio' => 2024],
            ['id' => 2, 'nombreJ' => 'Dark Souls III', 'imagen' => 'imagenesJuego/darksouls3.jpg', 'genero' => 'Souls-Like', 'anio' => 2016],
            ['id' => 3, 'nombreJ' => 'Elden Ring', 'imagen' => 'imagenesJuego/EldenRing.jpeg', 'genero' => 'Souls-Like', 'anio' => 2022],
            ['id' => 4, 'nombreJ' => 'For Honor', 'imagen' => 'imagenesJuego/For_Honor.jpg', 'genero' => 'Acción', 'anio' => 2017],
            ['id' => 5, 'nombreJ' => 'Grand Theft Auto V', 'imagen' => 'imagenesJuego/GTAV.jpg', 'genero' => 'Acción', 'anio' => 2013],
            ['id' => 6, 'nombreJ' => 'Minecraft', 'imagen' => 'imagenesJuego/Minecraft.png', 'genero' => 'Infantil', 'anio' => 2011],
            ['id' => 7, 'nombreJ' => 'Outlast', 'imagen' => 'imagenesJuego/outlast.jpg', 'genero' => 'Terror', 'anio' => 2013],
            ['id' => 8, 'nombreJ' => 'Red Dead Redemption II', 'imagen' => 'imagenesJuego/RDR2.jpg', 'genero' => 'Acción', 'anio' => 2018],
            ['id' => 9, 'nombreJ' => 'Resident Evil 4', 'imagen' => 'imagenesJuego/residentevil4.jpg', 'genero' => 'Survival', 'anio' => 2023],
            // Agrega más juegos aquí con su género y año
        ];

        foreach ($juegos_data as $row) {
            echo "
            <div class='col' data-genero='{$row['genero']}' data-anio='{$row['anio']}' data-nombre='{$row['nombreJ']}'>
                <div class='card h-100'>
                    <img src='{$row['imagen']}' class='card-img-top object-fit-cover' style='height: 250px;' alt='{$row['nombreJ']}'>
                    <div class='card-body text-center'>
                        <h5 class='card-title'>{$row['nombreJ']}</h5>
                        <a href='reseña.php?id={$row['id']}' class='btn btn-primary btn-sm'>Ver reseña</a>
                    </div>
                </div>
            </div>
            ";
        }

        // El código original con la consulta a la base de datos sería:
        /*
        $sql = "SELECT * FROM juegos";
        $result = $conexion->query($sql);
        $juegos_data = []; // Necesitarías recolectar los datos para el JavaScript si usas PHP puro para el filtrado inicial de años
        while ($row = $result->fetch_assoc()) {
            $juegos_data[] = $row; // Guarda los datos para el script
            echo "
            <div class='col' data-genero='{$row['genero']}' data-anio='{$row['anio']}' data-nombre='{$row['nombreJ']}'>
                <div class='card h-100'>
                    <img src='{$row['imagen']}' class='card-img-top object-fit-cover' style='height: 250px;' alt='{$row['nombreJ']}'>
                    <div class='card-body text-center'>
                        <h5 class='card-title'>{$row['nombreJ']}</h5>
                        <a href='reseña.php?id={$row['id']}' class='btn btn-primary btn-sm'>Ver reseña</a>
                    </div>
                </div>
            </div>
            ";
        }
        */
        ?>
    </div>
</div>

<script>
    const filtroGenero = document.getElementById('genero');
    const filtroAnio = document.getElementById('anio'); // Nuevo selector para el año
    const filtroOrden = document.getElementById('orden');
    const listaJuegos = document.getElementById('lista-juegos');
    let juegos = Array.from(listaJuegos.querySelectorAll('.col')); // Convertir a array para sort

    // Función para poblar el filtro de años
    function poblarFiltroAnios() {
        const aniosUnicos = new Set();
        juegos.forEach(juego => {
            aniosUnicos.add(juego.dataset.anio);
        });

        // Ordenar los años (opcional, pero recomendado)
        const aniosOrdenados = Array.from(aniosUnicos).sort((a, b) => b - a); // De más reciente a más antiguo

        aniosOrdenados.forEach(anio => {
            const option = document.createElement('option');
            option.value = anio;
            option.textContent = anio;
            filtroAnio.appendChild(option);
        });
    }

    // Función para filtrar y ordenar los juegos
    function filtrarOrdenarJuegos() {
        const generoSeleccionado = filtroGenero.value;
        const anioSeleccionado = filtroAnio.value; // Obtener valor del filtro de año
        const ordenSeleccionado = filtroOrden.value;

        let juegosFiltrados = juegos.filter(juego => {
            const generoJuego = juego.dataset.genero;
            const anioJuego = juego.dataset.anio; // Obtener año del juego

            const cumpleGenero = (generoSeleccionado === '' || generoSeleccionado === generoJuego);
            const cumpleAnio = (anioSeleccionado === '' || anioSeleccionado === anioJuego); // Comprobar filtro de año

            return cumpleGenero && cumpleAnio;
        });

        // Ordenar los juegos filtrados
        switch (ordenSeleccionado) {
            case 'alfabetico_asc':
                juegosFiltrados.sort((a, b) => a.dataset.nombre.localeCompare(b.dataset.nombre));
                break;
            case 'alfabetico_desc':
                juegosFiltrados.sort((a, b) => b.dataset.nombre.localeCompare(a.dataset.nombre));
                break;
            case 'anio_asc': // Nueva opción de orden por año ascendente
                juegosFiltrados.sort((a, b) => parseInt(a.dataset.anio) - parseInt(b.dataset.anio));
                break;
            case 'anio_desc': // Nueva opción de orden por año descendente
                juegosFiltrados.sort((a, b) => parseInt(b.dataset.anio) - parseInt(a.dataset.anio));
                break;
        }

        // Limpiar la lista y agregar los juegos filtrados y ordenados
        listaJuegos.innerHTML = '';
        juegosFiltrados.forEach(juego => listaJuegos.appendChild(juego));
    }

    // Event listeners para los filtros y el orden
    filtroGenero.addEventListener('change', filtrarOrdenarJuegos);
    filtroAnio.addEventListener('change', filtrarOrdenarJuegos); // Event listener para el filtro de año
    filtroOrden.addEventListener('change', filtrarOrdenarJuegos);

    // Poblar el filtro de años al cargar la página
    document.addEventListener('DOMContentLoaded', () => {
        poblarFiltroAnios();
        // Opcional: puedes llamar a filtrarOrdenarJuegos() aquí si quieres aplicar filtros por defecto al cargar
        // filtrarOrdenarJuegos();
    });
</script>






<!-- Fin de Body -->
<?php include("includes/footer.php"); ?>
<!--La linea de arriba es el final de la estructura html5, basicamente donde se cierra el body y la etiqueta html-->