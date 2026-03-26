
## What is the Proxy Pattern

The **Proxy** is a structural design pattern that provides a **substitute or placeholder for another object**, controlling access to it.

Instead of interacting directly with the real object, the client interacts with a proxy that decides **how and when** to delegate the request.

---

## Core Idea

Instead of doing this:

```php
$video = new Video("movie.mp4");
$video->play();
```

With Proxy, you do this:

```php
$video = new VideoProxy("movie.mp4");
$video->play();
```

The proxy can:

* Delay loading (lazy loading)
* Control access (authentication)
* Add logging or caching

---

## Structure of the Pattern

![Image](https://images.openai.com/static-rsc-4/VTugo5RiO_h2anyo-hTbw4DawBpLAeRyo10-8L3g3nOfRZlHwVcYcFEDR5zIXxGkhVO6eeXFr9f0JaDailf7DAvsvlhmiaXhgZhZ_2VBsNcbtN93G2coFLACXSbm0ew8QiA_VBPOqbRKuDSCumRTVEMn4iBcu3c7WXF2TOP0c40tD1DNUWIwae7X-HAkwKUM?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/PUG35sIJ9Q0cbu8lyogRJm4f68TbCCbgQbMa-61CaUm1HPI7VfZ_geZZ8m5FcJweVnx4dq8dU9mWJl70pmaNpyZ1_8bq2hs2hw5l8J9iw8mpJ9X4FUsOJPQkCL2E_bu-B_u6v0ogQ12ZFSV6RA8QdYL_dLPSYTcocxxaFbmX0rrXVSQgg5EeKmqeEG6I4Ut4?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/gycKmYMVAnbj9RFoAL7Crgvso5sFW8VBLp4HtnM2tpC5lJFqlhaS7IeoLZLvH8MxaZrwkt9jObSSuwnI-a1tOwr3vhfCLRGfzcCF6OyyffwA_K9uIhbEjlZ2uPmrpHvvoUH-Hl6YxcRlNPEyFwu0CLb4N4JIlGPrtp6Rawk9iCw7ju3kmguHzDeVENCDkI0O?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/hlz46DjszVo9PiV4NZU4tiEGLkMISUaiBhFz9O4QNE92ZWE-zs1PZv6-de0NzYSQjFhFMKhmTbSi_dBLlobWf8Fd1YMk6MspLp8ctsDtX2zII53MP2k6qZ2eT4cnz1G-75Wm7pDg304g8Wq4lVCcgiSqG_zRdlcSOWj9QrDvnLBZlJlxbmeWHtCHtCj_ZYBg?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/TlTxDRwVXG8v6rh86xs6TX8v9fOGvKxKUzfJu8FUzXbrg8Y1Qpi42uetjaYLH2CTtVJvKAuqxWhntGtM6n_ERLd3RXC4qvR7GJWOptr-6H_0rHKVRfRiiQyrSS1T10rjVhEyqWHOCkCcYrR4d3qHHQsHBNACkQFzKXQb2Mnu-gs-pVkU8RoFnD-vdGhgxuCc?purpose=fullsize)

![Image](https://images.openai.com/static-rsc-4/WPM0P4cpISpO5FzhBM7B7YEOKlaAzqk3dy9oregMRiI8HeFcqv2y_XgQdCphXJ5bjL1wItuDwz_TYBrcNHV8v20f0dTTkYUa3W9eSLUrLX0ZKopTTTXui9J-ic-EzGcQYXYUhE5J2VzCC0nOYsAELKmoQMcBmwXQWIHwxbuKgsGv90GzNk-5ZnsTZsY4RiWj?purpose=fullsize)

### Components

1. Subject
   Common interface for both the real object and the proxy.

2. RealSubject
   The actual object that performs the work.

3. Proxy
   Controls access to the real object and may add extra behavior.

4. Client
   Uses the proxy as if it were the real object.

---

## PHP Example

We’ll simulate a heavy object (like loading a video).

---

### Subject interface

```php
interface Video {
    public function play(): void;
}
```

---

### Real object

```php
class RealVideo implements Video {
    protected string $filename;

    public function __construct(string $filename) {
        $this->filename = $filename;
        $this->loadFromDisk();
    }

    protected function loadFromDisk(): void {
        echo "Loading video from disk: {$this->filename}\n";
    }

    public function play(): void {
        echo "Playing video: {$this->filename}\n";
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

## Usage

```php
$video = new VideoProxy("movie.mp4");

// No loading yet
$video->play(); // Loads and plays
$video->play(); // Only plays (already loaded)
```

---

## Result

```
Loading video from disk: movie.mp4
Playing video: movie.mp4
Playing video: movie.mp4
```

---

## How It Works Internally

The proxy:

* Holds a reference to the real object
* Controls when to create or access it
* Delegates calls when needed

Flow:

```
Client
 → Proxy
     → RealVideo (only if needed)
```

---

## When to Use It

* When object creation is expensive (lazy loading)
* When you need access control (auth, permissions)
* When you want to add logging or caching
* When working with remote objects (API calls)

---

## Advantages

* Improves performance (lazy loading)
* Adds control over access
* Transparent to the client
* Can add cross-cutting concerns (logging, caching)

---

## Disadvantages

* Adds extra layer of abstraction
* Can increase complexity
* May introduce slight overhead

---

## Difference with Other Patterns

Adapter
Changes the interface.

Decorator
Adds behavior dynamically.

Facade
Simplifies access.

Proxy
Controls access to an object.

---

## Conceptual Backend Example

In your context (APIs and frameworks like your **redsky-mvc-api**), Proxy is very common in:

* Authentication guards
* Caching layers
* Lazy database loading
* API clients

Mental model:

```
Controller
 → UserRepositoryProxy
     → RealUserRepository
         → Database
```

Example:

```php
$user = $userRepository->find(1);
```

The proxy could:

* Check cache first
* Validate permissions
* Then call the real repository

---

## More Realistic Example (Access Control Proxy)

```php
class UserService {
    public function deleteUser(int $id): void {
        echo "User $id deleted\n";
    }
}

class UserServiceProxy {
    protected UserService $service;

    public function __construct(UserService $service) {
        $this->service = $service;
    }

    public function deleteUser(int $id, string $role): void {
        if ($role !== 'admin') {
            echo "Access denied\n";
            return;
        }

        $this->service->deleteUser($id);
    }
}
```

Usage:

```php
$service = new UserService();
$proxy = new UserServiceProxy($service);

$proxy->deleteUser(1, 'guest'); // denied
$proxy->deleteUser(1, 'admin'); // allowed
```

---

## Next Recommended Step

After Proxy, the next strong patterns for you are:

* Composite (tree structures)
* Bridge (decouple abstraction and implementation)

---

If you want, next we can do something very powerful for your project:

* Build a **Cache Proxy for your QueryBuilder**
* Create an **Auth Proxy for controllers**
* Or simulate a **remote API proxy (like HTTP client layer)**

That’s where Proxy becomes really useful in real-world architecture.
