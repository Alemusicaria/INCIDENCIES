<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css' rel='stylesheet' />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <style>
        .btn-professional {
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-professional:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
        }

        .btn-warning-custom {
            background-color: #f0ad4e;
            border: none;
        }

        .btn-secondary-custom {
            background-color: #6c757d;
            border: none;
        }

        .btn-danger-custom {
            background-color: #d9534f;
            border: none;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Menú lateral -->
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Nom usuari</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Perfil</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-home"></i>
                        <span>Inici</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Les meves incidències</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Gestionar professor</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Sortir</span>
                </a>
            </div>
        </aside>

        <!-- Contingut principal del perfil -->
        <div class="main p-3">
            <h2 class="text-center">Perfil de l'Usuari</h2>
            <div class="card p-4">
                <!-- Dades de l'usuari -->
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom i Cognoms:</label>
                    <p id="nom"><strong>Joan Pérez</strong></p>
                </div>
                <div class="mb-3">
                    <label for="correu" class="form-label">Correu Electrònic:</label>
                    <p id="correu">joan.perez@example.com</p>
                </div>
                <div class="mb-3">
                    <label for="incidencies" class="form-label">Nombre d'Incidències Creades:</label>
                    <p id="incidencies">12</p>
                </div>

                <!-- Botons per a accions del perfil -->
                <div class="d-grid gap-2 mt-4">
                    <a href="restaurar_correu.html" class="btn btn-warning-custom btn-professional">Restaurar Correu</a>
                    <a href="restaurar_contrasenya.html" class="btn btn-secondary-custom btn-professional">Restaurar Contrasenya</a>
                    <a href="deshabilitar_compte.html" class="btn btn-danger-custom btn-professional">Deshabilitar Compte</a>
                </div>

            </div>

            <!-- Botó per tornar a l'inici -->
            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-primary btn-professional">Torna a l'inici</a>
            </div>
        </div>
    </div>
    <script src="script_default.js"></script>
    <script>
        function restaurarCorreu() {
            alert("Funció de restauració de correu.");
        }

        function restaurarContrasenya() {
            alert("Funció de restauració de contrasenya.");
        }

        function deshabilitarCompte() {
            if (confirm("Estàs segur que vols deshabilitar el compte?")) {
                alert("El compte s'ha deshabilitat.");
            }
        }
    </script>
</body>

</html>