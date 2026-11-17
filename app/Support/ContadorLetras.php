<?php

namespace App\Support;

class ContadorLetras
{
    public static function contar(string $texto): array
    {
        $texto = mb_strtoupper($texto, 'UTF-8');

        return self::contarDesde(
            $texto,
            0,
            mb_strlen($texto, 'UTF-8'),
            []
        );
    }

    private static function contarDesde(
        string $texto,
        int $posicion,
        int $longitud,
        array $conteo
    ): array {
        // Caso base: ya recorrimos todo el texto.
        if ($posicion >= $longitud) {
            return $conteo;
        }

        $letra = mb_substr($texto, $posicion, 1, 'UTF-8');

        if (preg_match('/^\p{L}$/u', $letra) === 1) {
            $conteo[$letra] = ($conteo[$letra] ?? 0) + 1;
        }

        return self::contarDesde($texto, $posicion + 1, $longitud, $conteo);
    }
}