<?php
// =========================================================================
// CHATBOT FLOTANTE PHP con Diseño Moderno (CSS Puro + Conversacional)
// Versión para INCORPORACIÓN y posición: Inferior Izquierda.
// =========================================================================

// Configuración de la Empresa (Extraída del contexto inicial)
$Company = "ALCAR All Services Corp";
$Phone = '(239) 789-5187';
$CompanyPhoneClean = '12397895187'; // Número limpio para WhatsApp (asumiendo +1)

// =========================================================================
// LECTURA DE DATA/FAQ.JSON
// =========================================================================
$faq_file_path = 'data/faq.json';
$faq_json_data = '[]'; // Valor por defecto si el archivo no existe o está vacío

if (file_exists($faq_file_path)) {
    $content = file_get_contents($faq_file_path);
    if ($content !== false && !empty($content)) {
        $decoded = json_decode($content, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            $faq_json_data = $content;
        }
    }
}
?>
<section id="chatbot-embed-section" style="position: relative; z-index: 99999;">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        /* Estilos Base para la incrustación */
        #chatbot-embed-section * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        /* -------------------- Contenedor Flotante Principal -------------------- */
        .chatbot-main-wrapper {
            position: fixed;
            bottom: 1rem;
            /* Móvil: bottom-4, left-4 */
            left: 1rem;
            /* ⭐ POSICIÓN INFERIOR IZQUIERDA */
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            /* Alinea todo a la izquierda */
        }

        @media (min-width: 640px) {
            .chatbot-main-wrapper {
                bottom: 2rem;
                /* sm:bottom-8 */
                left: 2rem;
                /* ⭐ POSICIÓN INFERIOR IZQUIERDA */
            }
        }

        /* -------------------- Tarjeta de Chatbot (Modal) -------------------- */
        #chatbot-container {
            width: 20rem;
            /* w-80 */
            height: 560px;
            display: flex;
            flex-direction: column;
            background-color: #f9fafb;
            /* bg-gray-50 */
            border-radius: 0.75rem;
            /* rounded-xl */
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            /* shadow-2xl */
            transition: all 0.3s ease-in-out;
            margin-bottom: 1rem;
            transform-origin: bottom left;
            /* Origen de la animación desde la esquina inferior izquierda */
            overflow: hidden;
        }

        @media (min-width: 640px) {
            #chatbot-container {
                width: 24rem;
                /* sm:w-96 */
            }
        }

        /* Clase para ocultar/mostrar con animación */
        .chat-hidden {
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px) scale(0.95);
        }

        /* -------------------- GLOBO DE MENSAJE FLOTANTE INICIAL (TOOLTIP) -------------------- */
        #floating-initial-message {
            position: absolute;
            bottom: 5rem;
            /* Separación del botón */
            left: 0;
            width: 15rem;
            background-color: white;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem 0.75rem 0.75rem 0.1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease-in-out;
            cursor: pointer;
        }

        #floating-initial-message.show-message {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        #floating-initial-message p {
            font-size: 0.875rem;
            /* text-sm */
            color: #1f2937;
            /* text-gray-800 */
            margin: 0;
            line-height: 1.4;
        }

        #floating-initial-message strong {
            font-weight: 600;
        }

        /* Encabezado */
        .chat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem;
            background-color: white;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .chat-header-avatar {
            width: 2rem;
            height: 2rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            background-color: #164384;
            margin-right: 0.5rem;
        }

        .chat-header h1 {
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin: 0;
        }

        /* Área de Mensajes (Chat Log) */
        #chat-log {
            flex-grow: 1;
            padding: 1rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        /* Estilo para simular la conversación */
        .chat-message-bubble {
            background-color: white;
            padding: 1rem;
            border-radius: 0.75rem 0.75rem 0.75rem 0.1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            max-width: 90%;
            margin-right: auto;
        }

        .chat-message-bubble p {
            font-size: 0.875rem;
            color: #4b5563;
            margin: 0;
        }

        .chat-message-bubble .time {
            font-size: 0.75rem;
            color: #9ca3af;
            margin-top: 0.25rem;
            text-align: right;
        }

        .chat-agent-message {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .chat-agent-message .flex-1 {
            flex: 1;
        }

        /* Contenedor del Formulario */
        #contact-form-bubble {
            margin-top: 1rem;
            padding: 0.5rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            background-color: #f3f4f6;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        #whatsapp-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        /* Inputs del Formulario */
        #whatsapp-form input[type="text"],
        #whatsapp-form input[type="tel"].form-control {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            color: #1f2937;
            font-size: 1rem;
        }

        #whatsapp-form input::placeholder {
            color: #6b7280;
        }

        #whatsapp-form input:focus {
            outline: none;
            box-shadow: 0 0 0 1px #06b6d4, 0 0 0 3px #06b6d440;
        }

        /* Checkbox y Etiqueta */
        .consent-container {
            display: flex;
            align-items: flex-start;
            font-size: 0.75rem;
            color: #6b7280;
            gap: 0.5rem;
        }

        .consent-container input[type="checkbox"] {
            margin-top: 0.25rem;
            border-radius: 0.25rem;
            border-color: #d1d5db;
            --tw-ring-color: #06b6d4;
            --tw-ring-offset-width: 0px;
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000);
            accent-color: #164384;
        }

        /* Botón de Enviar */
        .send-button-container {
            padding-top: 0.5rem;
            text-align: right;
        }

        #send-button {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1.5rem;
            color: white;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease-in-out;
            background-color: #164384;
            box-shadow: 0 4px 6px -1px rgba(22, 67, 132, 0.5);
            border: none;
            cursor: pointer;
        }

        #send-button:hover {
            transform: scale(1.02);
        }

        #send-button:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.5);
        }

        #send-button svg {
            height: 1rem;
            width: 1rem;
            margin-left: 0.5rem;
            transform: rotate(45deg);
        }

        /* Mensaje de Error */
        #error-message {
            display: none;
            margin-top: 0.5rem;
            text-align: center;
            font-size: 0.75rem;
            padding: 0.25rem;
            border-radius: 0.5rem;
            background-color: rgba(239, 68, 68, 0.9);
            color: white;
        }

        /* Pie de Página */
        #powered-by {
            text-align: center;
            padding: 0.5rem;
            border-top: 1px solid #e5e7eb;
            font-size: 0.75rem;
            color: #9ca3af;
            background-color: white;
            position: sticky;
            bottom: 0;
            z-index: 10;
        }

        #powered-by strong {
            font-weight: 700;
        }

        /* -------------------- Botones Flotantes -------------------- */
        .chat-float-button {
            width: 4rem;
            height: 4rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            background-color: #164384;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease-in-out;
            border: none;
            cursor: pointer;
            z-index: 9999 !important;
        }

        .chat-float-button:hover {
            background-color: #1a4f94;
            transform: scale(1.05);
        }

        #chat-toggle-button {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04), 0 0 0 4px rgba(59, 130, 246, 0.25);
        }

        .chat-float-button svg {
            height: 2rem;
            width: 2rem;
        }

        /* Estilo para el botón de cerrar flotante (X) - Se oculta en el flujo normal */
        #close-button-float {
            display: none;
            /* Se oculta, el icono de cerrar estará en el toggle button */
        }

        /* -------------------- Estilos intl-tel-input -------------------- */
        .iti {
            width: 100%;
        }

        .iti .form-control {
            border: 1px solid #d1d5db !important;
            border-radius: 0.5rem !important;
            height: 40px !important;
            padding-left: 52px !important;
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
        }

        .iti__flag-container {
            border-radius: 0.5rem 0 0 0.5rem;
        }

        .iti__country-list .iti__highlight,
        .iti__country-list .iti__active {
            background-color: #164384 !important;
            color: #fff !important;
            border-radius: 0.25rem;
            margin: 2px 0;
            padding: 6px 6px 6px 12px;
        }

        /* -------------------- Estilos del Toggle de Idioma -------------------- */
        .language-toggle-wrapper {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .lang-text {
            font-size: 0.875rem;
            font-weight: 600;
        }

        .lang-text-active {
            color: #374151;
        }

        .lang-text-inactive {
            color: #9ca3af;
        }

        .toggle-switch-label {
            position: relative;
            display: inline-flex;
            align-items: center;
            cursor: pointer;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }

        .toggle-switch-container {
            width: 2.25rem;
            height: 1.25rem;
            border-radius: 9999px;
            position: relative;
            background-color: #164384;
            border: 1px solid #164384;
            transition: background-color 0.3s;
        }

        .toggle-switch-handle {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            border: 1px solid #164384;
            border-radius: 9999px;
            height: 1rem;
            width: 1rem;
            background-color: white;
            transition: transform 0.3s;
            transform: translateX(0);
        }

        .toggle-switch-input:checked+.toggle-switch-label .toggle-switch-container {
            background-color: #3b82f6;
        }

        .toggle-switch-input:checked+.toggle-switch-label .toggle-switch-handle {
            transform: translateX(1.5rem);
        }

        /* Estilos del botón de WhatsApp */
        .whatsapp-button {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background-color: #22c55e;
            color: white;
            font-weight: 600;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .whatsapp-button:hover {
            background-color: #16a34a;
        }

        .whatsapp-button:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.5);
        }

        .whatsapp-button svg {
            height: 1.25rem;
            width: 1.25rem;
            margin-right: 0.5rem;
        }

        /* ✅ Fix overflow del selector */
        #chatbot-container {
            overflow: visible !important;
        }

        /* ✅ Asegurar que el dropdown se muestre por encima del modal */
        .iti__country-list {
            z-index: 999999 !important;
        }

        /* ✅ Evitar que el dropdown se corte */
        #phone-input-container {
            overflow: visible !important;
        }

        /* ✅ Ajuste perfecto del input telefónico */
        .iti .form-control {
            padding-left: 60px !important;
            /* espacio extra para el código del país */
            height: 48px !important;
            line-height: 48px !important;
        }

        .iti input.form-control {
            padding-left: 70px !important;
        }

        /* ✅ Sombra ligeramente más suave y consistente */
        .iti--allow-dropdown input {
            box-shadow: none !important;
        }
    </style>

    <div class="chatbot-main-wrapper">

        <div id="floating-initial-message" onclick="toggleChat()">
            <div style="display: flex; align-items: flex-start; gap: 0.5rem;">
                <div class="chat-header-avatar" style="flex-shrink: 0; margin-right: 0;">A</div>
                <div>
                    <p id="floating-message-text">
                        Your growth starts with a message. <strong>What questions do you have in mind?</strong>
                    </p>
                </div>
            </div>
        </div>

        <div id="chatbot-container" class="chat-hidden">

            <div class="chat-header">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div class="chat-header-avatar">A</div>
                    <h1 id="header-title">Do you want to scale your business?</h1>
                </div>
                <div class="language-toggle-wrapper">
                    <span id="lang-en" class="lang-text lang-text-active">EN</span>
                    <label id="language-switch" class="toggle-switch-label">
                        <input type="checkbox" value="" class="sr-only toggle-switch-input">
                        <div class="toggle-switch-container">
                            <span class="toggle-switch-handle"></span>
                        </div>
                    </label>
                    <span id="lang-es" class="lang-text lang-text-inactive">ES</span>
                </div>
            </div>

            <div id="chat-log">

                <div id="initial-message-bubble" class="chat-agent-message">
                    <div class="chat-header-avatar">A</div>
                    <div style="flex: 1;">
                        <div class="chat-message-bubble">
                            <p id="agent-message-text">Share your contact information</p>
                            <p id="agent-message-time" class="time"><?php echo date('j M, H:i'); ?></p>
                        </div>
                    </div>
                </div>

                <div id="contact-form-bubble">
                    <form id="whatsapp-form">
                        <div>
                            <input type="text" id="client-name" name="client-name" required placeholder="Name">
                        </div>

                        <div id="phone-input-container" style="position: relative;">
                            <input type="tel" id="client-phone" name="client-phone" required placeholder="Phone"
                                class="form-control">
                        </div>

                        <div class="consent-container">
                            <input type="checkbox" id="consent-check" name="consent-check">
                            <label id="consent-label" for="consent-check">
                                By submitting you agree to receive SMS or e-mails for the provided channel. Rates may be applied.
                            </label>
                        </div>

                        <div class="send-button-container">
                            <button type="submit" id="send-button">
                                <span>Send</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="height: 1rem; width: 1rem; margin-left: 0.5rem; transform: rotate(45deg);">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <div id="error-message" style="display: none;"></div>

                <div id="confirmation-message-container"></div>
            </div>

            <div id="powered-by">
                Powered by <strong>MÄVEN Marketing</strong>
            </div>
        </div>

        <button id="chat-toggle-button" class="chat-float-button">
            <svg id="chat-open-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="height: 2rem; width: 2rem; display: block;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 4v-4z" />
            </svg>
            <svg id="chat-close-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="height: 2rem; width: 2rem; display: none;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <button id="close-button-float" class="chat-float-button" style="display: none;"></button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"></script>

    <script>
        // Declaración global para que sea accesible desde el onclick del tooltip
        let isChatOpen = false;
        let currentLang = 'en';

        /**
         * Función para alternar la visibilidad del modal y los iconos.
         */
        const toggleChat = () => {
            const chatContainer = document.getElementById('chatbot-container');
            const toggleButton = document.getElementById('chat-toggle-button');
            const openIcon = document.getElementById('chat-open-icon');
            const closeIcon = document.getElementById('chat-close-icon');
            const floatingMessage = document.getElementById('floating-initial-message');

            isChatOpen = !isChatOpen;

            if (isChatOpen) {
                // Abrir Chat
                chatContainer.classList.remove('chat-hidden');
                openIcon.style.display = 'none';
                closeIcon.style.display = 'block';
                chatContainer.style.opacity = "1";
                chatContainer.style.visibility = "visible";


                // Ocultar mensaje flotante si está visible
                if (floatingMessage) floatingMessage.classList.remove('show-message');

            } else {
                // Cerrar Chat
                chatContainer.classList.add('chat-hidden');
                openIcon.style.display = 'block';
                closeIcon.style.display = 'none';
                chatContainer.style.opacity = "0";
                chatContainer.style.visibility = "hidden";

            }
        };


        document.addEventListener('DOMContentLoaded', () => {
            // Referencias del DOM
            const chatContainer = document.getElementById('chatbot-container');
            const toggleButton = document.getElementById('chat-toggle-button');
            const chatLog = document.getElementById('chat-log');
            const floatingMessage = document.getElementById('floating-initial-message');

            const langSwitch = document.getElementById('language-switch').querySelector('input');
            const langEn = document.getElementById('lang-en');
            const langEs = document.getElementById('lang-es');

            const form = document.getElementById('whatsapp-form');
            const nameInput = document.getElementById('client-name');
            const phoneInput = document.getElementById('client-phone');
            const consentCheck = document.getElementById('consent-check');
            const errorMessage = document.getElementById('error-message');
            const contactFormBubble = document.getElementById('contact-form-bubble');
            const confirmationMessageContainer = document.getElementById('confirmation-message-container');

            // Datos y Estado (Extraídos de PHP)
            const companyPhone = '<?php echo $CompanyPhoneClean; ?>';
            const companyName = '<?php echo $Company; ?>';
            let faqData = <?php echo json_encode(json_decode($faq_json_data, true)); ?>;

            // ✅ Mantener solo números en el input y evitar que escriba el código
            phoneInput.addEventListener('input', () => {
                const dialCode = iti.getSelectedCountryData().dialCode;
                let number = phoneInput.value.replace(/[^\d]/g, ""); // Solo números
                number = number.replace(new RegExp("^" + dialCode), ""); // Eliminar prefijo si lo escribe
                phoneInput.value = number;
            });

            // -------------------- Cadenas de Texto Bilingües --------------------
            const translations = {
                en: {
                    headerTitle: "Do you want to scale your business?",
                    agentMessageText: "Share your contact information",
                    floatingMessageText: "Your growth starts with a message. <strong>What questions do you have in mind?</strong>",
                    namePlaceholder: "Name",
                    phonePlaceholder: "Phone",
                    consentLabel: "By submitting you agree to receive SMS or e-mails for the provided channel. Rates may be applied.",
                    sendButton: "Send",
                    errorMessageInvalid: "Please enter your name and a valid phone number, including the area code.",
                    errorMessageName: "Please enter your name.",
                    confirmationMessage: (name) => `Thank you, ${name}! We have received your information and are ready to chat on WhatsApp. Please click the button below.`,
                    whatsappButtonText: "Start Chat on WhatsApp",
                    poweredBy: 'Powered by MAVEN MARKETING',
                    whatsappMessage: (name, phone, consent) => `Hello ${companyName}! My name is ${name} and my full number is ${phone}. I would like to request more information about your services. (Client CONSENT for SMS/E-mails: ${consent ? 'YES' : 'NO'}).`
                },
                es: {
                    headerTitle: "¿Quieres escalar tu negocio?",
                    agentMessageText: "Comparta los datos de contacto",
                    floatingMessageText: "Tu crecimiento empieza con un mensaje. <strong>¿Nos cuentas qué tienes en mente?</strong>",
                    namePlaceholder: "Nombre",
                    phonePlaceholder: "Teléfono",
                    consentLabel: "Al enviar, usted acepta recibir SMS o correos electrónicos por el canal proporcionado. Pueden aplicarse tarifas.",
                    sendButton: "Enviar",
                    errorMessageInvalid: "Por favor, introduzca su nombre y un número de teléfono válido, incluyendo el código de área.",
                    errorMessageName: "Por favor, introduzca su nombre.",
                    confirmationMessage: (name) => `¡Gracias, ${name}! Hemos recibido su información y estamos listos para chatear en WhatsApp. Por favor, haga clic en el botón de abajo.`,
                    whatsappButtonText: "Iniciar Chat en WhatsApp",
                    poweredBy: 'Impulsado por MAVEN MARKETING',
                    whatsappMessage: (name, phone, consent) => `¡Hola ${companyName}! Mi nombre es ${name} y mi número completo es ${phone}. Me gustaría solicitar más información sobre sus servicios. (Consentimiento del cliente para SMS/E-mails: ${consent ? 'SÍ' : 'NO'}).`
                }
            };
            // --------------------------------------------------------------------


            // -------------------- Inicialización intl-tel-input --------------------
            const iti = window.intlTelInput(phoneInput, {
                initialCountry: "us",
                separateDialCode: true,
                preferredCountries: ["us", "mx", "co", "do", "es"],
                customContainer: "w-full",
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/utils.js"
            });
            // ------------------------------------------------------------------------

            /**
             * Actualiza todos los elementos de texto en la interfaz.
             */
            const updateTexts = (lang) => {
                const t = translations[lang];

                // Actualizar títulos y mensajes
                document.getElementById('header-title').textContent = t.headerTitle;
                document.getElementById('agent-message-text').textContent = t.agentMessageText;
                document.getElementById('floating-message-text').innerHTML = t.floatingMessageText.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

                // Actualizar placeholders
                nameInput.placeholder = t.namePlaceholder;
                phoneInput.placeholder = t.phonePlaceholder;

                // Actualizar textos del formulario
                document.getElementById('consent-label').textContent = t.consentLabel;
                document.getElementById('send-button').querySelector('span').textContent = t.sendButton;
                document.getElementById('powered-by').innerHTML = t.poweredBy.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

                // Estilos del selector de idioma (usando clases definidas en CSS puro)
                langEn.classList.remove('lang-text-active', 'lang-text-inactive');
                langEs.classList.remove('lang-text-active', 'lang-text-inactive');

                if (lang === 'en') {
                    langEn.classList.add('lang-text-active');
                    langEs.classList.add('lang-text-inactive');
                } else {
                    langEs.classList.add('lang-text-active');
                    langEn.classList.add('lang-text-inactive');
                }

                errorMessage.style.display = 'none';
                currentLang = lang;
            };

            // -------------------- LÓGICA DE GLOBO FLOTANTE --------------------
            const showFloatingMessage = () => {
                if (!isChatOpen) {
                    floatingMessage.classList.add('show-message');
                    // Ocultar después de 6 segundos
                    setTimeout(() => {
                        floatingMessage.classList.remove('show-message');
                    }, 6000);
                }
            }

            // Muestra el mensaje después de un pequeño retraso para la carga de la página
            setTimeout(showFloatingMessage, 1500);

            // Listener para ocultar el mensaje si se hace scroll
            window.addEventListener('scroll', () => {
                floatingMessage.classList.remove('show-message');
            });
            // ------------------------------------------------------------------

            // Listeners
            langSwitch.addEventListener('change', (e) => {
                const newLang = e.target.checked ? 'es' : 'en';
                updateTexts(newLang);
                // Si ya se envió, re-renderiza el mensaje de confirmación
                if (confirmationMessageContainer.querySelector('#whatsapp-chat-start-button')) {
                    const name = nameInput.value.trim();
                    const phone = iti.getNumber();
                    const consent = consentCheck.checked;
                    displayConfirmationMessage(name, phone, consent);
                }

                // Ajustar visualmente el handle
                const handle = document.querySelector('.toggle-switch-handle');
                if (handle) {
                    handle.style.transform = `translateX(${e.target.checked ? '1.5rem' : '0'})`;
                }
            });

            // LISTENERS corregidos para el toggle
            toggleButton.addEventListener('click', toggleChat);


            /**
             * Muestra el mensaje de confirmación y el botón de WhatsApp después del envío.
             */
            const displayConfirmationMessage = (name, fullPhone, isConsentChecked) => {
                const t = translations[currentLang];

                // 1. Ocultar el formulario
                contactFormBubble.style.display = 'none';

                // 2. Crear el mensaje de confirmación del Agente
                const agentConfirmationMessage = `
                    <div class="chat-agent-message mt-4">
                        <div class="chat-header-avatar">A</div>
                        <div style="flex: 1;">
                            <div class="chat-message-bubble">
                                <p>${t.confirmationMessage(name)}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 1rem; text-align: center;">
                        <a href="https://wa.me/${companyPhone}?text=${encodeURIComponent(t.whatsappMessage(name, fullPhone, isConsentChecked))}" 
                            target="_blank" id="whatsapp-chat-start-button"
                            class="whatsapp-button">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" style="height: 1.25rem; width: 1.25rem; margin-right: 0.5rem;">
                                <path d="M10 2a8 8 0 00-8 8c0 2.23 1.13 4.25 2.87 5.5l-.33 1.96a.5.5 0 00.67.67l1.96-.33A7.95 7.95 0 0010 18a8 8 0 000-16zm-1 3a1 1 0 102 0 1 1 0 00-2 0zm1 4a1 1 0 011 1v2a1 1 0 11-2 0v-2a1 1 0 011-1z" />
                            </svg>
                            ${t.whatsappButtonText}
                        </a>
                    </div>
                `;

                confirmationMessageContainer.innerHTML = agentConfirmationMessage;

                // Asegurar que el chat se desplace hasta el fondo
                chatLog.scrollTop = chatLog.scrollHeight;
            };

            form.addEventListener('submit', (event) => {
                event.preventDefault();

                const t = translations[currentLang];
                const clientName = nameInput.value.trim();
                const fullPhoneNumber = iti.getNumber();
                const isConsentChecked = consentCheck.checked;

                if (clientName === '') {
                    errorMessage.textContent = t.errorMessageName;
                    errorMessage.style.display = 'block';
                    return;
                }

                if (!iti.isValidNumber()) {
                    errorMessage.textContent = t.errorMessageInvalid;
                    errorMessage.style.display = 'block';
                    return;
                }

                errorMessage.style.display = 'none';

                const message = t.whatsappMessage(clientName, fullPhoneNumber, isConsentChecked);
                const waURL = `https://wa.me/${companyPhone}?text=${encodeURIComponent(message)}`;

                // ✅ Iniciar chat directamente
                window.open(waURL, '_blank');

                // ✅ Cerrar el modal después del envío
                toggleChat();
            });

            // Inicializar el switch de idioma y el texto
            langSwitch.checked = false; // Inglés por defecto
            updateTexts('en');

            // Simular la posición correcta del handle del switch de idioma
            const handle = document.querySelector('.toggle-switch-handle');
            if (handle) {
                // Posicionar el switch en el estado inicial de 'en' (izquierda)
                handle.style.transform = `translateX(${langSwitch.checked ? '1.5rem' : '0'})`;
            }
        });
    </script>
</section>