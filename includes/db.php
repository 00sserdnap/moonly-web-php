<?php
/* =============================================
   MOONLY — CONEXIÓN A BASE DE DATOS (PDO)
   Edita estas 4 constantes con tus credenciales
   reales del hosting (cPanel / MySQL).
   ============================================= */

define('DB_HOST', 'localhost');
define('DB_NAME', 'moonly_db');
define('DB_USER', 'moonly_user');
define('DB_PASS', 'CAMBIA_ESTA_CLAVE');

function getDb() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            error_log('DB connection error: ' . $e->getMessage());
            die('Error de conexión. Intenta más tarde.');
        }
    }
    return $pdo;
}