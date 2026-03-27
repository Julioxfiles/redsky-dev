<?php

namespace App\Patterns\Facade;

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
            echo "Login exitoso <br/>";
        } else {
            $this->logger->log("Error de autenticación");
            echo "Login fallido <br>";
        }
    }
}

// Viola principio de siple responsabilidad ?

/* Una Facade NO hace la lógica de negocio, 
   solo coordina quién la hace. Esa es su responsabilidad.

* La Facade NO cambia porque:

 cambió la lógica de AuthService
 cambió cómo se envían emails
 cambió la base de datos

Eso afecta a otras clases, no a la Facade.

* La verdadera razón de cambio

 La Facade cambia cuando:

  Cambia el flujo del proceso
  Cambia el orden de ejecución
  Se agregan o eliminan pasos
  Cambia la forma de interacción entre servicios
*/

// Does it violates Simple Responsibility ?
/* A Facade does NOT create the business logic, 
   it only coordinates who creates it.

* The Facade does NOT change because:

the logic of AuthService changed
how emails are sent changed
the database changed

That affects other classes, not the Facade.

* The real reason for change

The Facade changes when:

The process flow changes
The execution order changes
Steps are added or removed
The way services interact changes
*/