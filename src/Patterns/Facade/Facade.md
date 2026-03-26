
## What is the Facade Pattern 

The **Facade** is a structural design pattern that provides a **simple and unified interface** to a complex system of classes.

Instead of interacting directly with multiple classes, the client interacts with a single class: the facade.

---

## Core Idea

Instead of doing this:

```php
$auth = new AuthService();
$db = new Database();
$logger = new Logger();

$auth->checkUser();
$db->connect();
$logger->log("User authenticated");
```

With Facade, you do this:

```php
$system = new SystemFacade();
$system->login();
```

All the complexity is hidden behind the facade.

---

## Structure of the Pattern

![Image](https://images.openai.com/static-rsc-4/gmpvyhwTmRHpsoXvxOORenisK6xf4nsW9_VGzHFh7AX7s-CZm8OypavYiIvExgKExDKxXZmI4taEZ_Xh8GeOz54kMHG1cK-3RE5Js9S7CybX4VWxtrlMlg8kStkGj9c7pI7_4ZPPLr8gF0sKteRid6lDINX401rSI1-bc2KMP1vz3T_Z1zuw6hq7O_3Z7ZYt?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/GK-_21oeOa7_kgJInt7SBLKktnNT4mj6uxkssl5lxYkq1DDdvq-weepRh2dw0Z37ziuD9eCDxvYU8uhShfvaL_VifvGuT2za5yWEguEI37jziUVxw8TMzIlJQAaKP3CLcifzxX46xaiHBLi74RZzzSaXRt7iVYOyF8UtfxrhrfXbxhyXNX-VeTfEa_AyzdPq?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/HT3KHp9tJcu0_bPDDG-9CojtNgfl4SokWf8rrAUQEa6GUQ4phONBHUfqdEBrzMrWZ3WXJzT1HIMZ4pfpqFW2vGvpbNpU4RSDvZFo4uRiC5WYxKSjmssRKML3uxqqh2c41LufZZOlm9vN-mEZxfsS3Dw30b0kRpWe2oJqdqp54qhz8_P5nxbiIipqXwXJScwt?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/nbNEvP3N5mjYRSk-9_771KorR8_wmtlsi78SjxvmZ4O2EPpTjF4pBVYy7SHybEQpUy2lOAkh97Am3AY7_7Y3bp8U03EnhGPrvIwTOs4zGi4SOAGK-7VsPSqpcWB-yiJtTeRcF7_O94oykW2DpzMmzreySmWR5ENwcXo4opQhHrK8NXNPLd--OdkJxAbBF_hN?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/7fOUyFcGMDK_1xlbyHittuE6P1b-zOHPP_rOoov5qMrdF6HiAsdMfeNOZeMJgSmizBKSctXiMR1ngLdMyspMvMt7SbE1NSSd_fkLkNLHJ3-41foJk1tDwTM9FnuiRcyAGs7r54QSplftT-vFTVZNwwAzwkC7V1_-_45v1AMlkR-9qQ074DC_yylFUXiBEGd0?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/QytMbFFEsEBGuOf1gf4B_J9YM5CjwO07yI1CYJL7IHM1ZZ4-ZK1vHebFR6lJsA3PnDtfSYil-vxPaEqOoQKFfhCi3FE1N00rCenIC3eNgziTk0dmn1ZQ1IoGOnBlUE_jta5Uy8gPEoClFHFQzZp9kdZZMrcSishblActrg1h5l2lc5UzQ1_9IP-Ug7wkJkjr?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/GtNdiFeGNg4rTlRkJLhb5EJ5V4CYQWXuU6Pv7fJfs_1K4K_8Y96X8VB62dyQAS4IFPed3RLXyWWzM-sTY2HhCFzV-GCpc5uIHwBdIt_1PdFgZbzxhu1hsWU_7xy4X0UGQ3rU-T_y88h7p56hZmnP_ZdYqIQQylsIvGoLTG2Eu9p6dtuseWfQjO_qwha6KHTm?purpose=fullsize)

### Components

1. Facade
   A class that exposes simple methods to the client.

2. Subsystems
   Internal classes that perform the actual work.

3. Client
   Uses the facade instead of interacting directly with the subsystem classes.

---

## PHP Example

We’ll simulate a login system composed of multiple internal classes.

---

### Subsystems (real classes)

```php
class AuthService {
    public function authenticate(string $user, string $password): bool {
        echo "Authenticating user...\n";
        return true;
    }
}

class Database {
    public function connect(): void {
        echo "Connecting to database...\n";
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
            $this->logger->log("User authenticated successfully");
            echo "Login successful\n";
        } else {
            $this->logger->log("Authentication failed");
            echo "Login failed\n";
        }
    }
}
```

---

## Usage

```php
$facade = new LoginFacade();
$facade->login("admin", "1234");
```

---

## Result

```
Connecting to database...
Authenticating user...
Log: User authenticated successfully
Login successful
```

---

## How It Works Internally

The facade:

* Creates and coordinates multiple subsystem objects
* Defines a clear execution flow
* Hides complexity from the client

Internal flow:

```
LoginFacade
  → Database
  → AuthService
  → Logger
```

Client view:

```
LoginFacade → login()
```

---

## When to Use It

* When you have a complex system with many classes
* When you want to simplify usage of an internal API
* When you want to decouple the client from the system
* When you need a clear entry point

---

## Advantages

* Simplifies system usage
* Reduces coupling
* Improves code readability
* Centralizes orchestration logic

---

## Disadvantages

* Can become a “God Class” if overused
* May hide too much logic (harder debugging)
* Does not reduce complexity, only encapsulates it

---

## Difference with Other Patterns

Adapter
Changes an interface to make it compatible with another.

Decorator
Adds behavior dynamically.

Facade
Simplifies access to a complex system.

---

## Conceptual Backend Example

In your context (APIs and frameworks like your **redsky-mvc-api**), Facade is commonly used in:

* Authentication services
* Caching systems
* Database access
* Internal libraries

Mental model:

```
Controller
  → AuthFacade
       → JWTService
       → UserRepository
       → Validator
```

The controller simply does:

```php
$auth->login($request);
```

---

## More Realistic Example (Laravel-style)

```php
class Cache {
    public static function get(string $key) {
        echo "Getting cache value: $key\n";
    }

    public static function put(string $key, $value) {
        echo "Saving to cache: $key\n";
    }
}
```

Usage:

```php
Cache::put("user_1", "John");
Cache::get("user_1");
```

Here, `Cache` acts as a simplified facade.

---

## Next Recommended Step

After mastering Facade, the next logical patterns are:

* Proxy (access control, lazy loading)
* Composite (tree structures)
* Bridge (separating abstraction from implementation)

---

If you want, next we can take this further into your project and build:

* A real **AuthFacade with JWT**
* A **Database Facade like Laravel DB**
* Or your own **static Facade system (Laravel-style)**

That’s where this becomes powerful in real architecture.
