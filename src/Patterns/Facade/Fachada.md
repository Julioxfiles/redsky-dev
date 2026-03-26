
## Qué es el patrón Facade (Fachada)

El **Facade (Fachada)** es un patrón estructural que proporciona una **interfaz simple y unificada** para acceder a un sistema complejo de clases.

En lugar de interactuar directamente con múltiples clases, el cliente interactúa con una sola clase: la fachada.

---

## Idea clave

En lugar de hacer esto:

```php
$auth = new AuthService();
$db = new Database();
$logger = new Logger();

$auth->checkUser();
$db->connect();
$logger->log("Usuario autenticado");
```

Con Facade haces esto:

```php
$system = new SystemFacade();
$system->login();
```

La complejidad queda oculta detrás de la fachada.

---

## Estructura del patrón

![Image](https://images.openai.com/static-rsc-4/HT3KHp9tJcu0_bPDDG-9CojtNgfl4SokWf8rrAUQEa6GUQ4phONBHUfqdEBrzMrWZ3WXJzT1HIMZ4pfpqFW2vGvpbNpU4RSDvZFo4uRiC5WYxKSjmssRKML3uxqqh2c41LufZZOlm9vN-mEZxfsS3Dw30b0kRpWe2oJqdqp54qhz8_P5nxbiIipqXwXJScwt?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/7fOUyFcGMDK_1xlbyHittuE6P1b-zOHPP_rOoov5qMrdF6HiAsdMfeNOZeMJgSmizBKSctXiMR1ngLdMyspMvMt7SbE1NSSd_fkLkNLHJ3-41foJk1tDwTM9FnuiRcyAGs7r54QSplftT-vFTVZNwwAzwkC7V1_-_45v1AMlkR-9qQ074DC_yylFUXiBEGd0?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/GK-_21oeOa7_kgJInt7SBLKktnNT4mj6uxkssl5lxYkq1DDdvq-weepRh2dw0Z37ziuD9eCDxvYU8uhShfvaL_VifvGuT2za5yWEguEI37jziUVxw8TMzIlJQAaKP3CLcifzxX46xaiHBLi74RZzzSaXRt7iVYOyF8UtfxrhrfXbxhyXNX-VeTfEa_AyzdPq?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/EfdA0HieBYbDLriuG_TbA1Ua8asn-QUxHYFq_5NW7wBk6918PlbhEvD6evL3vWbHlk1K_446aLic-XYsetHk1YOhd-afqT7nLTKapKTOCD6whdjtlSNRvDmjxV891KJwTYj4MmekeWgTHBVZGh3BFJMQaeecNM4vo9IAdPa2stULRhSCMg_i3Hsv0OmbvBOy?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/gmpvyhwTmRHpsoXvxOORenisK6xf4nsW9_VGzHFh7AX7s-CZm8OypavYiIvExgKExDKxXZmI4taEZ_Xh8GeOz54kMHG1cK-3RE5Js9S7CybX4VWxtrlMlg8kStkGj9c7pI7_4ZPPLr8gF0sKteRid6lDINX401rSI1-bc2KMP1vz3T_Z1zuw6hq7O_3Z7ZYt?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/GtNdiFeGNg4rTlRkJLhb5EJ5V4CYQWXuU6Pv7fJfs_1K4K_8Y96X8VB62dyQAS4IFPed3RLXyWWzM-sTY2HhCFzV-GCpc5uIHwBdIt_1PdFgZbzxhu1hsWU_7xy4X0UGQ3rU-T_y88h7p56hZmnP_ZdYqIQQylsIvGoLTG2Eu9p6dtuseWfQjO_qwha6KHTm?purpose=fullsize)

### Componentes

1. Facade
   Clase que expone métodos simples para el cliente.

2. Subsystems
   Clases internas que realizan el trabajo real.

3. Client
   Usa la fachada en lugar de interactuar directamente con el sistema complejo.

---

## Ejemplo en PHP

Vamos a simular un sistema de login con varias clases internas.

---

### Subsistemas (clases reales)

```php
class AuthService {
    public function authenticate(string $user, string $password): bool {
        echo "Autenticando usuario...\n";
        return true;
    }
}

class Database {
    public function connect(): void {
        echo "Conectando a la base de datos...\n";
    }
}

class Logger {
    public function log(string $message): void {
        echo "Log: $message\n";
    }
}
```

---

### Facade

```php
class LoginFacade {
    protected AuthService $auth;
    protected Database $db;
    protected Logger $logger;

    public function __construct() {
        $this->auth = new AuthService();
        $this->db = new Database();
        $this->logger = new Logger();
    }

    public function login(string $user, string $password): void {
        $this->db->connect();

        if ($this->auth->authenticate($user, $password)) {
            $this->logger->log("Usuario autenticado correctamente");
            echo "Login exitoso\n";
        } else {
            $this->logger->log("Error de autenticación");
            echo "Login fallido\n";
        }
    }
}
```

---

## Uso

```php
$facade = new LoginFacade();
$facade->login("admin", "1234");
```

---

## Resultado

```
Conectando a la base de datos...
Autenticando usuario...
Log: Usuario autenticado correctamente
Login exitoso
```

---

## Cómo funciona internamente

La fachada:

* Crea y coordina múltiples objetos del sistema
* Define un flujo de ejecución
* Oculta la complejidad al cliente

Flujo interno:

```
LoginFacade
  → Database
  → AuthService
  → Logger
```

El cliente solo ve:

```
LoginFacade → login()
```

---

## Cuándo usarlo

* Cuando tienes un sistema complejo con muchas clases
* Cuando quieres simplificar el uso de una API interna
* Cuando quieres desacoplar el cliente del sistema
* Cuando necesitas definir un punto de entrada claro

---

## Ventajas

* Simplifica el uso del sistema
* Reduce acoplamiento
* Mejora la legibilidad del código
* Centraliza la lógica de orquestación

---

## Desventajas

* Puede convertirse en una “God Class” si crece demasiado
* Puede ocultar demasiada lógica (debug más difícil)
* No elimina la complejidad, solo la encapsula

---

## Diferencia con otros patrones

Adapter
Convierte una interfaz en otra compatible.

Decorator
Agrega comportamiento dinámicamente.

Facade
Oculta la complejidad y simplifica el acceso.

---

## Ejemplo conceptual aplicado a backend

En tu contexto (APIs y frameworks como tu **redsky-mvc-api**), Facade aparece en:

* Servicios de autenticación
* Sistemas de cache
* Acceso a base de datos
* Librerías internas

Ejemplo mental:

```
Controller
  → AuthFacade
       → JWTService
       → UserRepository
       → Validator
```

El controller solo hace:

```php
$auth->login($request);
```

---

## Ejemplo más realista (tipo Laravel)

```php
class Cache {
    public static function get(string $key) {
        echo "Obteniendo valor de cache: $key\n";
    }

    public static function put(string $key, $value) {
        echo "Guardando en cache: $key\n";
    }
}
```

Uso:

```php
Cache::put("user_1", "Juan");
Cache::get("user_1");
```

Aquí `Cache` actúa como una fachada simplificada.

---

## Siguiente paso recomendado

Después de Facade, te recomiendo continuar con:

* Proxy (control de acceso, lazy loading)
* Composite (estructuras tipo árbol)
* Bridge (separar abstracción de implementación)

---

Si quieres, en el siguiente paso lo llevamos a tu proyecto y creamos algo potente:

* Un **AuthFacade real con JWT**
* Un **Database Facade tipo Laravel DB**
* O incluso tu propio sistema de **Facades estáticas estilo Laravel**


