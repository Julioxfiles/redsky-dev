
## Adapter

The **Adapter Pattern** is a structural design pattern in PHP OOP that acts as a bridge between two incompatible interfaces. In simple terms, it allows classes that normally couldn’t work together to collaborate by converting one interface into another that a client expects. This is especially useful when you are integrating legacy code, third-party libraries, or external APIs that don’t follow the structure your application is built around. Instead of rewriting existing code (which can be risky and expensive), you create an adapter that “translates” between the two worlds.

Think of it like a power plug adapter when traveling: your device (client code) expects a certain socket (interface), but the wall outlet (existing class) is different. The adapter sits in between and makes them compatible without changing either side. In PHP, this usually means you define a **target interface** that your application uses, and then create an **adapter class** that implements this interface while internally using the incompatible class.

From an architectural perspective, the Adapter Pattern promotes **loose coupling**. Your core application logic depends only on abstractions (interfaces), not on concrete implementations. This aligns very well with principles like **Dependency Inversion** and is extremely useful in layered architectures (which you’ve been studying in your PHP OOP architecture work). It also helps when switching implementations later—for example, replacing one payment gateway with another—because only the adapter changes, not the rest of your system.

---

## 🔧 Example in PHP

Let’s imagine you are building a system that expects a **PaymentProcessor interface**, but you want to use a third-party class called `StripeService` that has a completely different method.

### 1. Target Interface (what your app expects)

```php
<?php
// app/Contracts/PaymentProcessor.php

interface PaymentProcessor
{
    public function pay(float $amount): string;
}
```

---

### 2. Incompatible Class (3rd-party or legacy)

```php
<?php
// external/StripeService.php

class StripeService
{
    public function sendPayment(float $amountInDollars): string
    {
        return "Paid {$amountInDollars} USD using Stripe";
    }
}
```

Notice the problem:

* Method name is different (`sendPayment` vs `pay`)
* Structure is not aligned with your interface

---

### 3. Adapter Class

```php
<?php
// app/Adapters/StripeAdapter.php

class StripeAdapter implements PaymentProcessor
{
    private StripeService $stripe;

    public function __construct(StripeService $stripe)
    {
        $this->stripe = $stripe;
    }

    public function pay(float $amount): string
    {
        // Adapt the call
        return $this->stripe->sendPayment($amount);
    }
}
```

This adapter:

* Implements the interface your app expects
* Internally delegates the call to the incompatible class
* Translates method names and structure

---

### 4. Client Code (your application)

```php
<?php

$stripeService = new StripeService();
$paymentProcessor = new StripeAdapter($stripeService);

echo $paymentProcessor->pay(100);
```

---

## 🧠 What’s happening here?

Your application only knows about `PaymentProcessor`. It doesn’t care whether the implementation is Stripe, PayPal, or something else. The `StripeAdapter` acts as a translator, allowing the `StripeService` to “fit” into your system without modifying it.

---

## 🚀 When should you use Adapter Pattern?

You should use it when:

* You are integrating **third-party libraries**
* You have **legacy code** you cannot modify
* You want to **standardize multiple implementations** under one interface
* You are building systems like your **redsky-api**, where abstraction and decoupling are critical

---

## ⚠️ Important Insight (for your architecture learning)

The Adapter Pattern is often confused with:

* **Facade** → simplifies an interface
* **Decorator** → adds behavior
* **Adapter** → *translates* interface

In your case (working on APIs and clean architecture), adapters are extremely powerful in:

* External services (payment, email, storage)
* Infrastructure layer → adapting external tools to your domain contracts

---

Exacto — lo entendiste muy bien. Cuando se dice **“interfaces incompatibles” en el contexto del Adapter Pattern**, **no se refiere únicamente a interfaces de PHP (`interface`)**, sino a un concepto más general: **formas distintas de comunicarse entre objetos o sistemas**.

En programación orientada a objetos, la palabra *interfaz* tiene dos niveles:

---

### 🔹 1. Interfaz como concepto (lo importante aquí)

Aquí “interfaz” significa:

> **La forma en que un objeto expone su funcionalidad al exterior**
> (es decir: nombres de métodos, parámetros, formato de datos, comportamiento esperado)

Por ejemplo, dos clases pueden ser “incompatibles” si:

* Usan **nombres de métodos diferentes**
* Reciben **parámetros distintos**
* Devuelven **formatos diferentes**
* Esperan **flujos de uso distintos**

👉 Ejemplo conceptual:

* Tu sistema espera:
  `pay($amount)`
* Librería externa tiene:
  `sendPayment($valueInDollars)`

Aunque hacen lo mismo… **no encajan directamente**.

Eso es exactamente lo que significa *interfaces incompatibles*.

---

### 🔹 2. Interfaz como palabra clave en PHP (`interface`)

Aquí sí hablamos de algo técnico:

```php
interface PaymentProcessor {
    public function pay(float $amount);
}
```

Esto es una **herramienta del lenguaje**, pero no es obligatorio para que exista el problema de incompatibilidad.

👉 Puedes tener incompatibilidad incluso sin usar `interface` en PHP.

---

## ⚡ Analogía (la correcta que mencionaste)

Tu ejemplo de los enchufes es perfecto:

* 🔌 Enchufe europeo → forma A
* 🔌 Enchufe americano → forma B

Ambos transmiten electricidad, pero **no son compatibles físicamente**.

El adaptador:

* No cambia el enchufe
* No cambia la pared
* Solo **traduce la conexión**

---

## 🧠 Aplicado a objetos

Piensa en esto:

```php
class OldLogger {
    public function writeLog($msg) {}
}

class NewSystem {
    public function log($message) {}
}
```

Aquí hay incompatibilidad porque:

* `writeLog` ≠ `log`
* Diferente “contrato mental”

👉 El Adapter convierte uno en otro.

---

## 🎯 Conclusión clara

Sí, exactamente como dijiste:

> ✔️ No se refiere solo a `interface` de PHP
> ✔️ Se refiere a **formas distintas de conexión entre objetos o sistemas**
> ✔️ Puede ser métodos, nombres, parámetros o comportamiento

En otras palabras:

> **“Interfaces incompatibles” = maneras diferentes de comunicarse que no encajan directamente**

---

Si quieres, en el siguiente paso puedo conectarlo directamente con tu proyecto **redsky-mvc-api** y mostrarte cómo usar Adapter en:

* servicios externos (JWT, email, storage)
* o incluso entre capas (infraestructura → dominio)

When we say **“structure is not aligned with your interface”**, we mean that the **class does not match the contract (shape) defined by the interface**.

Let’s break it down clearly.

---

## 🔹 1. What is an Interface (the “expected structure”)?

An interface defines **how a class must look** — specifically:

* Method names
* Parameters (type, order)
* Return types

Example:

```php
interface PaymentGateway
{
    public function pay(float $amount): string;
}
```

This means:

👉 Any class that implements this interface **must have**:

* A method named `pay`
* Accepting `float $amount`
* Returning a `string`

---

## 🔹 2. Your StripeService (the “actual structure”)

```php
class StripeService
{
    public function sendPayment(float $amountInDollars): string
    {
        return "Paid {$amountInDollars} USD using Stripe";
    }
}
```

---

## 🔥 3. Where is the mismatch?

Compare both:

| Interface (Expected) | StripeService (Actual) | Problem                             |
| -------------------- | ---------------------- | ----------------------------------- |
| `pay(...)`           | `sendPayment(...)`     | ❌ Different method name             |
| `$amount`            | `$amountInDollars`     | ⚠️ Different naming (less critical) |
| Same return type     | Same return type       | ✅ OK                                |

---

## ❗ So what does “structure not aligned” mean?

It means:

> The class **does not follow the exact method signature defined by the interface**, so it **cannot be used interchangeably**.

In PHP terms:

```php
class StripeService implements PaymentGateway
```

👉 This would FAIL because:

* The method `pay()` is missing
* PHP will throw an error

---

## 🧠 Think of it like a plug 🔌

* Interface = **power outlet shape**
* Class = **plug**

If the plug doesn’t match the outlet:

👉 You **cannot connect them**, even if they do something similar.

---

## 🔹 4. Why is this important?

Because your system might expect:

```php
function processPayment(PaymentGateway $gateway)
{
    return $gateway->pay(100);
}
```

But if you pass:

```php
$gateway = new StripeService();
processPayment($gateway);
```

💥 It breaks, because `StripeService` doesn’t have `pay()`.

---

## 🔹 5. Solution: Align the structure (Adapter Pattern)

You **don’t change StripeService** (3rd-party code).

Instead, you adapt it:

```php
class StripeAdapter implements PaymentGateway
{
    private StripeService $stripe;

    public function __construct(StripeService $stripe)
    {
        $this->stripe = $stripe;
    }

    public function pay(float $amount): string
    {
        return $this->stripe->sendPayment($amount);
    }
}
```

---

## ✅ Final Meaning (simple)

👉 “Structure is not aligned with your interface” means:

> The class does not implement the **same methods, signatures, or contract** required by the interface, so it cannot be used where that interface is expected.

---

If you want, I can connect this directly to your **redsky-mvc-api architecture** and show how adapters fit in a clean service layer (very useful for payment gateways, APIs, etc.).
