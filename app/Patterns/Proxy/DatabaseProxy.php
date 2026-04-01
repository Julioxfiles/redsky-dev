<?php
 
namespace App\Patterns\Proxy;

class DatabaseProxy implements DatabaseInterface {
    private RealDatabase $realDb;
    private string $userRole;

    public function __construct(string $userRole) {
        $this->userRole = $userRole;
        $this->realDb = new RealDatabase();
    }

    public function query(string $sql): void {
        if ($this->userRole === 'admin') {
            echo "Proxy: Access allowed for $this->userRole\n";
            $this->realDb->query($sql);
        } else {
            echo "Proxy: Access denied for $this->userRole\n";
        }
    }
}