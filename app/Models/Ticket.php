<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Ticket extends Model
{
    public function all(): \Generator
    {
        $stmt = $this->db->query('SELECT * FROM tickets');

       return $this->fetchLazy($stmt);
    }

}