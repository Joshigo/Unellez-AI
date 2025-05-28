<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--  <meta property="og:image" content="https://my.emiassistant.com/favicon_emi.png">  --}}
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Unellez AI | @yield('title')</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('icon_blue.png') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href="{{ asset('sneat/assets/vendor/fonts/boxicons.css') }}" rel="stylesheet" />
    <link href="{{ asset('sneat/assets/vendor/css/core.css') }}" rel="stylesheet" />
    <link href="{{ asset('sneat/assets/vendor/css/theme-default.css') }}" rel="stylesheet" />
    <link href="{{ asset('sneat/assets/css/demo.css') }}" rel="stylesheet" />
    <link href="{{ asset('sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('sneat/assets/vendor/libs/apex-charts/apex-charts.css') }}" rel="stylesheet" />
    {{-- Scripts --}}
    <script src="{{ asset('sneat/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('sneat/assets/js/config.js') }}"></script>
    <style>
        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        #loader-image {
            width: 300px;
            height: 300px;
            animation: bounce 0.8s infinite alternate;
        }

        @keyframes bounce {
            from {
                transform: translateY(-15px);
            }

            to {
                transform: translateY(15px);
            }
        }

        .modal-content-1 {
            border-radius: var(--bs-modal-border-radius) var(--bs-modal-border-radius) 0% 0% !important;
        }

        .modal-content-2 {
            border-radius: 0% !important;

        }

        .modal-content-3 {
            border-radius: 0% 0% var(--bs-modal-border-radius) var(--bs-modal-border-radius) !important;
        }

        .modal-content {
            box-shadow: 0 2px 8px 0 rgba(67, 89, 113, 0.3) !important;
        }

        .modal-header {
            padding: 8px 24px 8px 42px !important;
        }

        .modal-body {
            padding: 8px 24px !important;
        }

        .modal-footer {
            padding: 8px 24px !important;
        }

        .accordion .accordion-item.active {
            box-shadow: 0 0rem 0rem rgb(255, 255, 255) !important;
        }


        .modal-config {
            align-content: center;
        }

        .info-icon {
            position: fixed;
            right: 32px;
            cursor: pointer;
            background-color: #696cff;
            color: white;
            border: none;
            border-radius: 50%;
            font-size: 1rem;
            width: 36px;
            height: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            /* Centra el ícono horizontalmente */
            transition: background-color 0.2s ease;
        }

        .info-icon:hover {
            background-color: #0056b3;
        }

        .info-content {
            display: none;
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 10;
        }

        .info-content p {
            margin-bottom: 0.5rem;
            color: #333;
            font-size: 0.9rem;
        }

        .info-close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: transparent;
            border: none;
            font-size: 1.5rem;
            color: #333;
            cursor: pointer;
            transition: color 0.2s;
        }

        .info-close-btn:hover {
            color: #007bff;
            /* Cambia el color al pasar el cursor */
        }

        .text-success {
            color: #28a745;
            font-size: 1.2em;
        }

        .text-danger {
            color: #dc3545;
            font-size: 1.2em;
        }

       #notifications-container {
      padding: 10px;
      max-width: 400px;
      margin: 20px auto;
  }

  /* Estilo para cada notificación */
  .notification {
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 4px;
      margin-bottom: 10px;
      padding: 12px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s ease;
  }

  .notification:hover {
      background-color: #f1f1f1;
  }

  /* Estilo para el mensaje dentro de la notificación */
  .notification p {
      margin: 0;
      font-size: 14px;
      color: #333;
  }

  /* Estilo para el botón */
  .notification button {
      background-color: #007bff;
      border: none;
      color: #fff;
      padding: 6px 12px;
      font-size: 12px;
      border-radius: 3px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-top: 8px;
  }

  .notification button:hover {
      background-color: #0056b3;
  }

    </style>
</head>

<body>
    <div id="page-loader">
        <img id="loader-image" src="{{ asset('bot-center_blue.png') }}" alt="Loading...">
    </div>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('layout.includes._side')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
            <div id="payment-alert" class="d-flex justify-content-center text-center"></div>
                @include('layout.includes._nav')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                @yield('content')
                <div class="content-wrapper">

                    <!-- Footer -->
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>

                @include('layout.includes.footer')
            </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('sneat/assets/js/menu.js') }}"></script>
        @stack('scripts')
        </div>
        <div class="modal fade modal-config" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">AI training options </h5>
                        <!-- Ícono con información oculta -->
                        {{-- <button onclick="showTrainingStatus(true)">test 1 modal</button>
                        <button onclick="showTrainingStatus(false)">test 2 modal</button> --}}
                        <button class="info-icon" onclick="toggleInfo()">?</button>
                        <div class="info-container">
                            <div class="info-content" id="info-content">
                                <button class="info-close-btn" onclick="toggleInfo()">×</button>
                                <p style="margin-top: 20px; font-size: 1.2em;">Need help training your AI? Choose an
                                    option below:</p>
                                <ul style="margin-top: 10px; padding-left: 20px;">
                                    <li><strong>PDF:</strong> Manuals, guides, or structured docs.</li>
                                    <li><strong>Text:</strong> Quick ideas or short messages.</li>
                                    <li><strong>URL:</strong> Web pages with relevant info.</li>
                                </ul>
                                <p style="margin-top: 10px;">Just select an option, complete the form, and let the AI
                                    handle the rest!</p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            style="margin-top: 0rem !important"></button>
                    </div>
                    <div class="modal-body">
                        <div class="accordion" id="accordionInsideModal">
                            <!-- Acordeón 1 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <!-- Formulario 1: PDF -->
                                        <h5 class="modal-title" id="backDropModalTitle">Insert a PDF for training</h5>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionInsideModal">
                                    <div class="accordion-body">
                                        {{--  <form action="{{ route('chat.upload.file2') }}" method="POST" enctype="multipart/form-data">  --}}
                                            {{--  @csrf
                                            <div class="modal-header">
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <input type="file" id="attachment" name="attachment"
                                                            class="form-control" accept="application/pdf" required />
                                                    </div>
                                                    <span style="text-align: center">Max 2MB</span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </div>
                                        </form>  --}}
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        <h5 class="modal-title" id="backDropModalTitle">Insert a TEXT for training
                                        </h5>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionInsideModal">
                                    <div class="accordion-body">
                                        {{--  <form class="modal-content-2" action="{{ route('attachments.uploadText') }}"
                                            method="POST">
                                            @csrf
                                            <div class="modal-header">
                                            </div>
                                            <div class="modal-body">
                                                <div class="input-group mb-3">
                                                    <textarea type="text" id="text" name="text" class="form-control" placeholder="Write a message..." rows="5 "
                                                        cols="33"></textarea>
                                                    <div class="input-group-append m-1">
                                                        <input type="file" id="file-input" name="attachment"
                                                            style="display: none;" accept="application/pdf">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Send</button>
                                                {{-- <button type="submit" id="submitBtn2" class="btn btn-primary"
                                                    data-bs-toggle="popover" data-bs-placement="top"
                                                    data-bs-content="Please select a Text before submitting.">
                                                    Send
                                                </button> --}}
                                            </div>
                                        </form>  --}}
                                    </div>
                                </div>
                            </div>
                            <!-- Acordeón 3 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        <!-- Formulario 3: URL -->
                                        <h5 class="modal-title" id="backDropModalTitle">Insert a URL for training
                                        </h5>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionInsideModal">
                                    <div class="accordion-body">
                                        {{--  <form action="{{route('scrape')}}" method="POST"
                                            >
                                            @csrf
                                            <div class="modal-content-3" >
                                            <div class="modal-header">
                                            </div>
                                            <div class="modal-body">
                                                <div class="input-group mb-3">
                                                    <input type="text" id="url" name="url"
                                                        class="form-control" placeholder="https://www.anUrl.com">
                                                     <div class="input-group-append m-1">
                                                        <!-- Botón para adjuntar archivo PDF -->
                                                        <!-- <button type="button" id="attach-file-btn" class="btn btn-warning"><i class="bx bx-paperclip"></i></button> -->
                                                        <input type="file" id="url" name="url"
                                                            style="display: none;" accept="application/pdf">
                                                        <!-- <button type="submit" class="btn btn-primary">EnviarS</button> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Send</button>

                                            </div>
                                        </form>  --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="m-3">
                        <a href="#" class="btn btn-danger" onclick="eliminarDatos(event)">Deleted training data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade modal-config" id="aiTrainingStatusModal" tabindex="-1"
            aria-labelledby="aiTrainingStatusModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="aiTrainingStatusModalLabel">AI Training Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <!-- Dynamic Message -->
                        <div id="trainingResultMessage">
                            <!-- Success or Failure message will be inserted dynamically -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="retryTraining()">Retry
                            Training</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Modal para acceso denegado - Bootstrap 5 -->
    <div class="modal fade" id="deniedAccessModal" tabindex="-1" aria-labelledby="deniedAccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold text-danger" id="deniedAccessModalLabel">
                        <i class="fas fa-lock me-2"></i> Acceso Restringido
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-exclamation-circle fa-4x text-warning"></i>
                    </div>
                    <h5 class="fw-bold mb-2">¡Función no disponible!</h5>
                    <p class="mb-0">Mejora tu plan para acceder a estas herramientas.</p>
                </div>
                <div class="modal-footer bg-light justify-content-center">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i> Cerrar
                    </button>
                    @if(Route::has('plans'))
                    <a href="{{ route('plans') }}" class="btn btn-primary px-4">
                        <i class="fas fa-crown me-2"></i> Ver Planes
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ClientModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-center" id="exampleModalLabel">Integrate WhatsApp with your CRM</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
<p>Are you sure you want to integrate WhatsApp into our platform?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnCreateClient">Yes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>

      {{-- client ia --}}

      <div class="modal fade" id="ClientIAModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-center" id="exampleModalLabel">Integrate WhatsApp with your AI CRM</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
<p>Are you sure you want to integrate WhatsApp into our platform?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btnCreateClientIA">Yes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>
    {!! Html::script('sneat/assets/vendor/libs/jquery/jquery.js') !!}
    {!! Html::script('sneat/assets/vendor/libs/popper/popper.js') !!}
    {!! Html::script('sneat/assets/vendor/js/bootstrap.js') !!}
    {!! Html::script('sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') !!}
    {!! Html::script('sneat/assets/vendor/js/menu.js') !!}
    {!! Html::script('sneat/assets/vendor/libs/apex-charts/apexcharts.js') !!}
    {!! Html::script('sneat/assets/js/main.js') !!}
    {!! Html::script('sneat/assets/js/dashboards-analytics.js') !!}


    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <script src="https://js.stripe.com/v3/"></script>



    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const toggleMenu = document.getElementById('toggle-menu');
            const layoutMenu = document.getElementById('layout-menu');
            const layoutMenuToggle = document.querySelector('.layout-menu-toggle.menu-link');

            if (toggleMenu && layoutMenu) {
                toggleMenu.addEventListener('click', function() {
                    layoutMenu.classList.toggle('menu-hidden');
                });
            }

            if (layoutMenuToggle) {
                layoutMenuToggle.addEventListener('click', function() {
                    layoutMenu.classList.toggle('menu-hidden');
                });
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            var pageLoader = document.getElementById('page-loader');

            window.showLoader = function() {
                pageLoader.style.display = 'flex';
            }
            window.hideLoader = function() {
                pageLoader.style.display = 'none';
            }
            window.addEventListener('load', function() {
                setTimeout(hideLoader, 800);
            });


            window.addEventListener('beforeunload', function() {
                showLoader();
            });
        });



        $('#countrySelect').on('change', function() {
            var selectedCode = $(this).val();
            var phoneInput = $('#phoneInput');

            var currentValue = phoneInput.val();

            if (selectedCode) {
                phoneInput.val(selectedCode + ' ' + currentValue);
            }
        });

        // Manejo de entrada en el campo de teléfono
        $('#phoneInput').on('input', function() {
            var phoneInput = $(this);
            var selectedCode = $('#countrySelect').val();

            if (selectedCode) {
                var value = phoneInput.val();
                var newValue = value.startsWith(selectedCode) ? value : selectedCode + ' ' + value;
                phoneInput.val(newValue);
            }

        });

        document.addEventListener("DOMContentLoaded", function() {
            const inputFile1 = document.getElementById("nameBackdrop");
            const inputFile2 = document.getElementById("file-input");
            const inputFile3 = document.getElementById("url");

            const submitBtn1 = document.getElementById("submitBtn1");
            const submitBtn2 = document.getElementById("submitBtn2");
            const submitBtn3 = document.getElementById("submitBtn3");
            // Inicializa el popover
            const popover1 = new bootstrap.Popover(submitBtn1, {
                trigger: "manual", // Control manual del popover
            });

            const popover2 = new bootstrap.Popover(submitBtn2, {
                trigger: "manual", // Control manual del popover
            });

            const popover3 = new bootstrap.Popover(submitBtn3, {
                trigger: "manual", // Control manual del popover
            });

            submitBtn1.addEventListener("click", function(event) {
                if (!inputFile1.value) {
                    event.preventDefault(); // Evita el envío del formulario
                    popover1.show(); // Muestra el popover
                    setTimeout(() => {
                        popover1.hide(); // Oculta el popover después de 3 segundos
                    }, 3000);
                }
            });

            submitBtn2.addEventListener("click", function(event) {
                if (!inputFile2.value) {
                    event.preventDefault(); // Evita el envío del formulario
                    popover2.show(); // Muestra el popover
                    setTimeout(() => {
                        popover2.hide(); // Oculta el popover después de 3 segundos
                    }, 3000);
                }
            });

            submitBtn3.addEventListener("click", function(event) {
                if (!inputFile3.value) {
                    event.preventDefault(); // Evita el envío del formulario
                    popover3.show(); // Muestra el popover
                    setTimeout(() => {
                        popover3.hide(); // Oculta el popover después de 3 segundos
                    }, 3000);
                }
            });
        });

        function toggleInfo() {
            const infoContent = document.getElementById('info-content');
            infoContent.style.display = infoContent.style.display === 'block' ? 'none' : 'block';
        }

        // Mostrar el mensaje dinámico en el modal
        function showTrainingStatus(isSuccess) {
            closeModal('backDropModal')
            const trainingResultMessage = document.getElementById('trainingResultMessage');
            if (isSuccess) {
                trainingResultMessage.innerHTML = '<p class="text-success">The AI training was successful! 🎉</p>';
            } else {
                trainingResultMessage.innerHTML = '<p class="text-danger">The AI training failed. Please try again. ❌</p>';
            }

            // Mostrar el modal
            const modal = new bootstrap.Modal(document.getElementById('aiTrainingStatusModal'));
            modal.show();
        }

        // Redirigir o reiniciar el entrenamiento
        function retryTraining() {
            closeModal('aiTrainingStatusModal')
            openModal()
        }

       function eliminarDatos(event) {
    event.preventDefault();

    let modal = bootstrap.Modal.getInstance(document.getElementById('backDropModal'));
    if (modal) {
        modal.hide();
    }


    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("/attachments/delete-all", {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": '{{ csrf_token() }}',
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: "¡Eliminado!",
                        text: "Los datos han sido eliminados correctamente.",
                        icon: "success",
                        confirmButtonColor: "#3085d6"
                    }).then(() => {
                        location.reload(); // Recargar la página después de cerrar la alerta
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: data.error,
                        icon: "error",
                        confirmButtonColor: "#d33"
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: "Error",
                    text: "Ocurrió un problema al eliminar los datos.",
                    icon: "error",
                    confirmButtonColor: "#d33"
                });
                console.error("Error:", error);
            });
        }
    });
}

        // Ejemplo de uso
        // Simular éxito
        // showTrainingStatus(true);

        // Simular fallo
        // showTrainingStatus(false);

        // Cerrar el modal con la ID "backDropModal"
        function closeModal(modal) {
            const modalElement = document.getElementById(modal);
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
            }
        }
        // Abrir el modal con la ID "backDropModal"
        function openModal() {
            const modalElement = document.getElementById('backDropModal');
            const modalInstance = new bootstrap.Modal(modalElement);
            modalInstance.show();
        }



        $('#countrySelect').on('change', function() {
            var selectedCode = $(this).val();
            var phoneInput = $('#phoneInput');

            var currentValue = phoneInput.val();

            if (selectedCode) {
                phoneInput.val(selectedCode + ' ' + currentValue);
            }
        });

        // Manejo de entrada en el campo de teléfono
        $('#phoneInput').on('input', function() {
            var phoneInput = $(this);
            var selectedCode = $('#countrySelect').val();

            if (selectedCode) {
                var value = phoneInput.val();
                var newValue = value.startsWith(selectedCode) ? value : selectedCode + ' ' + value;
                phoneInput.val(newValue);
            }

        });

        // Código de SweetAlert para éxito y error
        @if (session('success'))
            Swal.fire({
                title: '¡Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: '¡Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        @endif
    </script>



    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
