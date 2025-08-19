<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignación de Equipos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <style>
        .panel-columna {
            min-height: 400px;
            background: #f8f9fa;
            border: 2px solid #000;
            border-radius: 30px;
            padding: 15px;
            overflow-y: auto;
        }

        .item {
            padding: 10px;
            margin-bottom: 10px;
            background-color: #e2e6ea;
            border: 1px solid #ced4da;
            border-radius: 5px;
            cursor: grab;
        }

        .side-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            margin-left: 20px;
        }

        .circle-button, .oval-button {
            border: 2px solid #000;
            text-align: center;
            font-size: 24px;
            cursor: pointer;
        }

        .circle-button {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            line-height: 75px;
        }

        .oval-button {
            width: 50px;
            height: 30px;
            border-radius: 50%;
            line-height: 28px;
        }

        .btn-registrar {
            margin-top: 30px;
        }

        .titulo {
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container-fluid mt-4">
    <div class="row">

        <!-- Columna 1: Lista de Usuarios -->
        <div class="col-md-2">
            <div class="panel-columna" id="usuarios">
                <div class="titulo">LISTA USUARIO</div>
                <?php foreach ($lista_usuario as $user): ?>
                    <div class="item" data-user-id="<?php echo $user->id ?>"><?php echo $user->usuario ?></div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Columna 2: PCs y laptops -->
        <div class="col-md-2">
            <div class="panel-columna" id="pcs">
                <div class="titulo">lista pc y laptops</div>
                <?php foreach ($lista_activopc as $pc): ?>
                    <div class="item" data-id="<?php echo $pc->id ?>" data-type="pc"><?php echo $pc->nom_equipo ?></div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Columna 3: Accesorios -->
        <div class="col-md-2">
            <div class="panel-columna" id="accesorios">
                <div class="titulo">lista accesorios</div>
                <?php foreach ($lista_accesorio as $acc): ?>
                    <div class="item" data-id="<?php echo $acc->id ?>" data-type="accesorio"><<?php echo $acc->nom_acc ?></div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Columna 4: Asignación -->
        <div class="col-md-3">
            <div class="panel-columna" id="asignacion" data-user-id="">
                <div class="titulo">lista asignacion</div>
                <!-- Aquí se arrastrarán items -->
            </div>
        </div>

        <!-- Botones laterales -->
        <div class="col-md-3">
            <div class="side-buttons">
                <div class="circle-button" onclick="alert('Agregar usuario')">+</div>
                <div class="oval-button" onclick="document.getElementById('asignacion').innerHTML=''">–</div>

                <button class="btn btn-dark btn-registrar" onclick="registrarAsignacion()">Registrar</button>
            </div>
        </div>
    </div>
</div>

<script>
// Drag entre PCs, accesorios y asignación
new Sortable(document.getElementById('pcs'), { group: 'shared', animation: 150 });
new Sortable(document.getElementById('accesorios'), { group: 'shared', animation: 150 });
new Sortable(document.getElementById('asignacion'), { group: 'shared', animation: 150 });

// Selección de usuario (solo uno)
document.querySelectorAll('#usuarios .item').forEach(item => {
    item.addEventListener('click', () => {
        // desmarcar otros
        document.querySelectorAll('#usuarios .item').forEach(i => i.classList.remove('bg-primary', 'text-white'));
        item.classList.add('bg-primary', 'text-white');

        // set al contenedor de asignación
        document.getElementById('asignacion').dataset.userId = item.dataset.userId;
    });
});

// Función para registrar
function registrarAsignacion() {
    const userId = document.getElementById('asignacion').dataset.userId;
    const items = Array.from(document.querySelectorAll('#asignacion .item')).map(i => ({
        id: i.dataset.id,
        tipo: i.dataset.type
    }));

    if (!userId || items.length === 0) {
        alert("Selecciona un usuario y al menos un item.");
        return;
    }

    fetch('/app/controllers/ItemController.php?action=registrarAsignacion', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ user_id: userId, items: items })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert('Asignación registrada correctamente');
            location.reload();
        } else {
            alert('Error al registrar');
        }
    });
}
</script>
</body>
</html>
