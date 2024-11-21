const fetch = require("node-fetch");

module.exports = async (req, res) => {
  if (req.method === "POST") {
    const { nom, ape, cor, tel } = req.body;

    if (!nom || !ape || !cor || !tel) {
      res.status(400).json({ error: "Todos los campos son obligatorios." });
      return;
    }

    const supabaseUrl = process.env.SUPABASE_URL;
    const supabaseKey = process.env.SUPABASE_ANON_KEY;

    const data = {
      nombre: nom,
      apellido: ape,
      correo: cor,
      telefono: tel,
    };

    try {
      const response = await fetch(`${supabaseUrl}/rest/v1/usuarios`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${supabaseKey}`,
          Prefer: "return=representation",
        },
        body: JSON.stringify(data),
      });

      if (response.ok) {
        const result = await response.json();
        res.status(201).json({ message: "Usuario registrado correctamente", result });
      } else {
        const error = await response.text();
        res.status(500).json({ error: `Error en la base de datos: ${error}` });
      }
    } catch (err) {
      res.status(500).json({ error: `Error del servidor: ${err.message}` });
    }
  } else {
    res.status(405).json({ error: "Método no permitido" });
  }
};
