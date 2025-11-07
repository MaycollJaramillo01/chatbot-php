<?php
require_once __DIR__ . '/../text.php';
$companyInitials = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $Company), 0, 2));
?>
<link rel="stylesheet" href="chatbot/chatbot.css">

<button id="chatbot-assistant-button" type="button" aria-haspopup="dialog" aria-controls="chatbot-overlay" aria-expanded="false">
    <span class="icon">🤖</span>
    <span>Asistente</span>
</button>

<div id="chatbot-overlay" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="chatbot-modal">
        <header class="chatbot-header">
            <div class="info">
                <div class="logo" aria-hidden="true"><?php echo htmlspecialchars($companyInitials, ENT_QUOTES, 'UTF-8'); ?></div>
                <div class="text">
                    <span><?php echo htmlspecialchars($Company, ENT_QUOTES, 'UTF-8'); ?></span>
                    <span>Virtual Assistant</span>
                </div>
            </div>
            <button class="chatbot-close" type="button" aria-label="Cerrar">&times;</button>
        </header>
        <div class="chatbot-body">
            <form id="chatbot-intro-form" autocomplete="off">
                <div>
                    <label class="sr-only" for="chatbot-name">Nombre</label>
                    <input id="chatbot-name" name="name" type="text" placeholder="Tu nombre" required>
                </div>
                <div>
                    <label class="sr-only" for="chatbot-phone">Teléfono</label>
                    <input id="chatbot-phone" name="phone" type="tel" placeholder="Tu teléfono" required>
                </div>
                <div id="chatbot-form-error" role="alert" style="display:none;color:#ffb4b4;font-size:0.85rem;"></div>
                <button type="submit">Comenzar chat</button>
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
    const overlay = document.getElementById('chatbot-overlay');
    const openButton = document.getElementById('chatbot-assistant-button');
    const closeButton = document.querySelector('.chatbot-close');
    const introForm = document.getElementById('chatbot-intro-form');
    const formError = document.getElementById('chatbot-form-error');
    const chatWrapper = document.getElementById('chatbot-chat');
    const messagesContainer = document.getElementById('chatbot-messages');
    const suggestionsContainer = document.getElementById('chatbot-suggestions');
    const typingIndicator = document.getElementById('chatbot-typing');
    const typingLabel = document.getElementById('chatbot-typing-label');
    const messageInput = document.getElementById('chatbot-input');
    const sendButton = document.getElementById('chatbot-send');

    let currentLanguage = 'es';
    let isAwaitingResponse = false;

    const nameField = document.getElementById('chatbot-name');

    function toggleOverlay(show) {
        if (show) {
            overlay.classList.add('active');
            overlay.setAttribute('aria-hidden', 'false');
            openButton.setAttribute('aria-expanded', 'true');
            setTimeout(() => {
                if (nameField && introForm.style.display !== 'none') {
                    nameField.focus();
                }
            }, 180);
        } else {
            overlay.classList.remove('active');
            overlay.setAttribute('aria-hidden', 'true');
            openButton.setAttribute('aria-expanded', 'false');
        }
    }

    function updateLanguageUI(lang) {
        currentLanguage = lang;
        const label = openButton.querySelector('span:last-child');
        if (lang === 'en') {
            messageInput.placeholder = 'Type your message';
            typingLabel.textContent = 'Assistant is typing…';
            sendButton.setAttribute('aria-label', 'Send');
            if (label) {
                label.textContent = 'Assistant';
            }
        } else {
            messageInput.placeholder = 'Escribe tu mensaje';
            typingLabel.textContent = 'El asistente está escribiendo…';
            sendButton.setAttribute('aria-label', 'Enviar');
            if (label) {
                label.textContent = 'Asistente';
            }
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
                throw new Error(data.message || 'No se obtuvo respuesta.');
            }
            updateLanguageUI(data.language || currentLanguage);
            renderMessage('assistant', data.reply);
        } catch (error) {
            renderMessage('assistant', error.message);
        } finally {
            setTyping(false);
            isAwaitingResponse = false;
        }
    }

    openButton.addEventListener('click', () => toggleOverlay(true));
    closeButton.addEventListener('click', () => toggleOverlay(false));
    overlay.addEventListener('click', (event) => {
        if (event.target === overlay) {
            toggleOverlay(false);
        }
    });

    introForm.addEventListener('submit', (event) => {
        event.preventDefault();
        formError.style.display = 'none';
        const name = introForm.name.value.trim();
        const phone = introForm.phone.value.trim();

        if (!name || !phone) {
            formError.textContent = currentLanguage === 'en'
                ? 'Name and phone are required.'
                : 'El nombre y el teléfono son obligatorios.';
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
})();
</script>
