<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Azteca de Oro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/usuarios.css') }}?v={{ time() }}"> <!-- TU CSS COMPLETO -->
</head>
<body>

<div class="container">

    <!-- Header -->
    <div class="header">
        <div class="logo">
            <h1>Azteca de Oro</h1>
            <p>Sistema de Pasajeras</p>
        </div>
        <div class="user-info">
            <img src="https://ui-avatars.com/api/?name={{ session('user.nombre') }}+{{ session('user.apellido_p') }}&background=b21f1f&color=fff&bold=true" alt="Avatar">
            <div class="user-details">
                <div class="name">{{ session('user.nombre') }} {{ session('user.apellido_p') }}</div>
                <div class="role">{{ ucfirst(session('user.tipo_usuario')) }}</div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn" style="background:#e74c3c;color:white;">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </button>
            </form>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="main-content">
        <div class="page-title">
            <h2>Gestión de Usuarios</h2>
            <button class="btn btn-primary" id="addUserBtn">
                <i class="fas fa-plus"></i> Agregar Usuario
            </button>
        </div>

        <!-- Mensajes -->
        @if(session('success'))
            <div class="alert alert-success" style="padding:15px;margin:15px 0;border-radius:8px;background:#d4edda;color:#155724;">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger" style="padding:15px;margin:15px 0;border-radius:8px;background:#f8d7da;color:#721c24;">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Tabla -->
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
                <tbody>
                    @foreach($usuarios as $u)
                    <tr>
                        <td>{{ $u['username'] }}</td>
                        <td>{{ $u['nombre'] }} {{ $u['apellido_p'] }} {{ $u['apellido_m'] }}</td>
                        <td>{{ $u['email'] }}</td>
                        <td><span class="user-type">{{ ucfirst($u['tipo_usuario']) }}</span></td>
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

<!-- Modal -->
<div class="modal" id="userModal" style="display:none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Agregar Usuario</h3>
            <span class="close">×</span>
        </div>
        <form id="userForm" method="POST">
            @csrf
            <input type="hidden" name="id" id="userId">
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Apellido Paterno</label>
                        <input type="text" name="apellido_p" id="apellido_p" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Apellido Materno</label>
                        <input type="text" name="apellido_m" id="apellido_m" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Edad</label>
                        <input type="number" name="edad" id="edad" class="form-control" min="18">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Sexo</label>
                        <select name="sexo" id="sexo" class="form-control">
                            <option value="">Seleccionar</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipo de Usuario</label>
                        <select name="tipo_usuario" id="tipo_usuario" class="form-control" required>
                            <option value="administrador">Administrador</option>
                            <option value="checador">Checador</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Estado</label>
                        <select name="estado" id="estado" class="form-control" required>
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Contraseña <small>(dejar vacío para no cambiar)</small></label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
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

    // Agregar nuevo
    document.getElementById('addUserBtn').onclick = () => {
        document.getElementById('modalTitle').textContent = 'Agregar Usuario';
        form.reset();
        document.getElementById('userId').value = '';
        form.action = "{{ route('usuarios.store') }}";
        form.querySelectorAll('[name="_method"]').forEach(el => el.remove());
        modal.style.display = "flex";
    };

    // Editar
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
            if (!form.querySelector('[name="_method"]')) {
                form.insertAdjacentHTML('afterbegin', '<input type="hidden" name="_method" value="PUT">');
            }

            modal.style.display = "flex";
        };
    });

    // Cerrar modal
    document.querySelectorAll('.close').forEach(el => el.onclick = () => modal.style.display = "none");
    window.onclick = e => { if (e.target === modal) modal.style.display = "none"; };
</script>

</body>
</html>