<?php
declare(strict_types=1);

namespace App\Patterns\Decorator;

class EmailNotifier extends NotifierDecorator {

    public function send(string $message): string {
        // Se ejecuta el metodo send de la clase que este un nivel abajo.
        // Pues la clase padre que es NotifierDecorator delega la llamada al objeto que almacena.
        $result = parent::send($message); 
        return $result . " | sent via email. "; // Se agrega nuevo comportamiento.
        /**
         * Aqui se podria agregar mucho mas comportamiento.
         */
    }
    
}