# M.07 - UF4 - Zodiac

## Descripción
Proyecto Laravel que importa los horóscopos de la API **[https://www.astrology-zodiac-signs.com](https://www.astrology-zodiac-signs.com)** y cada 5 minutos se traducen 15 predicciones.

Como traductor se utiliza GoogleTranslate.

Los horóscopos se traducen en tres idiomas:
- Castellano (es)
- Catalán (ca)
- Inglés (en)


Además, incorpora una API para poder hacer peticiones y conseguir así un horoscopo con una traducción en concreto.

> NOTA: Si la traducción no está lista se queda `NULL` por lo que se mostrará el texto que tenga el horoscopo de referencia.

## API

### Devolver un horóscopo
La URL donde hacer la petición será:
```
http://localhost:8000/api/{codigo_idioma}/{tiempo}/{signo}
```

**Parámetros:**
- `{codigo_idioma}`: El código del idioma del que se quiera conseguir la traducción del horóscopo. 

    **Valores permitidos:**
    - _es_ (Castellano)
    - _ca_ (Catalán)
    - _en_ (Inglés)


- `{tiempo}`: Texto que indica que tipo de dia/semana/mes de horóscopo se quiere conseguir.

    **Valores permitidos:**
    - _yesterday_ (Ayer)
    - _today_ (Hoy)
    - _week_ (Semana)
    - _month_ (Mes)

- `{signo}`: Signo del zodiaco.

    **Valores permitidos:**
    - _aquarius_
    - _pisces_
    - _aries_
    - _taurus_
    - _gemini_
    - _cancer_
    - _leo_
    - _virgo_
    - _libra_
    - _scorpio_
    - _sagittarius_
    - _capricorn_

**Ejemplo:**

**URL de consulta**
```
http://localhost:8000/api/en/today/aquarius
```

**Respuesta**
```json
{
    "code":200,
    "response": "Saturday 04\/20\/2024\r\nYou don\u2019t like the       situation that is behind you, with leftover emotions still disturbing your peace. You won\u2019t move on as easily as you\u2019d like to, but you have enough time on your hands to handle things properly and with an open heart. \r\n\nYou are in the process of healing and you could use some time on your own, to contemplate on progress you\u2019ve made so far and on everything that has been done well along the way.\r\n\n"
}
```

## Implementación

### 1. Clonar el proyecto
```bash
git clone https://github.com/CristianManuelAlcobendasBeorlegui/zodiac
```

### 2. Crea una copia del archivo '.env.example' llamada '.env'
```bash
cp .env.example .env
```

### 3. Descargar e instalar dependencias
```bash
composer update
composer install
```

### 4. Ejecutar las migraciones y los seeders
```bash
php artisan migrate:refresh --seed
```

### 5. Ejecutar las tareas programadas
```bash
php artisan schedule:run
```

> **NOTA:** Las tareas programadas son las que se encargan de importar, añadir y traducir los horóscopos a la base de datos.

## Librerias extra
- Laravel API
- [Stichoza/google-translate-php](https://github.com/Stichoza/google-translate-php)
