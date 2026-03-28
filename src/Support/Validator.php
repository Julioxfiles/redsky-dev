<?php

namespace App\Support;

use Exception;

class Validator
{
    public function validate(array $data, array $rules): void
    {
        foreach ($rules as $field => $rule) {
            $rulesList = explode('|', $rule);

            foreach ($rulesList as $r) {
                if ($r === 'required' && empty($data[$field])) {
                    throw new Exception("Field {$field} is required");
                }

                if ($r === 'email' && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Field {$field} must be a valid email");
                }

                if (str_starts_with($r, 'min:')) {
                    $min = (int) explode(':', $r)[1];
                    if (strlen($data[$field]) < $min) {
                        throw new Exception("Field {$field} must be at least {$min} characters");
                    }
                }
            }
        }
    }
}