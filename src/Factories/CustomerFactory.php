<?php

declare(strict_types=1);

namespace HydrogenpayAfrica\Factories;

use HydrogenpayAfrica\Contract\CustomerInterface;
use HydrogenpayAfrica\Entities\Customer as Person;
use InvalidArgumentException;
use HydrogenpayAfrica\Contract\FactoryInterface;

class CustomerFactory implements CustomerInterface, FactoryInterface
{
    public function create(array $data = []): Person
    {
        $data = array_change_key_case($data);
        if (empty($data)) {
            throw new InvalidArgumentException('Customer data is empty');
        }

        $person = new Person();
        $person->set('fullname', $data['full_name']);
        $person->set('email', $data['email']);
        $person->set('phone_number', $data['phone']);
        $person->set('address', $data['address'] ?? null);

        return $person;
    }
}
