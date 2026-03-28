
## Qué es el patrón Proxy (Representante)

El **Proxy** es un patrón estructural que proporciona un **sustituto o intermediario de otro objeto**, controlando el acceso a este.

En lugar de interactuar directamente con el objeto real, el cliente interactúa con un proxy que decide **cómo y cuándo** delegar la solicitud.

---

## Idea clave

En lugar de hacer esto:

```php
$video = new Video("movie.mp4");
$video->play();
```

Con Proxy haces esto:

```php
$video = new VideoProxy("movie.mp4");
$video->play();
```

El proxy puede:

* Retrasar la carga (lazy loading)
* Controlar acceso (autenticación)
* Agregar logging o caching

---

## Estructura del patrón

![Image](https://images.openai.com/static-rsc-4/VTugo5RiO_h2anyo-hTbw4DawBpLAeRyo10-8L3g3nOfRZlHwVcYcFEDR5zIXxGkhVO6eeXFr9f0JaDailf7DAvsvlhmiaXhgZhZ_2VBsNcbtN93G2coFLACXSbm0ew8QiA_VBPOqbRKuDSCumRTVEMn4iBcu3c7WXF2TOP0c40tD1DNUWIwae7X-HAkwKUM?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/IygDrjPDwCjZ054rZJHJFg5nXBxtp4AlYPdNP9B7CsXhjYFUqyyQiqI1L66-ymILF8_g6MkbPl4OGY-yZDVuCMJWlm8VlSTgxmanDHc9l91k9-rYzUTLU1tUUFXX7lIToLEY7iBR8bmV5K6kgjiF7l7nfXn1ft4J4UDt4wxvCc0QtmNIhl_6eIqFBkeEV8Kg?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/CEcK0DiIZB7X6WpVM2nKNHacBGHSW1I14iC99nbfKFGO7x8f7mm-RxkvqBwOOzQiFbYMzYvjxunbIXgbaz26Y_Xh20obo4NVc4qz3oYT_RLPBl26-BXpPSpRwTl7bXa1SXc6umQM_wnwZIaAFybbpiK2-fo9tJDz9r06OKFy62KO0IXTNzKTuLAoaxSzFmjr?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/1HasPc7Rb87yWeif2iaTN2ydUlTQxBGSwTp0HOTfGyKNru0u5IQsOBL59FazHA5ouqx1c860vK1T35aLhZbNc6VMTGOd1owSFlV_9AV56CMB5ERaAPudzg763whW9LXgbAEq3hUbN23t0qa7IKlaa-yiRVCfR1YEg8Gx0RhdvN-EGS5LsM-8yJF-3xMU5rZs?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/qtdYnPYDejpoDHEQgXMIaM_zUNzwOj-2rcZmOWOhYkoe3e95wZJsFyLNTODv6gHtxfJcZtK9V5M7daY8ye00KvLtvMB0Z-Tx84_JBk7rX3hGiJW5SrLt-31hkSQvc0q1Ptz3j1HPxpK9fX5rc-AJctEA2fZGBsogCfPrAP7Kru9y91m3mo0yUA8ohxzZNQr3?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/PUG35sIJ9Q0cbu8lyogRJm4f68TbCCbgQbMa-61CaUm1HPI7VfZ_geZZ8m5FcJweVnx4dq8dU9mWJl70pmaNpyZ1_8bq2hs2hw5l8J9iw8mpJ9X4FUsOJPQkCL2E_bu-B_u6v0ogQ12ZFSV6RA8QdYL_dLPSYTcocxxaFbmX0rrXVSQgg5EeKmqeEG6I4Ut4?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/WPM0P4cpISpO5FzhBM7B7YEOKlaAzqk3dy9oregMRiI8HeFcqv2y_XgQdCphXJ5bjL1wItuDwz_TYBrcNHV8v20f0dTTkYUa3W9eSLUrLX0ZKopTTTXui9J-ic-EzGcQYXYUhE5J2VzCC0nOYsAELKmoQMcBmwXQWIHwxbuKgsGv90GzNk-5ZnsTZsY4RiWj?purpose=fullsize)

### Componentes

1. Subject
   Interfaz común para el objeto real y el proxy.

2. RealSubject
   El objeto real que realiza el trabajo.

3. Proxy
   Controla el acceso al objeto real y puede agregar comportamiento adicional.

4. Client
   Usa el proxy como si fuera el objeto real.

---

## Ejemplo en PHP

Simularemos un objeto pesado (como cargar un video).

---

### Interfaz (Subject)

```php
interface Video {
    public function play(): void;
}
```

---

### Objeto real

```php
class RealVideo implements Video {
    protected string $filename;

    public function __construct(string $filename) {
        $this->filename = $filename;
        $this->loadFromDisk();
    }

    protected function loadFromDisk(): void {
        echo "Cargando video desde disco: {$this->filename}\n";
    }

    public function play(): void {
        echo "Reproduciendo video: {$this->filename}\n";
    }
}
```

---

### Proxy

```php
class VideoProxy implements Video {
    protected ?RealVideo $realVideo = null;
    protected string $filename;

    public function __construct(string $filename) {
        $this->filename = $filename;
    }

    public function play(): void {
        if ($this->realVideo === null) {
            $this->realVideo = new RealVideo($this->filename);
        }

        $this->realVideo->play();
    }
}
```

---

## Uso

```php
$video = new VideoProxy("movie.mp4");

// No carga todavía
$video->play(); // Carga y reproduce
$video->play(); // Solo reproduce (ya está cargado)
```

---

## Resultado

```
Cargando video desde disco: movie.mp4
Reproduciendo video: movie.mp4
Reproduciendo video: movie.mp4
```

---

## Cómo funciona internamente

El proxy:

* Mantiene una referencia al objeto real
* Controla cuándo crearlo o acceder a él
* Delega las llamadas cuando es necesario

Flujo:

```
Cliente
 → Proxy
     → RealVideo (solo si es necesario)
```

---

## Cuándo usarlo

* Cuando la creación del objeto es costosa (lazy loading)
* Cuando necesitas control de acceso (auth, permisos)
* Cuando quieres agregar logging o caching
* Cuando trabajas con objetos remotos (APIs)

---

## Ventajas

* Mejora el rendimiento (carga diferida)
* Controla el acceso
* Transparente para el cliente
* Permite agregar lógica transversal (logging, caching)

---

## Desventajas

* Añade una capa extra de abstracción
* Puede aumentar la complejidad
* Puede introducir un pequeño overhead

---

## Diferencia con otros patrones

Adapter
Cambia la interfaz.

Decorator
Agrega comportamiento dinámicamente.

Facade
Simplifica el acceso.

Proxy
Controla el acceso a un objeto.

---

## Ejemplo conceptual aplicado a backend

En tu contexto (APIs y frameworks como **redsky-mvc-api**), Proxy es muy común en:

* Guards de autenticación
* Capas de cache
* Lazy loading de base de datos
* Clientes HTTP

Modelo mental:

```
Controller
 → UserRepositoryProxy
     → RealUserRepository
         → Database
```

Ejemplo:

```php
$user = $userRepository->find(1);
```

El proxy puede:

* Revisar cache primero
* Validar permisos
* Luego llamar al repositorio real

---

## Ejemplo más realista (Proxy de control de acceso)

```php
class UserService {
    public function deleteUser(int $id): void {
        echo "Usuario $id eliminado\n";
    }
}

class UserServiceProxy {
    protected UserService $service;

    public function __construct(UserService $service) {
        $this->service = $service;
    }

    public function deleteUser(int $id, string $role): void {
        if ($role !== 'admin') {
            echo "Acceso denegado\n";
            return;
        }

        $this->service->deleteUser($id);
    }
}
```

Uso:

```php
$service = new UserService();
$proxy = new UserServiceProxy($service);

$proxy->deleteUser(1, 'guest'); // denegado
$proxy->deleteUser(1, 'admin'); // permitido
```

---

## Siguiente paso recomendado

Después de Proxy, te recomiendo continuar con:

* Composite (estructuras tipo árbol)
* Bridge (separar abstracción de implementación)

---

Si quieres, en el siguiente paso podemos llevar esto a algo real en tu proyecto:

* Un **Cache Proxy para tu QueryBuilder**
* Un **Auth Proxy para tus controllers**
* Un **Proxy para llamadas HTTP (API externa)**

Ahí es donde este patrón realmente se vuelve poderoso en arquitectura real.
