
## What is the Decorator Pattern

The **Decorator** is a structural design pattern that allows you to **add functionality to an object dynamically**, without modifying its original class.

Instead of using inheritance and creating many variations, the pattern wraps the object inside other objects that add behavior.

---

## Core Idea

Instead of doing this:

* `EmailNotifier`
* `EmailNotifierWithSMS`
* `EmailNotifierWithSlack`
* `EmailNotifierWithSMSAndSlack`

With Decorator, you do this:

* Take a base object
* Wrap it with decorators as needed
* Combine behaviors at runtime

---

## When to Use It

* When you need to add behavior without modifying existing classes
* When you want to avoid an explosion of subclasses
* When you need to combine functionalities dynamically
* When you want to follow the Open/Closed Principle

---

## Advantages

* Dynamic behavior extension
* No need to modify existing code
* Flexible combinations
* Follows SOLID principles

---

## Disadvantages

* Can create many small classes
* Can be harder to debug
* The flow may become less clear with many decorators

---

## Difference with Other Patterns

Adapter
Changes an interface to make it compatible with another system.

Decorator
Keeps the interface but adds behavior.

Facade
Simplifies access to a complex system with a unified interface.

---

## Decorator pattern rule
Original class → not modified
Existing decorators → not modified
New behavior → a new decorator is created

## Structure of the Pattern

![Image](https://images.openai.com/static-rsc-4/crZYyUds7TxQ4FOK-dr4xEEI9Z4uXnHB4aOYOapL9nMecYNT2nKlsHzah_AmGwTZ0rerUcsNkHceQX39CUKDxMzKP25W58T_R75bZ00mhKiPqwlIU5OqS_UKN7gyjhakseyhYbVE03K4wukZ5uNunqJaz4pBmHZXz-Bc0jXrGF8PKfScMeCBCqakKrEG2GKu?purpose=fullsize)

### Components

1. Component
   It is the common interface that defines the base behavior.

2. ConcreteComponent
   It is the actual implementation of the base object.

3. Decorator
   An abstract class that implements the same interface and contains a reference to a component.

4. ConcreteDecorator
   Classes that add additional behavior.

---

## PHP Example

### Base interface

```php
interface Notifier {
    public function send(string $message): void;
}
```

### Base implementation

```php
class EmailNotifier implements Notifier {
    public function send(string $message): void {
        echo "Sending Email: $message\n";
    }
}
```

### Base decorator

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

### Concrete decorators

```php
class SMSDecorator extends NotifierDecorator {
    public function send(string $message): void {
        parent::send($message);
        echo "Sending SMS: $message\n";
    }
}

class SlackDecorator extends NotifierDecorator {
    public function send(string $message): void {
        parent::send($message);
        echo "Sending Slack: $message\n";
    }
}
```

---

## Usage

```php
$notifier = new EmailNotifier();

$notifier = new SMSDecorator($notifier);
$notifier = new SlackDecorator($notifier);

$notifier->send("Hello world");
```

---

## Result

```
Sending Email: Hello world
Sending SMS: Hello world
Sending Slack: Hello world
```

---

## How It Works Internally

Each decorator:

* Receives an object that implements the same interface
* Executes the original behavior first (optional)
* Adds extra behavior before or after

A chain of calls is formed:

```
SlackDecorator
  → SMSDecorator
      → EmailNotifier
```

## Conceptual Backend Example

In your context (APIs and frameworks), Decorator is commonly used in:

* Middlewares (like in Laravel)
* Logging
* Caching
* Authentication
* Validation

Mental model:

```
Request
 → AuthDecorator
   → LoggingDecorator
     → Controller
```

---

## Next Recommended Step

After mastering Decorator, the next logical patterns are:

* Facade (to simplify subsystems)
* Proxy (access control and lazy loading)
* Composite (hierarchical structures)

---
