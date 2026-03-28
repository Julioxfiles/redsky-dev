
## Qué es el patrón Decorator

El **Decorator (Decorador)** es un patrón estructural que permite **agregar funcionalidades a un objeto de manera dinámica**, sin modificar su clase original.

En lugar de heredar y crear muchas variantes, el patrón envuelve el objeto dentro de otros objetos que añaden comportamiento.

Importante: la funcionalidad no se crea en tiempo de ejecucion. la funcionalidad ya existe (la programaste antes). Pero decides aplicarla o no en tiempo de ejecución. Como cuando decides si agregas leche o azucar al cafe en un restaurante. Las cosas ya estan alli antes de que el restaurante abra. Cuando abre tu decides como combinarlas.

---

## Idea clave

En lugar de hacer esto:

* `EmailNotifier`
* `EmailNotifierWithSMS`
* `EmailNotifierWithSlack`
* `EmailNotifierWithSMSAndSlack`

Con Decorator haces esto:

* Tomas un objeto base
* Lo envuelves con decoradores según necesites
* Combinas comportamientos en tiempo de ejecución

## Regla del patrón Decorator
Clase original → no se modifica

Decoradores existentes → no se modifican

Nuevo comportamiento → se crea un nuevo decorador

---
## Cuándo usarlo

* Cuando necesitas agregar comportamiento sin modificar clases existentes
* Cuando quieres evitar una explosión de clases por herencia
* Cuando necesitas combinar funcionalidades dinámicamente
* Cuando quieres seguir el principio Open/Closed

---

## Ventajas

* Extensión dinámica del comportamiento
* Evita modificar código existente
* Permite combinaciones flexibles
* Sigue principios SOLID

---

## Desventajas

* Puede generar muchas clases pequeñas
* Puede ser más difícil de depurar
* El flujo puede volverse menos claro si hay muchos decoradores

---

## Diferencia con otros patrones

Adapter
Cambia la interfaz de un objeto para hacerlo compatible con otro sistema.

Decorator
Mantiene la interfaz pero agrega comportamiento adicional.

Facade
Simplifica el acceso a un sistema complejo con una interfaz más simple.

---

## Estructura del patrón

![Image](https://images.openai.com/static-rsc-4/crZYyUds7TxQ4FOK-dr4xEEI9Z4uXnHB4aOYOapL9nMecYNT2nKlsHzah_AmGwTZ0rerUcsNkHceQX39CUKDxMzKP25W58T_R75bZ00mhKiPqwlIU5OqS_UKN7gyjhakseyhYbVE03K4wukZ5uNunqJaz4pBmHZXz-Bc0jXrGF8PKfScMeCBCqakKrEG2GKu?purpose=fullsize)

### Componentes

1. Component
   Es la interfaz común que define el comportamiento base.

2. ConcreteComponent
   Es la implementación real del objeto base.

3. Decorator
   Clase abstracta que implementa la misma interfaz y contiene una referencia al componente.

4. ConcreteDecorator
   Clases que agregan comportamiento adicional.

---

## Ejemplo en PHP

### Interfaz base

```php
interface Notifier {
    public function send(string $message): void;
}
```

### Implementación base

```php
class EmailNotifier implements Notifier {
    public function send(string $message): void {
        echo "Enviando Email: $message\n";
    }
}
```

### Decorador base

```php
abstract class NotifierDecorator implements Notifier {
    protected Notifier $wrappee;

    public function __construct(Notifier $notifier) {
        $this->wrappee = $notifier;
    }

    public function send(string $message): void {
        $this->wrappee->send($message);
    }
}
```

### Decoradores concretos

```php
class SMSDecorator extends NotifierDecorator {
    public function send(string $message): void {
        parent::send($message);
        echo "Enviando SMS: $message\n";
    }
}

class SlackDecorator extends NotifierDecorator {
    public function send(string $message): void {
        parent::send($message);
        echo "Enviando Slack: $message\n";
    }
}
```

---

## Uso

```php
$notifier = new EmailNotifier();

$notifier = new SMSDecorator($notifier);
$notifier = new SlackDecorator($notifier);

$notifier->send("Hola mundo");
```

---

## Resultado

```
Enviando Email: Hola mundo
Enviando SMS: Hola mundo
Enviando Slack: Hola mundo
```

---

## Cómo funciona internamente

Cada decorador:

* Recibe un objeto que implementa la misma interfaz
* Ejecuta primero el comportamiento original (opcional)
* Agrega comportamiento extra antes o después

Se forma una cadena de llamadas:

```
SlackDecorator
  → SMSDecorator
      → EmailNotifier
```

---

## Ejemplo conceptual aplicado a backend

En tu contexto (APIs y frameworks), Decorator se usa mucho en:

* Middlewares (como en Laravel)
* Logging
* Caching
* Autenticación
* Validaciones

Ejemplo mental:

```
Request
 → AuthDecorator
   → LoggingDecorator
     → Controller
```

---

## Siguiente paso recomendado

Después de dominar Decorator, lo más lógico es continuar con:

* Facade (para simplificar subsistemas)
* Proxy (control de acceso y lazy loading)
* Composite (estructuras jerárquicas)

---
