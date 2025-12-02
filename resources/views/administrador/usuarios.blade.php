<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Azteca de Oro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/usuarios.css') }}" rel="stylesheet"> <!-- Tu CSS actual -->
    <style>
        .alert { padding: 12px; margin: 15px 0; border-radius: 8px; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-danger { background: #f8d7da; color: #721c24; }
        .logout-btn { background: #dc3545; }
        .logout-btn:hover { background: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header con usuario logueado -->
        <div class="header">
            <div class="logo">
                <h1>Azteca de Oro</h1>
                <p>Sistema de Pasajeras</p>
            </div>
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name={{ session('user.nombre') }}+{{ session('user.apellido_p') }}&background=b21f1f&color=fff" alt="Usuario">
                <div class="user-details">
                    <div class="name">{{ session('user.nombre') }} {{ session('user.apellido_p') }}</div>
                    <div class="role">{{ session('user.tipo_usuario') == 'administrador' ? 'Administrador' : 'Checador' }}</div>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn logout-btn" style="margin-left:15px;">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>

        <div class="main-content">
            <div class="page-title">
                <h2>Gestión de Usuarios</h2>
                <button class="btn btn-primary" id="addUserBtn">
                    <i class="fas fa-plus"></i> Agregar Usuario
                </button>
            </div>

            <!-- Mensajes -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <!-- Tabla de usuarios -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        @foreach($usuarios as $u)
                        <tr>
                            <td>{{ $u['username'] }}</td>
                            <td>{{ $u['nombre'] }} {{ $u['apellido_p'] }} {{ $u['apellido_m'] }}</td>
                            <td>{{ $u['email'] }}</td>
                            <td>
                                <span class="user-type">
                                    {{ $u['tipo_usuario'] == 'administrador' ? 'Administrador' : 'Checador' }}
                                </span>
                            </td>
                            <td>
                                <span class="status {{ $u['estado'] == 'activo' ? 'status-active' : 'status-inactive' }}">
                                    {{ ucfirst($u['estado']) }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-secondary btn-sm edit-user" data-id="{{ $u['id'] }}">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar / Editar -->
    <div class="modal" id="userModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Agregar Usuario</h3>
                <span class="close">×</span>
            </div>
            <form id="userForm" method="POST">
                @csrf
                <input type="hidden" name="id" id="userId">

                <div class="form-row">
                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" required>
                    </div>
                    <div class="form-group">
                        <label>Apellido Paterno</label>
                        <input type="text" name="apellido_p" id="apellido_p" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Apellido Materno</label>
                        <input type="text" name="apellido_m" id="apellido_m">
                    </div>
                    <div class="form-group">
                        <label>Edad</label>
                        <input type="number" name="edad" id="edad" min="18" max="100">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Sexo</label>
                        <select name="sexo" id="sexo">
                            <option value="">Seleccionar</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipo de Usuario</label>
                        <select name="tipo_usuario" id="tipo_usuario" required>
                            <option value="administrador">Administrador</option>
                            <option value="checador">Checador</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Estado</label>
                        <select name="estado" id="estado" required>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contraseña <small>(dejar vacío para no cambiar)</small></label>
                        <input type="password" name="password" id="password">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('userModal');
        const form = document.getElementById('userForm');

        // Abrir modal para crear
        document.getElementById('addUserBtn').onclick = () => {
            document.getElementById('modalTitle').textContent = 'Agregar Usuario';
            form.reset();
            document.getElementById('userId').value = '';
            form.action = "{{ route('usuarios.store') }}";
            form.method = "POST";
            modal.style.display = "flex";
        };

        // Abrir modal para editar
        document.querySelectorAll('.edit-user').forEach(btn => {
            btn.onclick = async function() {
                const id = this.dataset.id;
                const res = await fetch(`/usuarios/${id}/edit`);
                const user = await res.json();

                document.getElementById('modalTitle').textContent = 'Editar Usuario';
                document.getElementById('userId').value = user.id;
                document.getElementById('username').value = user.username;
                document.getElementById('email').value = user.email;
                document.getElementById('nombre').value = user.nombre;
                document.getElementById('apellido_p').value = user.apellido_p;
                document.getElementById('apellido_m').value = user.apellido_m || '';
                document.getElementById('edad').value = user.edad || '';
                document.getElementById('sexo').value = user.sexo || '';
                document.getElementById('tipo_usuario').value = user.tipo_usuario;
                document.getElementById('estado').value = user.estado;

                form.action = `/usuarios/${id}`;
                form.method = "POST";
                form.insertAdjacentHTML('afterbegin', '<input type="hidden" name="_method" value="PUT">');

                modal.style.display = "flex";
            };
        });

        // Cerrar modal
        document.querySelectorAll('.close').forEach(el => {
            el.onclick = () => modal.style.display = "none";
        });
        window.onclick = e => { if (e.target === modal) modal.style.display = "none"; };
    </script>
</body>
</html>