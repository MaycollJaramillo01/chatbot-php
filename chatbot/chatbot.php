<?php
session_start();

header('Content-Type: application/json; charset=UTF-8');

require_once __DIR__ . '/../text.php';
$dictionary = require __DIR__ . '/chatbot-dictionary.php';

$faqFile = __DIR__ . '/data/faq.json';
$textFile = __DIR__ . '/../text.php';

if (!file_exists($faqFile) || filemtime($faqFile) < filemtime($textFile)) {
    generateFaqFile($faqFile);
}

$rawFaq = file_get_contents($faqFile);
$faqData = json_decode($rawFaq ?: '[]', true);
if (!is_array($faqData)) {
    $faqData = [];
}

$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'CLI';

if ($requestMethod !== 'POST') {
    echo json_encode([
        'status' => $requestMethod === 'CLI' ? 'ok' : 'error',
        'message' => $requestMethod === 'CLI' ? 'FAQ cache ready.' : 'Invalid request method.'
    ]);
    exit;
}

$action = isset($_POST['action']) ? trim($_POST['action']) : 'message';

if ($action === 'register') {
    $name = sanitizeInput($_POST['name'] ?? '');
    $phone = sanitizeInput($_POST['phone'] ?? '');
    $langHint = sanitizeInput($_POST['lang'] ?? '');

    if ($name === '' || $phone === '') {
        echo json_encode([
            'status' => 'error',
            'message' => 'Nombre y teléfono son obligatorios.'
        ]);
        exit;
    }

    $_SESSION['chatbot_user'] = [
        'name' => $name,
        'phone' => $phone,
    ];

    $language = detectLanguage($langHint, $dictionary);
    if ($language === null) {
        $language = 'es';
    }
    $_SESSION['chatbot_language'] = $language;
    $_SESSION['chat_history'] = [];

    $greeting = getGreeting($language, $name);
    $suggestions = buildSuggestions($faqData, $language);

    appendToHistory('assistant', $greeting, $language);

    echo json_encode([
        'status' => 'ok',
        'reply' => $greeting,
        'language' => $language,
        'suggestions' => $suggestions,
    ]);
    exit;
}

$message = sanitizeInput($_POST['message'] ?? '');
if ($message === '') {
    echo json_encode([
        'status' => 'error',
        'message' => 'El mensaje está vacío.'
    ]);
    exit;
}

$language = detectLanguage($message, $dictionary);
if ($language === null) {
    $language = $_SESSION['chatbot_language'] ?? 'es';
}
$_SESSION['chatbot_language'] = $language;

appendToHistory('user', $message, $language);

$normalizedMessage = normalizeMessage($message, $dictionary, $language);

$response = findBestAnswer($normalizedMessage, $faqData, $language);

if ($response === null) {
    $response = getFallbackAnswer($language);
}

if (!empty($_SESSION['chatbot_user']['name'])) {
    $response = personalizeAnswer($response, $_SESSION['chatbot_user']['name'], $language);
}

appendToHistory('assistant', $response, $language);

echo json_encode([
    'status' => 'ok',
    'reply' => $response,
    'language' => $language,
]);
exit;

// -------------------------------------------------------------------------
// Helper functions
// -------------------------------------------------------------------------

function sanitizeInput(string $input): string
{
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

function generateFaqFile(string $faqFile): void
{
    global $Company, $Services, $Home, $About, $Phone, $Mail, $Schedule, $Cover, $Experience, $Estimates, $Payment, $Address, $SN, $SD;

    $homeText = extractFirstText($Home);
    $aboutText = extractFirstText($About);
    $aboutTextEn = shortenText($aboutText, 320);
    $missionTextEn = shortenText($homeText, 320);
    $aboutTextEs = "$Company es una empresa ubicada en $Address que ofrece soluciones integrales para hogares y negocios. Nuestro equipo combina atención al detalle y asesoría personalizada en cada proyecto.";
    $missionTextEs = 'Nuestra misión es transformar los espacios de nuestros clientes a través de una comunicación transparente, acompañamiento cercano y resultados que superan las expectativas.';
    $servicesList = buildServicesList($SN ?? [], $SD ?? []);
    $servicesSummaryEn = buildServicesSummary($servicesList, 'en');
    $servicesSummaryEs = buildServicesSummary($servicesList, 'es');

    $faq = [
        [
            'id' => 'company_overview',
            'question' => [
                'en' => "Who is $Company?",
                'es' => "¿Quién es $Company?",
            ],
            'answer' => [
                'en' => "$Company is based in $Address and is dedicated to delivering reliable residential and commercial solutions. $aboutTextEn",
                'es' => $aboutTextEs,
            ],
            'tags' => [
                'en' => ['about', 'company', 'overview'],
                'es' => ['empresa', 'sobre nosotros', 'quiénes somos'],
            ],
        ],
        [
            'id' => 'mission',
            'question' => [
                'en' => "What is the mission of $Company?",
                'es' => "¿Cuál es la misión de $Company?",
            ],
            'answer' => [
                'en' => "Our mission is to transform homes with transparent communication and tailored solutions. $missionTextEn",
                'es' => $missionTextEs,
            ],
            'tags' => [
                'en' => ['mission', 'vision'],
                'es' => ['misión', 'visión'],
            ],
        ],
        [
            'id' => 'services',
            'question' => [
                'en' => "What services does $Company provide?",
                'es' => "¿Qué servicios ofrece $Company?",
            ],
            'answer' => [
                'en' => "$Company provides $Services. $servicesSummaryEn",
                'es' => "$Company ofrece $Services. $servicesSummaryEs",
            ],
            'tags' => [
                'en' => ['services', 'offer', 'solutions', 'remodeling', 'roofing'],
                'es' => ['servicios', 'ofrecen', 'soluciones', 'remodeling', 'roofing'],
            ],
        ],
        [
            'id' => 'contact',
            'question' => [
                'en' => "How can I contact $Company?",
                'es' => "¿Cómo puedo contactar a $Company?",
            ],
            'answer' => [
                'en' => "You can call us at $Phone or email us at $Mail for more information or to request your project.",
                'es' => "Puedes llamarnos al $Phone o escribirnos a $Mail para solicitar más información o tu proyecto.",
            ],
            'tags' => [
                'en' => ['contact', 'phone', 'email'],
                'es' => ['contacto', 'teléfono', 'correo'],
            ],
        ],
        [
            'id' => 'availability',
            'question' => [
                'en' => "What are the service hours and coverage?",
                'es' => "¿Cuál es el horario y la cobertura del servicio?",
            ],
            'answer' => [
                'en' => "We are available $Schedule and we proudly cover $Cover.",
                'es' => "Estamos disponibles $Schedule y cubrimos con orgullo $Cover.",
            ],
            'tags' => [
                'en' => ['hours', 'schedule', 'coverage'],
                'es' => ['horario', 'cobertura'],
            ],
        ],
        [
            'id' => 'experience',
            'question' => [
                'en' => "Why choose $Company?",
                'es' => "¿Por qué elegir a $Company?",
            ],
            'answer' => [
                'en' => "$Company brings $Experience. We also provide $Estimates and accept $Payment.",
                'es' => "$Company cuenta con $Experience. También ofrecemos $Estimates y aceptamos $Payment.",
            ],
            'tags' => [
                'en' => ['experience', 'years', 'benefits'],
                'es' => ['experiencia', 'años', 'beneficios'],
            ],
        ],
    ];

    file_put_contents($faqFile, json_encode($faq, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function extractFirstText($source): string
{
    if (is_array($source) && !empty($source)) {
        return strip_tags((string) $source[array_key_first($source)]);
    }

    if (is_string($source)) {
        return strip_tags($source);
    }

    return '';
}

function buildServicesList(array $names, array $descriptions): array
{
    $list = [];
    foreach ($names as $key => $label) {
        $label = trim((string) $label);
        if ($label === '') {
            continue;
        }
        $description = isset($descriptions[$key]) ? strip_tags((string) $descriptions[$key]) : '';
        $list[] = [
            'name' => $label,
            'description' => $description,
        ];
    }
    return $list;
}

function buildServicesSummary(array $services, string $language): string
{
    if (empty($services)) {
        return $language === 'es'
            ? 'Consulta con nosotros para conocer todos los proyectos que podemos desarrollar contigo.'
            : 'Reach out to learn more about the projects we can handle for you.';
    }

    $names = array_column($services, 'name');
    if ($language === 'es') {
        $list = implode(', ', $names);
        return "Principales soluciones: $list. Nuestro equipo combina experiencia técnica y atención al detalle para cada etapa del proyecto.";
    }

    $list = implode(', ', $names);
    return "Key solutions include: $list. Our crew combines technical expertise and attention to detail through every stage of the project.";
}

function shortenText(string $text, int $limit = 280): string
{
    $normalized = trim(preg_replace('/\s+/', ' ', strip_tags($text)) ?? '');
    if (mb_strlen($normalized, 'UTF-8') <= $limit) {
        return $normalized;
    }

    return rtrim(mb_substr($normalized, 0, $limit - 1, 'UTF-8')) . '…';
}

function detectLanguage(string $text, array $dictionary): ?string
{
    $text = mb_strtolower($text, 'UTF-8');
    $scores = ['es' => 0, 'en' => 0];

    foreach ($dictionary['language_hints'] as $lang => $terms) {
        foreach ($terms as $term) {
            if ($term === '') {
                continue;
            }
            if (mb_strpos($text, mb_strtolower($term, 'UTF-8')) !== false) {
                $scores[$lang] += 2;
            }
        }
    }

    $accentPattern = '/[áéíóúñ¿¡]/u';
    if (preg_match($accentPattern, $text)) {
        $scores['es'] += 2;
    }

    if (preg_match('/[a-z]/i', $text)) {
        $scores['en'] += 1;
    }

    arsort($scores);
    $best = array_key_first($scores);
    if ($scores[$best] === 0) {
        return null;
    }

    return $best;
}

function normalizeMessage(string $message, array $dictionary, string $language): string
{
    $normalized = mb_strtolower($message, 'UTF-8');

    foreach ($dictionary['synonyms'] as $canonical => $group) {
        foreach ($group as $synonym) {
            $synonym = mb_strtolower($synonym, 'UTF-8');
            if ($synonym !== '' && mb_strpos($normalized, $synonym) !== false) {
                $translation = $dictionary['translations'][$canonical][$language] ?? $canonical;
                $normalized .= ' ' . $translation . ' ' . $canonical;
                break;
            }
        }
    }

    return $normalized;
}

function findBestAnswer(string $message, array $faqData, string $language): ?string
{
    $bestScore = 0;
    $bestAnswer = null;

    foreach ($faqData as $entry) {
        if (!isset($entry['question'][$language], $entry['answer'][$language])) {
            continue;
        }

        $question = mb_strtolower($entry['question'][$language], 'UTF-8');
        $answer = $entry['answer'][$language];
        $tags = $entry['tags'][$language] ?? [];

        $score = calculateSimilarityScore($message, $question, $tags);

        if ($score > $bestScore) {
            $bestScore = $score;
            $bestAnswer = $answer;
        }
    }

    if ($bestScore < 28) {
        return null;
    }

    return $bestAnswer;
}

function calculateSimilarityScore(string $message, string $question, array $tags): float
{
    similar_text($message, $question, $similarity);
    $similarityScore = (float) $similarity;

    $levenshteinScore = 0;
    $distance = levenshtein($message, $question);
    if ($distance > 0) {
        $levenshteinScore = max(0, 100 - ($distance / max(strlen($message), strlen($question))) * 100);
    } else {
        $levenshteinScore = 100;
    }

    $tagScore = 0;
    foreach ($tags as $tag) {
        $tag = mb_strtolower($tag, 'UTF-8');
        if ($tag !== '' && mb_strpos($message, $tag) !== false) {
            $tagScore += 12;
        }
    }

    return ($similarityScore * 0.5) + ($levenshteinScore * 0.3) + $tagScore;
}

function getFallbackAnswer(string $language): string
{
    if ($language === 'en') {
        return 'I did not find an exact answer, but I can connect you with a specialist. Would you like us to call you soon?';
    }

    return 'No encontré una respuesta exacta, pero puedo conectarte con un especialista. ¿Deseas que te llamemos pronto?';
}

function getGreeting(string $language, string $name): string
{
    if ($language === 'en') {
        return "Hi $name! I am the virtual assistant of ALCAR All Services Corp. How can I help you today?";
    }

    return "¡Hola $name! Soy el asistente virtual de ALCAR All Services Corp. ¿En qué puedo ayudarte hoy?";
}

function buildSuggestions(array $faqData, string $language): array
{
    $suggestions = [];
    foreach ($faqData as $entry) {
        if (!isset($entry['question'][$language])) {
            continue;
        }
        $suggestions[] = $entry['question'][$language];
        if (count($suggestions) >= 4) {
            break;
        }
    }
    return $suggestions;
}

function appendToHistory(string $role, string $message, string $language): void
{
    if (!isset($_SESSION['chat_history']) || !is_array($_SESSION['chat_history'])) {
        $_SESSION['chat_history'] = [];
    }

    $_SESSION['chat_history'][] = [
        'role' => $role,
        'message' => $message,
        'language' => $language,
        'timestamp' => date('c'),
    ];
}

function personalizeAnswer(string $answer, string $name, string $language): string
{
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');

    if ($language === 'en') {
        return "{$answer} Let me know if you need anything else, $name.";
    }

    return "{$answer} Avísame si necesitas algo más, $name.";
}
