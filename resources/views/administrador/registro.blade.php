<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Pasajeras Azteca de Oro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/registro.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <h1>Azteca de Oro</h1>
                <p>Sistema de Registro de Unidades y Choferes</p>
            </div>
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=Admin+User&background=b21f1f&color=fff" alt="Usuario">
                <div class="user-details">
                    <div class="name">Administrador</div>
                    <div class="role">Registro</div>
                </div>
            </div>
        </div>
        
        <div class="main-content">
            <div class="page-title">
                <h2>Registro de Elementos</h2>
                <button class="btn btn-secondary" id="backToSelection">
                    <i class="fas fa-arrow-left"></i> Volver a Selección
                </button>
            </div>
            
            <div class="selection-cards" id="selectionCards">
                <div class="card active" id="driverCard">
                    <div class="card-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3>Registrar Chofer</h3>
                    <p>Registra nueva información de choferes con datos personales, licencias y detalles de contacto.</p>
                </div>
                
                <div class="card" id="unitCard">
                    <div class="card-icon">
                        <i class="fas fa-bus"></i>
                    </div>
                    <h3>Registrar Unidad</h3>
                    <p>Registra nuevas unidades (pasajeras) con información técnica, características y asignaciones.</p>
                </div>
            </div>
            
            <!-- Formulario para Choferes -->
            <div class="form-container active" id="driverForm">
                <h3 class="form-title"><i class="fas fa-user-tie"></i> Registro de Chofer</h3>
                
                <div class="form-note">
                    <i class="fas fa-info-circle"></i> Complete todos los campos obligatorios para registrar un nuevo chofer en el sistema.
                </div>
                
                <form id="driverFormData">
                    <div class="form-section">
                        <h4><i class="fas fa-id-card"></i> Información Personal</h4>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="driverFirstName">Nombres *</label>
                                <input type="text" id="driverFirstName" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="driverLastName">Apellidos *</label>
                                <input type="text" id="driverLastName" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="driverCURP">CURP *</label>
                                <input type="text" id="driverCURP" class="form-control" required maxlength="18">
                            </div>
                            <div class="form-group">
                                <label for="driverRFC">RFC</label>
                                <input type="text" id="driverRFC" class="form-control" maxlength="13">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="driverBirthDate">Fecha de Nacimiento *</label>
                                <input type="date" id="driverBirthDate" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="driverGender">Sexo *</label>
                                <select id="driverGender" class="form-control" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h4><i class="fas fa-address-card"></i> Información de Contacto</h4>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="driverPhone">Teléfono *</label>
                                <input type="tel" id="driverPhone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="driverEmail">Correo Electrónico</label>
                                <input type="email" id="driverEmail" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="driverAddress">Dirección *</label>
                                <input type="text" id="driverAddress" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h4><i class="fas fa-id-card-alt"></i> Información de Licencia</h4>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="driverLicenseNumber">Número de Licencia *</label>
                                <input type="text" id="driverLicenseNumber" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="driverLicenseType">Tipo de Licencia *</label>
                                <select id="driverLicenseType" class="form-control" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="A">Tipo A</option>
                                    <option value="B">Tipo B</option>
                                    <option value="C">Tipo C</option>
                                    <option value="D">Tipo D</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="driverLicenseExpiry">Vencimiento de Licencia *</label>
                                <input type="date" id="driverLicenseExpiry" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="driverExperience">Años de Experiencia *</label>
                                <input type="number" id="driverExperience" class="form-control" min="0" max="50" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h4><i class="fas fa-briefcase"></i> Información Laboral</h4>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="driverHireDate">Fecha de Contratación *</label>
                                <input type="date" id="driverHireDate" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="driverStatus">Estado *</label>
                                <select id="driverStatus" class="form-control" required>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                    <option value="vacaciones">Vacaciones</option>
                                    <option value="suspendido">Suspendido</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="driverEmergencyContact">Contacto de Emergencia *</label>
                                <input type="text" id="driverEmergencyContact" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="driverEmergencyPhone">Teléfono de Emergencia *</label>
                                <input type="tel" id="driverEmergencyPhone" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" id="cancelDriverBtn">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar Chofer</button>
                    </div>
                </form>
            </div>
            
            <!-- Formulario para Unidades -->
            <div class="form-container" id="unitForm">
                <h3 class="form-title"><i class="fas fa-bus"></i> Registro de Unidad (Pasajera)</h3>
                
                <div class="form-note">
                    <i class="fas fa-info-circle"></i> Complete todos los campos obligatorios para registrar una nueva unidad en el sistema.
                </div>
                
                <form id="unitFormData">
                    <div class="form-section">
                        <h4><i class="fas fa-barcode"></i> Información General</h4>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="unitNumber">Número de Unidad *</label>
                                <input type="text" id="unitNumber" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="unitPlate">Placas *</label>
                                <input type="text" id="unitPlate" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="unitBrand">Marca *</label>
                                <input type="text" id="unitBrand" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="unitModel">Modelo *</label>
                                <input type="text" id="unitModel" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="unitYear">Año *</label>
                                <input type="number" id="unitYear" class="form-control" min="2000" max="2030" required>
                            </div>
                            <div class="form-group">
                                <label for="unitColor">Color *</label>
                                <input type="text" id="unitColor" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h4><i class="fas fa-cogs"></i> Especificaciones Técnicas</h4>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="unitCapacity">Capacidad de Pasajeros *</label>
                                <input type="number" id="unitCapacity" class="form-control" min="1" max="100" required>
                            </div>
                            <div class="form-group">
                                <label for="unitFuelType">Tipo de Combustible *</label>
                                <select id="unitFuelType" class="form-control" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="gasolina">Gasolina</option>
                                    <option value="diesel">Diésel</option>
                                    <option value="electrico">Eléctrico</option>
                                    <option value="hibrido">Híbrido</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="unitEngine">Número de Motor *</label>
                                <input type="text" id="unitEngine" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="unitChassis">Número de Chasis *</label>
                                <input type="text" id="unitChassis" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="unitMileage">Kilometraje Actual *</label>
                                <input type="number" id="unitMileage" class="form-control" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="unitInsurance">Compañía de Seguro *</label>
                                <input type="text" id="unitInsurance" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h4><i class="fas fa-clipboard-check"></i> Estado y Mantenimiento</h4>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="unitStatus">Estado de la Unidad *</label>
                                <select id="unitStatus" class="form-control" required>
                                    <option value="activa">Activa</option>
                                    <option value="mantenimiento">En Mantenimiento</option>
                                    <option value="reparacion">En Reparación</option>
                                    <option value="inactiva">Inactiva</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="unitLastMaintenance">Último Mantenimiento *</label>
                                <input type="date" id="unitLastMaintenance" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="unitNextMaintenance">Próximo Mantenimiento *</label>
                                <input type="date" id="unitNextMaintenance" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="unitAssignedDriver">Chofer Asignado</label>
                                <select id="unitAssignedDriver" class="form-control">
                                    <option value="">Sin asignar</option>
                                    <option value="1">Juan Pérez Rodríguez</option>
                                    <option value="2">María García López</option>
                                    <option value="3">Carlos Hernández Silva</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-section">
                        <h4><i class="fas fa-file-alt"></i> Documentación</h4>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="unitRegistration">Número de Registro *</label>
                                <input type="text" id="unitRegistration" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="unitCirculation">Tarjeta de Circulación *</label>
                                <input type="text" id="unitCirculation" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="unitPolicy">Póliza de Seguro *</label>
                                <input type="text" id="unitPolicy" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="unitPolicyExpiry">Vencimiento de Póliza *</label>
                                <input type="date" id="unitPolicyExpiry" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" id="cancelUnitBtn">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar Unidad</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Elementos del DOM
        const driverCard = document.getElementById('driverCard');
        const unitCard = document.getElementById('unitCard');
        const driverForm = document.getElementById('driverForm');
        const unitForm = document.getElementById('unitForm');
        const driverFormData = document.getElementById('driverFormData');
        const unitFormData = document.getElementById('unitFormData');
        const backToSelection = document.getElementById('backToSelection');
        const cancelDriverBtn = document.getElementById('cancelDriverBtn');
        const cancelUnitBtn = document.getElementById('cancelUnitBtn');
        const selectionCards = document.getElementById('selectionCards');

        // Función para mostrar formulario de choferes
        function showDriverForm() {
            driverCard.classList.add('active');
            unitCard.classList.remove('active');
            driverForm.classList.add('active');
            unitForm.classList.remove('active');
            selectionCards.style.display = 'grid';
        }

        // Función para mostrar formulario de unidades
        function showUnitForm() {
            unitCard.classList.add('active');
            driverCard.classList.remove('active');
            unitForm.classList.add('active');
            driverForm.classList.remove('active');
            selectionCards.style.display = 'grid';
        }

        // Función para ocultar selección y mostrar formulario completo
        function showFullForm() {
            selectionCards.style.display = 'none';
        }

        // Event Listeners para las tarjetas de selección
        driverCard.addEventListener('click', function() {
            showDriverForm();
            showFullForm();
        });

        unitCard.addEventListener('click', function() {
            showUnitForm();
            showFullForm();
        });

        // Event Listeners para los botones de volver
        backToSelection.addEventListener('click', function() {
            selectionCards.style.display = 'grid';
        });

        cancelDriverBtn.addEventListener('click', function() {
            selectionCards.style.display = 'grid';
        });

        cancelUnitBtn.addEventListener('click', function() {
            selectionCards.style.display = 'grid';
        });

        // Event Listeners para los formularios
        driverFormData.addEventListener('submit', function(e) {
            e.preventDefault();
            // Aquí irá la lógica para guardar en MySQL mediante Laravel en el futuro
            alert('En el futuro, aquí se guardará el chofer en la base de datos MySQL');
            driverFormData.reset();
            selectionCards.style.display = 'grid';
        });

        unitFormData.addEventListener('submit', function(e) {
            e.preventDefault();
            // Aquí irá la lógica para guardar en MySQL mediante Laravel en el futuro
            alert('En el futuro, aquí se guardará la unidad en la base de datos MySQL');
            unitFormData.reset();
            selectionCards.style.display = 'grid';
        });

        // Inicializar mostrando el formulario de choferes por defecto
        showDriverForm();
    </script>
</body>
</html>