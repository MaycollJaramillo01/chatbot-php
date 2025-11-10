<?php
require_once __DIR__ . '/../text.php';
$companyInitials = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $Company), 0, 2));
?>
<link rel="stylesheet" href="chatbot/chatbot.css">

<button id="chatbot-launcher" type="button" aria-haspopup="dialog" aria-controls="chatbot-widget" aria-expanded="false" aria-label="Abrir asistente">
    <span aria-hidden="true">💬</span>
</button>

<div id="chatbot-widget" class="chatbot-widget" role="dialog" aria-modal="false" aria-hidden="true">
    <div class="chatbot-card">
        <header class="chatbot-header">
            <div class="avatar" aria-hidden="true"><?php echo htmlspecialchars($companyInitials, ENT_QUOTES, 'UTF-8'); ?></div>
            <div class="title-block">
                <span class="subtitle" id="chatbot-header-subtitle">¿Quieres escalar tu negocio?</span>
                <span class="headline" id="chatbot-header-headline">Comparte tus datos de contacto</span>
            </div>
            <button class="chatbot-toggle" type="button" aria-label="Minimizar asistente" id="chatbot-toggle">
                <span aria-hidden="true">⌄</span>
            </button>
        </header>
        <div class="chatbot-body">
            <form id="chatbot-intro-form" autocomplete="off">
                <label for="chatbot-name">Nombre</label>
                <input id="chatbot-name" name="name" type="text" placeholder="Tu nombre" required>
                <label for="chatbot-phone">Teléfono</label>
                <input id="chatbot-phone" name="phone" type="tel" placeholder="Tu teléfono" required>
                <div id="chatbot-form-error" role="alert" style="display:none;"></div>
                <button type="submit">Enviar</button>
            </form>
            <div class="chatbot-chat-wrapper" id="chatbot-chat" aria-live="polite">
                <div class="chatbot-messages" id="chatbot-messages"></div>
                <div class="chatbot-suggestions" id="chatbot-suggestions"></div>
                <div class="chatbot-typing" id="chatbot-typing">
                    <span></span><span></span><span></span>
                    <small id="chatbot-typing-label">El asistente está escribiendo…</small>
                </div>
                <div class="chatbot-input-area">
                    <textarea id="chatbot-input" rows="1" placeholder="Escribe tu mensaje" maxlength="600"></textarea>
                    <button class="chatbot-send-btn" type="button" id="chatbot-send" aria-label="Enviar">➤</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    const widget = document.getElementById('chatbot-widget');
    const launcher = document.getElementById('chatbot-launcher');
    const toggleButton = document.getElementById('chatbot-toggle');
    const introForm = document.getElementById('chatbot-intro-form');
    const formError = document.getElementById('chatbot-form-error');
    const chatWrapper = document.getElementById('chatbot-chat');
    const messagesContainer = document.getElementById('chatbot-messages');
    const suggestionsContainer = document.getElementById('chatbot-suggestions');
    const typingIndicator = document.getElementById('chatbot-typing');
    const typingLabel = document.getElementById('chatbot-typing-label');
    const messageInput = document.getElementById('chatbot-input');
    const sendButton = document.getElementById('chatbot-send');
    const headerSubtitle = document.getElementById('chatbot-header-subtitle');
    const headerHeadline = document.getElementById('chatbot-header-headline');

    const nameField = document.getElementById('chatbot-name');
    const phoneField = document.getElementById('chatbot-phone');

    let currentLanguage = 'es';
    let isAwaitingResponse = false;

    function setWidgetOpen(open) {
        if (open) {
            widget.classList.add('is-open');
            widget.setAttribute('aria-hidden', 'false');
            launcher.setAttribute('aria-expanded', 'true');
            requestAnimationFrame(() => {
                if (introForm.style.display !== 'none' && nameField) {
                    nameField.focus();
                } else {
                    messageInput.focus();
                }
            });
        } else {
            widget.classList.remove('is-open');
            widget.setAttribute('aria-hidden', 'true');
            launcher.setAttribute('aria-expanded', 'false');
            if (messageInput) {
                messageInput.blur();
            }
            if (nameField) {
                nameField.blur();
            }
            if (phoneField) {
                phoneField.blur();
            }
        }
    }

    function updateLanguageUI(lang) {
        currentLanguage = lang;
        if (lang === 'en') {
            headerSubtitle.textContent = 'Ready to grow your business?';
            headerHeadline.textContent = 'Share your contact details';
            introForm.querySelector('label[for="chatbot-name"]').textContent = 'Name';
            introForm.querySelector('label[for="chatbot-phone"]').textContent = 'Phone';
            nameField.placeholder = 'Your name';
            phoneField.placeholder = 'Your phone';
            introForm.querySelector('button[type="submit"]').textContent = 'Start chat';
            messageInput.placeholder = 'Type your message';
            typingLabel.textContent = 'Assistant is typing…';
            sendButton.setAttribute('aria-label', 'Send');
            launcher.setAttribute('aria-label', 'Open assistant');
        } else {
            headerSubtitle.textContent = '¿Quieres escalar tu negocio?';
            headerHeadline.textContent = 'Comparte tus datos de contacto';
            introForm.querySelector('label[for="chatbot-name"]').textContent = 'Nombre';
            introForm.querySelector('label[for="chatbot-phone"]').textContent = 'Teléfono';
            nameField.placeholder = 'Tu nombre';
            phoneField.placeholder = 'Tu teléfono';
            introForm.querySelector('button[type="submit"]').textContent = 'Comenzar chat';
            messageInput.placeholder = 'Escribe tu mensaje';
            typingLabel.textContent = 'El asistente está escribiendo…';
            sendButton.setAttribute('aria-label', 'Enviar');
            launcher.setAttribute('aria-label', 'Abrir asistente');
        }
    }

    function renderMessage(role, text) {
        const wrapper = document.createElement('div');
        wrapper.classList.add('chatbot-message', role);

        const bubble = document.createElement('div');
        bubble.classList.add('chatbot-bubble');
        bubble.textContent = text;

        wrapper.appendChild(bubble);
        messagesContainer.appendChild(wrapper);
        scrollToBottom();
    }

    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function setSuggestions(list) {
        suggestionsContainer.innerHTML = '';
        if (!Array.isArray(list) || list.length === 0) {
            return;
        }
        list.forEach((item) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.textContent = item;
            button.addEventListener('click', () => {
                messageInput.value = item;
                sendMessage();
            });
            suggestionsContainer.appendChild(button);
        });
    }

    function setTyping(state) {
        typingIndicator.style.display = state ? 'flex' : 'none';
    }

    function autoResize() {
        messageInput.style.height = 'auto';
        messageInput.style.height = messageInput.scrollHeight + 'px';
    }

    async function registerUser(name, phone) {
        const formData = new FormData();
        formData.append('action', 'register');
        formData.append('name', name);
        formData.append('phone', phone);
        formData.append('lang', navigator.language || '');

        try {
            const response = await fetch('chatbot/chatbot.php', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            });
            const data = await response.json();
            if (data.status !== 'ok') {
                throw new Error(data.message || 'No fue posible iniciar el chat.');
            }
            updateLanguageUI(data.language || 'es');
            introForm.style.display = 'none';
            chatWrapper.classList.add('active');
            renderMessage('assistant', data.reply);
            setSuggestions(data.suggestions || []);
            setTimeout(() => messageInput.focus(), 120);
        } catch (error) {
            formError.textContent = error.message;
            formError.style.display = 'block';
        }
    }

    async function sendMessage() {
        if (isAwaitingResponse) {
            return;
        }

        const text = messageInput.value.trim();
        if (!text) {
            return;
        }

        renderMessage('user', text);
        messageInput.value = '';
        autoResize();
        setSuggestions([]);
        isAwaitingResponse = true;
        setTyping(true);

        const formData = new FormData();
        formData.append('message', text);

        try {
            const response = await fetch('chatbot/chatbot.php', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            });
            const data = await response.json();
            if (data.status !== 'ok') {
                throw new Error(data.message || 'El asistente no pudo responder.');
            }
            updateLanguageUI(data.language || currentLanguage);
            renderMessage('assistant', data.reply);
        } catch (error) {
            renderMessage('assistant', error.message);
        } finally {
            isAwaitingResponse = false;
            setTyping(false);
            messageInput.focus();
        }
    }

    launcher.addEventListener('click', () => {
        const isOpen = widget.classList.contains('is-open');
        setWidgetOpen(!isOpen);
    });

    toggleButton.addEventListener('click', () => {
        setWidgetOpen(false);
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && widget.classList.contains('is-open')) {
            setWidgetOpen(false);
        }
    });

    introForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = nameField.value.trim();
        const phone = phoneField.value.trim();
        formError.style.display = 'none';
        formError.textContent = '';

        if (!name || !phone) {
            formError.textContent = currentLanguage === 'en' ? 'Name and phone are required.' : 'Nombre y teléfono son obligatorios.';
            formError.style.display = 'block';
            return;
        }

        registerUser(name, phone);
    });

    sendButton.addEventListener('click', sendMessage);

    messageInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            sendMessage();
        }
    });

    messageInput.addEventListener('input', autoResize);

    updateLanguageUI(currentLanguage);
})();
</script>
