<?php
// Paso 1: Configura tus credenciales de Supabase
$supabase_url = getenv("https://grwajsadxvkmmzywdyrt.supabase.co");
$supabase_api_key = getenv("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Imdyd2Fqc2FkeHZrbW16eXdkeXJ0Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzIxODE0MDYsImV4cCI6MjA0Nzc1NzQwNn0.KEhxqVAWiS-KyuW-tdTOOkgu8_1h05EcnSYpzIpLxno");

// Paso 2: Verifica si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nom'] ?? null;
    $apellido = $_POST['ape'] ?? null;
    $correo = $_POST['cor'] ?? null;
    $telefono = $_POST['tel'] ?? null;

    // Validar que los campos no estén vacíos
    if (!$nombre || !$apellido || !$correo || !$telefono) {
        die("Por favor, completa todos los campos.");
    }

    // Paso 3: Configura los datos a enviar
    $data = [
        "nombre" => $nombre,
        "apellido" => $apellido,
        "correo" => $correo,
        "telefono" => $telefono
    ];

    // Paso 4: Enviar los datos a Supabase usando cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $supabase_url . "/rest/v1/usuarios");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer $supabase_api_key",
        "Prefer: return=representation"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_status === 201) {
        echo "Usuario registrado correctamente.";
    } else {
        echo "Error al registrar el usuario. Respuesta: " . $response;
    }
}
?>

