<!--La linea 2 representa el inicio de la estructura html5 y el navbar. includes/header.php -->
<?php include("includes/header.php"); ?>
<!--Inicio de Body -->
<div class="mt-5">
    <h3 class="text-center text-white">Juegos Destacados</h3>
</div>
<div class="container mt-2 p-5">
    <div class="row mb-3 p-3 rounded" style="background-color: #2c3034;">
        <div class="col-md-4 mb-2">
            <label for="destacados-filtro-genero" class="form-label text-white">Género:</label>
            <select class="form-select form-select-sm" id="destacados-filtro-genero">
                <option value="">Todos</option>
                <?php
                // Opcional: Poblar géneros directamente desde la tabla 'generos'
                // if (isset($conexion) && $conexion instanceof mysqli) {
                //     $sql_todos_generos = "SELECT id, nombre FROM generos ORDER BY nombre ASC";
                //     $result_todos_generos = $conexion->query($sql_todos_generos);
                //     if ($result_todos_generos && $result_todos_generos->num_rows > 0) {
                //         while($row_gen = $result_todos_generos->fetch_assoc()) {
                //             echo "<option value='" . htmlspecialchars($row_gen['nombre']) . "'>" . htmlspecialchars($row_gen['nombre']) . "</option>";
                //         }
                //     }
                // }
                // Por ahora, se poblará con JavaScript basado en los juegos destacados cargados.
                ?>
            </select>
        </div>
        <div class="col-md-4 mb-2">
            <label for="destacados-filtro-anio" class="form-label text-white">Año:</label>
            <select class="form-select form-select-sm" id="destacados-filtro-anio">
                <option value="">Todos</option>
                {/* Las opciones de año se poblarán dinámicamente con JavaScript */}
            </select>
        </div>
        <div class="col-md-4 mb-2">
            <label for="destacados-filtro-orden" class="form-label text-white">Orden:</label>
            <select class="form-select form-select-sm" id="destacados-filtro-orden">
                <option value="">Relevancia (Defecto)</option>
                <option value="alfabetico_asc">Alfabético (A-Z)</option>
                <option value="alfabetico_desc">Alfabético (Z-A)</option>
                <option value="anio_asc">Año (Más antiguo)</option>
                <option value="anio_desc">Año (Más reciente)</option>
            </select>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4" id="juegos-destacados-grid">
        <?php
        if (isset($conexion) && $conexion instanceof mysqli) {
            $sql_destacados = "SELECT j.id, j.nombreJ, j.imagen, g.nombre AS nombre_genero, YEAR(j.fecha_lanzamiento) AS anio_lanzamiento 
                               FROM juegos j
                               LEFT JOIN generos g ON j.id_genero = g.id
                               WHERE j.nombreJ NOT IN ('Resident Evil 4', 'Outlast') 
                               ORDER BY j.id DESC LIMIT 9";
            $result_destacados = $conexion->query($sql_destacados);

            if ($result_destacados && $result_destacados->num_rows > 0) {
                while ($row_destacado = $result_destacados->fetch_assoc()) {
                    echo "
                    <div class='col' data-genero='" . htmlspecialchars($row_destacado['nombre_genero'] ?? '') . "' data-anio='" . htmlspecialchars($row_destacado['anio_lanzamiento'] ?? '') . "' data-nombre='" . htmlspecialchars($row_destacado['nombreJ'] ?? '') . "'>
                        <div class='card h-100'>
                            <img src='" . htmlspecialchars($row_destacado['imagen'] ?? 'path/to/default-image.jpg') . "' class='card-img-top object-fit-cover' style='height: 250px;' alt='" . htmlspecialchars($row_destacado['nombreJ'] ?? 'Juego Destacado') . "'>
                            <div class='card-body text-center d-flex flex-column'>
                                <h5 class='card-title'>" . htmlspecialchars($row_destacado['nombreJ'] ?? 'Título no disponible') . "</h5>
                                <a href='reseña.php?id=" . intval($row_destacado['id']) . "' class='btn btn-primary btn-sm mt-auto'>Ver reseña</a>
                            </div>
                        </div>
                    </div>
                    ";
                }
            } else {
                echo "<div class='col-12'><p class='text-white text-center'>No hay juegos destacados para mostrar.</p></div>";
            }
        } else {
            echo "<div class='col-12'><p class='text-white text-center'>Error: La conexión a la base de datos no está disponible para cargar los juegos destacados.</p></div>";
        }
        ?>
    </div>
    <div id="no-juegos-destacados-filtrados-mensaje" class="text-white text-center col-12 mt-3" style="display: none;">
        No hay juegos destacados que coincidan con los filtros.
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // --- Selectores y variables para "Juegos Destacados" ---
    const filtroGeneroDestacados = document.getElementById('destacados-filtro-genero');
    const filtroAnioDestacados = document.getElementById('destacados-filtro-anio');
    const filtroOrdenDestacados = document.getElementById('destacados-filtro-orden');
    const listaJuegosDestacadosContainer = document.getElementById('juegos-destacados-grid');
    const noJuegosDestacadosFiltradosMensaje = document.getElementById('no-juegos-destacados-filtrados-mensaje');
    let todosLosJuegosDestacadosOriginales = [];

    if (listaJuegosDestacadosContainer) {
        todosLosJuegosDestacadosOriginales = Array.from(listaJuegosDestacadosContainer.querySelectorAll('.col'));
        // console.log('Juegos Destacados Originales:', todosLosJuegosDestacadosOriginales.length, todosLosJuegosDestacadosOriginales);
    } else {
        console.error("Contenedor '#juegos-destacados-grid' no encontrado.");
        return; 
    }

    function poblarFiltroSelect(selectElement, dataAttributeKey, juegosArray, sortNumericDesc = false) {
        if (!selectElement || juegosArray.length === 0) {
            return;
        }
        const valoresUnicos = new Set();
        juegosArray.forEach(juegoNode => {
            if (juegoNode.nodeType === 1 && juegoNode.dataset[dataAttributeKey] && String(juegoNode.dataset[dataAttributeKey]).trim() !== "") {
                valoresUnicos.add(String(juegoNode.dataset[dataAttributeKey]).trim());
            }
        });
        let valoresOrdenados;
        if (dataAttributeKey === 'anio' && sortNumericDesc) {
            valoresOrdenados = Array.from(valoresUnicos).sort((a, b) => parseInt(b) - parseInt(a));
        } else {
            valoresOrdenados = Array.from(valoresUnicos).sort((a, b) => a.localeCompare(b));
        }
        const valorSeleccionadoAnteriormente = (selectElement.options.length > 0 && selectElement.value !== "") ? selectElement.value : null;
        while (selectElement.options.length > 1) {
            selectElement.remove(1);
        }
        valoresOrdenados.forEach(valor => {
            const option = document.createElement('option');
            option.value = valor;
            option.textContent = valor;
            selectElement.appendChild(option);
        });
        if (valorSeleccionadoAnteriormente && valoresOrdenados.includes(valorSeleccionadoAnteriormente)) {
            selectElement.value = valorSeleccionadoAnteriormente;
        }
    }

    function filtrarOrdenarJuegosDestacados() {
        if (!listaJuegosDestacadosContainer) return;

        const generoSeleccionado = filtroGeneroDestacados ? filtroGeneroDestacados.value : '';
        const anioSeleccionado = filtroAnioDestacados ? filtroAnioDestacados.value : '';
        const ordenSeleccionado = filtroOrdenDestacados ? filtroOrdenDestacados.value : '';

        let juegosProcesados = todosLosJuegosDestacadosOriginales.filter(juegoNode => {
            if (juegoNode.nodeType !== 1) return false; 
            const generoJuego = (juegoNode.dataset.genero || '').trim();
            const anioJuego = (juegoNode.dataset.anio || '').trim();
            const cumpleGenero = (generoSeleccionado === '' || generoSeleccionado === generoJuego);
            const cumpleAnio = (anioSeleccionado === '' || anioSeleccionado === anioJuego);
            return cumpleGenero && cumpleAnio;
        });

        switch (ordenSeleccionado) {
            case 'alfabetico_asc':
                juegosProcesados.sort((a, b) => (a.dataset.nombre || '').localeCompare(b.dataset.nombre || ''));
                break;
            case 'alfabetico_desc':
                juegosProcesados.sort((a, b) => (b.dataset.nombre || '').localeCompare(a.dataset.nombre || ''));
                break;
            case 'anio_asc':
                juegosProcesados.sort((a, b) => (parseInt(a.dataset.anio) || 0) - (parseInt(b.dataset.anio) || 0));
                break;
            case 'anio_desc':
                juegosProcesados.sort((a, b) => (parseInt(b.dataset.anio) || 0) - (parseInt(a.dataset.anio) || 0));
                break;
        }

        listaJuegosDestacadosContainer.innerHTML = ''; 
        if (juegosProcesados.length > 0) {
            juegosProcesados.forEach(juego => listaJuegosDestacadosContainer.appendChild(juego));
            if (noJuegosDestacadosFiltradosMensaje) noJuegosDestacadosFiltradosMensaje.style.display = 'none';
        } else {
            if (noJuegosDestacadosFiltradosMensaje) {
                 noJuegosDestacadosFiltradosMensaje.style.display = 'block';
            }
        }
    }

    if (todosLosJuegosDestacadosOriginales.length > 0) {
        if (filtroAnioDestacados) {
            poblarFiltroSelect(filtroAnioDestacados, 'anio', todosLosJuegosDestacadosOriginales, true);
            filtroAnioDestacados.addEventListener('change', filtrarOrdenarJuegosDestacados);
        }
        if (filtroGeneroDestacados) {
            poblarFiltroSelect(filtroGeneroDestacados, 'genero', todosLosJuegosDestacadosOriginales);
            filtroGeneroDestacados.addEventListener('change', filtrarOrdenarJuegosDestacados);
        }
        if (filtroOrdenDestacados) {
            filtroOrdenDestacados.addEventListener('change', filtrarOrdenarJuegosDestacados);
        }
        filtrarOrdenarJuegosDestacados(); 
    } else if (listaJuegosDestacadosContainer) {
        const mensajePHPPresente = listaJuegosDestacadosContainer.querySelector('p.text-white');
        if(!mensajePHPPresente && noJuegosDestacadosFiltradosMensaje && !noJuegosDestacadosFiltradosMensaje.textContent.includes("Error")){
             noJuegosDestacadosFiltradosMensaje.textContent = "No hay juegos destacados disponibles para filtrar.";
             noJuegosDestacadosFiltradosMensaje.style.display = 'block';
        } else if (mensajePHPPresente && noJuegosDestacadosFiltradosMensaje) {
            noJuegosDestacadosFiltradosMensaje.style.display = 'none';
        }
    }
});
</script>




<!-- Fin de Body -->
<?php include("includes/footer.php"); ?>
<!--La linea de arriba es el final de la estructura html5, basicamente donde se cierra el body y la etiqueta html-->