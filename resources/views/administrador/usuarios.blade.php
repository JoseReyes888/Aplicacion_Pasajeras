<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Usuarios - Pasajeras Azteca de Oro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<link href="{{ asset('css/usuarios.css') }}" rel="stylesheet">


</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <h1>Azteca de Oro</h1>
                <p>Sistema de Control de Usuarios</p>
            </div>
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=b21f1f&color=fff" alt="Usuario">
                <div class="user-details">
                    <div class="name">Administrador</div>
                    <div class="role">Supervisor</div>
                </div>
            </div>
        </div>
        
        <div class="main-content">
            <div class="page-title">
                <h2>Gestión de Usuarios</h2>
                <button class="btn btn-primary" id="addUserBtn">
                    <i class="fas fa-plus"></i> Agregar Usuario
                </button>
            </div>
            
            <div class="search-container">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Buscar usuarios...">
                </div>
                <button class="btn btn-secondary">
                    <i class="fas fa-filter"></i> Filtrar
                </button>
            </div>
            
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre de Usuario</th>
                            <th>Nombre Completo</th>
                            <th>Tipo de Usuario</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="usersTableBody">
                        <!-- Los datos de usuarios se cargarán aquí -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Modal para agregar/editar usuario -->
    <div class="modal" id="userModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Agregar Usuario</h3>
                <button class="close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="username">Nombre de Usuario</label>
                            <input type="text" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="userType">Tipo de Usuario</label>
                            <select id="userType" class="form-control" required>
                                <option value="">Seleccionar...</option>
                                <option value="admin">Administrador</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="operador">Operador</option>
                                <option value="usuario">Usuario Estándar</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="firstName">Nombre(s)</label>
                            <input type="text" id="firstName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Apellidos</label>
                            <input type="text" id="lastName" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirmar Contraseña</label>
                            <input type="password" id="confirmPassword" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="gender">Sexo</label>
                            <select id="gender" class="form-control" required>
                                <option value="">Seleccionar...</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="age">Edad</label>
                            <input type="number" id="age" class="form-control" min="18" max="100" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select id="status" class="form-control" required>
                            <option value="active">Activo</option>
                            <option value="inactive">Inactivo</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" id="cancelBtn">Cancelar</button>
                <button class="btn btn-primary" id="saveUserBtn">Guardar Usuario</button>
            </div>
        </div>
    </div>

    <script>
        // Datos de ejemplo para mostrar en la tabla
        const sampleUsers = [
            {
                id: 1,
                username: "mperez",
                firstName: "María",
                lastName: "Pérez García",
                userType: "admin",
                status: "active",
                gender: "femenino",
                age: 32
            },
            {
                id: 2,
                username: "jrodriguez",
                firstName: "Juan",
                lastName: "Rodríguez López",
                userType: "supervisor",
                status: "active",
                gender: "masculino",
                age: 28
            },
            {
                id: 3,
                username: "agomez",
                firstName: "Ana",
                lastName: "Gómez Martínez",
                userType: "operador",
                status: "inactive",
                gender: "femenino",
                age: 25
            },
            {
                id: 4,
                username: "chernandez",
                firstName: "Carlos",
                lastName: "Hernández Silva",
                userType: "usuario",
                status: "active",
                gender: "masculino",
                age: 35
            }
        ];

        // Elementos del DOM
        const usersTableBody = document.getElementById('usersTableBody');
        const userModal = document.getElementById('userModal');
        const modalTitle = document.getElementById('modalTitle');
        const userForm = document.getElementById('userForm');
        const addUserBtn = document.getElementById('addUserBtn');
        const closeModalBtn = document.querySelector('.close');
        const cancelBtn = document.getElementById('cancelBtn');
        const saveUserBtn = document.getElementById('saveUserBtn');
        const searchInput = document.getElementById('searchInput');

        // Cargar usuarios en la tabla
        function loadUsers(users = sampleUsers) {
            usersTableBody.innerHTML = '';
            
            users.forEach(user => {
                const row = document.createElement('tr');
                
                // Determinar clase de estado
                const statusClass = user.status === 'active' ? 'status-active' : 'status-inactive';
                const statusText = user.status === 'active' ? 'Activo' : 'Inactivo';
                
                // Determinar texto del tipo de usuario
                let userTypeText = '';
                switch(user.userType) {
                    case 'admin':
                        userTypeText = 'Administrador';
                        break;
                    case 'supervisor':
                        userTypeText = 'Supervisor';
                        break;
                    case 'operador':
                        userTypeText = 'Operador';
                        break;
                    case 'usuario':
                        userTypeText = 'Usuario Estándar';
                        break;
                }
                
                row.innerHTML = `
                    <td>${user.username}</td>
                    <td>${user.firstName} ${user.lastName}</td>
                    <td><span class="user-type">${userTypeText}</span></td>
                    <td><span class="status ${statusClass}">${statusText}</span></td>
                    <td>
                        <div class="actions">
                            <button class="btn btn-secondary btn-sm edit-user" data-id="${user.id}">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                        </div>
                    </td>
                `;
                
                usersTableBody.appendChild(row);
            });
            
            // Agregar event listeners a los botones de editar
            document.querySelectorAll('.edit-user').forEach(button => {
                button.addEventListener('click', function() {
                    const userId = parseInt(this.getAttribute('data-id'));
                    editUser(userId);
                });
            });
        }

        // Función para agregar un nuevo usuario
        function addUser() {
            modalTitle.textContent = 'Agregar Usuario';
            userForm.reset();
            userModal.style.display = 'flex';
        }

        // Función para editar un usuario existente
        function editUser(userId) {
            const user = sampleUsers.find(u => u.id === userId);
            if (!user) return;
            
            modalTitle.textContent = 'Editar Usuario';
            
            // Llenar el formulario con los datos del usuario
            document.getElementById('username').value = user.username;
            document.getElementById('userType').value = user.userType;
            document.getElementById('firstName').value = user.firstName;
            document.getElementById('lastName').value = user.lastName;
            document.getElementById('gender').value = user.gender;
            document.getElementById('age').value = user.age;
            document.getElementById('status').value = user.status;
            
            // Quitar el requerido de los campos de contraseña en edición
            document.getElementById('password').required = false;
            document.getElementById('confirmPassword').required = false;
            
            userModal.style.display = 'flex';
        }

        // Función para guardar usuario (agregar o editar)
        function saveUser() {
            // Aquí irá la lógica para guardar en MySQL mediante Laravel en el futuro
            alert('En el futuro, aquí se guardará el usuario en la base de datos MySQL');
            userModal.style.display = 'none';
        }

        // Función para buscar usuarios
        function searchUsers() {
            const searchTerm = searchInput.value.toLowerCase();
            const filteredUsers = sampleUsers.filter(user => 
                user.username.toLowerCase().includes(searchTerm) ||
                user.firstName.toLowerCase().includes(searchTerm) ||
                user.lastName.toLowerCase().includes(searchTerm)
            );
            loadUsers(filteredUsers);
        }

        // Event Listeners
        addUserBtn.addEventListener('click', addUser);
        closeModalBtn.addEventListener('click', () => userModal.style.display = 'none');
        cancelBtn.addEventListener('click', () => userModal.style.display = 'none');
        saveUserBtn.addEventListener('click', saveUser);
        searchInput.addEventListener('input', searchUsers);

        // Cerrar modal al hacer clic fuera de él
        window.addEventListener('click', (event) => {
            if (event.target === userModal) {
                userModal.style.display = 'none';
            }
        });

        // Cargar usuarios al iniciar
        loadUsers();
    </script>
</body>
</html>