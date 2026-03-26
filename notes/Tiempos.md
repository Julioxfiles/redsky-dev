
## ⏱️ 1. Tiempo de ejecución (Runtime)

Es donde trabaja el **Decorator**.

* El programa ya está corriendo
* Puedes cambiar comportamiento dinámicamente
* Ejemplo:

```php
$coffee = new SugarDecorator(new SimpleCoffee());
```

👉 Decides en ese momento qué combinar

---

## 🏗️ 2. Tiempo de compilación (Compile-time)

Aquí el comportamiento se define **antes de ejecutar el programa**.

* El código ya queda “fijo”
* No puedes cambiarlo dinámicamente sin recompilar

### Ejemplo típico:

Herencia

```php
class MilkCoffee extends Coffee {
    public function cost() {
        return parent::cost() + 2;
    }
}
```

👉 Ya está decidido desde el código, no en runtime

---

## ⚙️ 3. Tiempo de construcción / inicialización (Build / Bootstrap time)

Sucede cuando:

* Configuras el sistema
* Registras dependencias
* Preparas el entorno antes de ejecutar lógica real

### Ejemplo:

```php
$container->bind(Coffee::class, SimpleCoffee::class);
```

👉 Aquí decides qué implementación usar, pero antes del runtime real

---

## 🔄 4. Tiempo de configuración (Configuration time)

Muy común en frameworks modernos.

* Se define comportamiento mediante archivos o setup
* No cambias código, cambias configuración

### Ejemplo:

```php
return [
    'cache' => true,
    'logging' => false,
];
```

---

## 🧠 Comparación clara

| Tiempo          | Cuándo ocurre      | Flexibilidad | Ejemplo típico         |
| --------------- | ------------------ | ------------ | ---------------------- |
| Runtime         | Durante ejecución  | Alta         | Decorator, Strategy    |
| Compile-time    | Antes de ejecutar  | Baja         | Herencia, clases fijas |
| Build/Bootstrap | Al iniciar la app  | Media        | DI Container, bindings |
| Configuración   | Antes o al iniciar | Media        | Archivos config/env    |

---

## 🔥 Relación con patrones

* **Runtime (dinámicos)**

  * Decorator
  * Strategy
  * State

* **Compile-time (estáticos)**

  * Herencia clásica
  * Template Method (en parte)

* **Bootstrap / configuración**

  * Dependency Injection
  * Service Container
  * Factory

---

## 🧩 Idea clave

Mientras más te mueves hacia runtime:

* Más flexible es el sistema
* Más complejo puede volverse

Mientras más te mueves hacia compile-time:

* Más simple y rápido
* Menos flexible

---

## 🧠 Forma simple de verlo

* Compile-time → “Esto será así siempre”
* Runtime → “Decido en el momento”
* Config → “Lo defino sin tocar código”

---
