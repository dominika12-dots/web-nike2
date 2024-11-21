<?php
// Paso 1: Configura tus credenciales de Supabase
$SUPABASE_URL = "https://grwajsadxvkmmzywdyrt.supabase.co";
$SUPABASE_API_KEY = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Imdyd2Fqc2FkeHZrbW16eXdkeXJ0Iiwicm9sZSI6InNlcnZpY2Vfcm9sZSIsImlhdCI6MTczMjE4MTQwNiwiZXhwIjoyMDQ3NzU3NDA2fQ.q2v-snfwX8bx9G5rGKRo_fdgeIFWv688-_gqH7CdEMI";

// Paso 2: Obtener los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nom'];
    $apellido = $_POST['ape'];
    $correo = $_POST['cor'];
    $telefono = $_POST['tel'];

    // Paso 3: Crear un array con los datos a insertar
    $data = array(
        "nom" => $nombre,
        "ape" => $apellido,
        "cor" => $correo,
        "tel" => $telefono
    );

    // Paso 4: Convertir el array en formato JSON
    $json_data = json_encode($data);

    // Paso 5: Configurar la solicitud cURL para insertar los datos en Supabase
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $SUPABASE_URL . "/rest/v1/usuarios"); // Asegúrate de tener la tabla 'usuarios' en tu base de datos de Supabase
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer " . $SUPABASE_API_KEY,
        "Content-Type: application/json",
        "Prefer: return=representation"
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

    // Paso 6: Ejecutar la solicitud cURL y obtener la respuesta
    $response = curl_exec($ch);
    curl_close($ch);

    // Paso 7: Verificar si la inserción fue exitosa
    if ($response) {
        echo "Usuario registrado correctamente.";
    } else {
        echo "Error al registrar el usuario.";
    }
}
?>

