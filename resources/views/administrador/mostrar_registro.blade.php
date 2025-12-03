<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros - Pasajeras Azteca de Oro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* === TU CSS ORIGINAL COMPLETO (lo dejo igual, solo quito el duplicado) === */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d); background-size: 400% 400%; animation: gradient 15s ease infinite; min-height: 100vh; padding: 20px; color: #333; }
        @keyframes gradient { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        .container { max-width: 1400px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; background: rgba(255,255,255,0.95); padding: 20px 30px; border-radius: 15px 15px 0 0; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .logo h1 { color: #b21f1f; font-size: 28px; font-weight: 700; }
        .logo p { color: #555; font-size: 14px; }
        .user-info { display: flex; align-items: center; gap: 15px; }
        .user-info img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #b21f1f; }
        .user-details .name { font-weight: 600; color: #b21f1f; }
        .user-details .role { font-size: 12px; color: #777; }
        .main-content { background: rgba(255,255,255,0.95); border-radius: 0 0 15px 15px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .page-title { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #eee; }
        .page-title h2 { color: #1a2a6c; font-size: 24px; }
        .btn { padding: 12px 25px; border: none; border-radius: 50px; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; gap: 8px; }
        .btn-primary { background: linear-gradient(135deg, #b21f1f, #fdbb2d); color: white; box-shadow: 0 5px 15px rgba(178,31,31,0.3); }
        .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(178,31,31,0.4); }
        .btn-secondary { background: #f0f0f0; color: #555; }
        .btn-secondary:hover { background: #e0e0e0; }
        .btn-sm { padding: 8px 15px; font-size: 13px; }
        .tabs-container { margin-bottom: 25px; border-bottom: 1px solid #eee; }
        .tabs { display: flex; gap: 10px; overflow-x: auto; }
        .tab { padding: 12px 25px; background: #f5f5f5; border: none; border-radius: 8px 8px 0 0; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: flex; align-items: center; gap: 8px; white-space: nowrap; }
        .tab:hover { background: #e9e9e9; }
        .tab.active { background: #1a2a6c; color: white; }
        .filters-container { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px; }
        .search-box { flex: 1; min-width: 300px; position: relative; }
        .search-box input { width: 100%; padding: 12px 15px 12px 40px; border: 1px solid #ddd; border-radius: 8px; font-size: 15px; }
        .search-box i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #777; }
        .stats-summary { display: flex; gap: 20px; margin-bottom: 20px; }
        .stat-card { flex: 1; background: white; border-radius: 10px; padding: 20px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); display: flex; align-items: center; gap: 15px; }
        .stat-icon { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px; color: white; }
        .stat-icon.drivers { background: linear-gradient(135deg, #3498db, #2980b9); }
        .stat-icon.units { background: linear-gradient(135deg, #2ecc71, #27ae60); }
        .stat-info h3 { font-size: 28px; color: #2c3e50; margin-bottom: 5px; }
        .stat-info p { color: #7f8c8d; font-size: 14px; }
        .table-container { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-top: 20px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 800px; }
        thead { background: linear-gradient(135deg, #1a2a6c, #2c3e8c); color: white; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #eee; }
        tbody tr:hover { background: #f9f9f9; }
        .status { display: inline-block; padding: 5px 12px; border-radius: 50px; font-size: 12px; font-weight: 600; }
        .status-active { background: #e8f7ef; color: #27ae60; }
        .status-inactive { background: #ffeaea; color: #e74c3c; }
        .status-maintenance { background: #fff3e6; color: #f39c12; }
        .pagination { display: flex; justify-content: center; gap: 10px; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee; }
        .pagination button { padding: 8px 12px; border: 1px solid #ddd; background: white; border-radius: 5px; cursor: pointer; }
        .pagination button:hover { background: #f5f5f5; }
        .pagination button.active { background: #1a2a6c; color: white; border-color: #1a2a6c; }
        .no-data { text-align: center; padding: 50px; color: #7f8c8d; }
        .no-data i { font-size: 50px; margin-bottom: 15px; color: #bdc3c7; }
        @media (max-width: 768px) {
            .header { flex-direction: column; text-align: center; }
            .filters-container { flex-direction: column; }
            .search-box { min-width: 100%; }
            .stats-summary { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <h1>Azteca de Oro</h1>
                <p>Sistema de Registros - Pasajeras y Choferes</p>
            </div>
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name={{ session('user.nombre') }}+{{ session('user.apellido_p') }}&background=b21f1f&color=fff&bold=true" alt="Usuario">
                <div class="user-details">
                    <div class="name">{{ session('user.nombre') }} {{ session('user.apellido_p') }}</div>
                    <div class="role">Administrador</div>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="page-title">
                <h2>Registros del Sistema</h2>
                <a href="{{ route('usuarios.index') }}" class="btn btn-primary">
                    <i class="fas fa-users-cog"></i> Gestionar Usuarios
                </a>
            </div>

            <div class="tabs-container">
                <div class="tabs">
                    <button class="tab active" id="driversTab"><i class="fas fa-user-tie"></i> Choferes Registrados</button>
                    <button class="tab" id="unitsTab"><i class="fas fa-bus"></i> Pasajeras Registradas</button>
                </div>
            </div>

            <div class="stats-summary">
                <div class="stat-card">
                    <div class="stat-icon drivers"><i class="fas fa-user-tie"></i></div>
                    <div class="stat-info">
                        <h3 id="driversCount">{{ count($choferes) }}</h3>
                        <p>Choferes Registrados</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon units"><i class="fas fa-bus"></i></div>
                    <div class="stat-info">
                        <h3 id="unitsCount">{{ count($unidades) }}</h3>
                        <p>Pasajeras Registradas</p>
                    </div>
                </div>
            </div>

            <div class="filters-container">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Buscar en los registros...">
                </div>
            </div>

            <!-- Tabla Choferes -->
            <div class="table-container" id="driversTableContainer">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>CURP</th>
                            <th>Licencia</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Fecha Registro</th>
                        </tr>
                    </thead>
                    <tbody id="driversTableBody">
                        @foreach($choferes as $i => $c)
                        @php
                            $info = $c['informacion_personal'];
                            $contacto = $c['informacion_contacto'];
                            $licencia = $c['informacion_licencia'];
                            $laboral = $c['informacion_laboral'];
                        @endphp
                        <tr>
                            <td>{{ str_pad($i + 1, 3, '0', STR_PAD_LEFT) }}</td>
                            <td><strong>{{ $info['nombres'] }} {{ $info['apellidos'] }}</strong></td>
                            <td>{{ $info['curp'] }}</td>
                            <td>{{ $licencia['numero_licencia'] }}</td>
                            <td>{{ $contacto['telefono'] }}</td>
                            <td>
                                <span class="status {{ $laboral['estado'] == 'activo' ? 'status-active' : 'status-inactive' }}">
                                    {{ ucfirst($laboral['estado']) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($c['metadatos']['fecha_registro'])->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tabla Unidades -->
            <div class="table-container" id="unitsTableContainer" style="display: none;">
                <table>
                    <thead>
                        <tr>
                            <th>No. Unidad</th>
                            <th>Placas</th>
                            <th>Marca/Modelo</th>
                            <th>Capacidad</th>
                            <th>Chofer Asignado</th>
                            <th>Estado</th>
                            <th>Último Mantenimiento</th>
                        </tr>
                    </thead>
                    <tbody id="unitsTableBody">
                        @foreach($unidades as $i => $u)
                        @php
                            $general = $u['informacion_general'];
                            $tecnicas = $u['especificaciones_tecnicas'];
                            $estado = $u['estado_mantenimiento'];
                        @endphp
                        <tr>
                            <td><strong>{{ $general['numero_unidad'] }}</strong></td>
                            <td>{{ $general['placas'] }}</td>
                            <td>{{ $general['marca'] }} {{ $general['modelo'] }}</td>
                            <td>{{ $tecnicas['capacidad_pasajeros'] }} pasajeros</td>
                            <td>{{ $estado['chofer_asignado_nombre'] ?? 'Sin asignar' }}</td>
                            <td>
                                <span class="status {{ $estado['estado_unidad'] == 'activa' ? 'status-active' : 'status-inactive' }}">
                                    {{ ucfirst($estado['estado_unidad']) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($estado['ultimo_mantenimiento'])->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const driversTab = document.getElementById('driversTab');
        const unitsTab = document.getElementById('unitsTab');
        const driversContainer = document.getElementById('driversTableContainer');
        const unitsContainer = document.getElementById('unitsTableContainer');
        const searchInput = document.getElementById('searchInput');

        driversTab.onclick = () => {
            driversTab.classList.add('active');
            unitsTab.classList.remove('active');
            driversContainer.style.display = 'block';
            unitsContainer.style.display = 'none';
        };

        unitsTab.onclick = () => {
            unitsTab.classList.add('active');
            driversTab.classList.remove('active');
            unitsContainer.style.display = 'block';
            driversContainer.style.display = 'none';
        };

        // Búsqueda simple
        searchInput.oninput = function() {
            const term = this.value.toLowerCase();
            document.querySelectorAll('#driversTableBody tr, #unitsTableBody tr').forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(term) ? '' : 'none';
            });
        };
    </script>
</body>
</html>