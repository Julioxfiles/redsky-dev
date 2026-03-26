## Interface First Definition:

In PHP OOP, an interface is a way to define a **contract** that classes must follow.

### ✅ Definition:

👉 **An interface in PHP is a structure that declares a set of methods that a class must implement, without providing the actual implementation.**

---

### 📌 Key ideas:

* It only contains **method signatures** (no logic).
* Any class that **implements** the interface is forced to define those methods.
* It helps enforce **consistency and abstraction** across different classes.

---

### 💡 Example:

```php
interface PaymentMethod
{
    public function pay(float $amount): bool;
}

class CreditCard implements PaymentMethod
{
    public function pay(float $amount): bool
    {
        // logic here
        return true;
    }
}
```

---

### 🧠 Simple explanation:

👉 **An interface defines *what* a class must do, but not *how* it does it.**

---
En inglés, cuando no te refieres a la palabra clave `interface`, sino al **concepto general**, se usa así:

### ✅ Definición (conceptual):

👉 **“The interface of a class refers to the set of public methods it exposes to the outside world.”**

---

### 🧠 Explicación simple:

👉 **It is how other objects interact with the class.**

No es una `interface` como estructura, sino **la “cara pública” de la clase**.

---

### 💡 Ejemplo en PHP OOP:

```php
class UserService
{
    public function createUser(string $name): void
    {
        // logic
    }

    public function deleteUser(int $id): void
    {
        // logic
    }

    private function logAction(string $message): void
    {
        // internal logic
    }
}
```

---

### 🔍 ¿Cuál es la “interface” aquí?

👉 **The interface of this class consists of:**

* `createUser()`
* `deleteUser()`

❌ `logAction()` no forma parte de la interface porque es **private**.

---

### 📌 Forma corta para documentar:

👉 **“The class interface is defined by its public methods.”**

---

Si quieres, en el siguiente paso podemos conectar esto con:

* encapsulation
* API design
* clean architecture

Ahí este concepto se vuelve clave 👌
