<?php

namespace App\Services\Users\Insert;

use App\Core\Functions;

class InsertUserRequest
{
    protected string $name;
    protected string $username;
    protected string $email;
    protected string $city;
    protected string $phone;
    protected string $website;
    protected string $company;
    protected string $password0;
    protected string $password1;

    public function __construct(
        string $name,
        string $username,
        string $email,
        string $city,
        string $phone,
        string $website,
        string $company,
        string $password0,
        string $password1
    )
    {
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->city = $city;
        $this->phone = $phone;
        $this->website = $website;
        $this->company = $company;
        $this->password0 = $password0;
        $this->password1 = $password1;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function getPassword0(): string
    {
        return $this->password0;
    }

    public function getPassword1(): string
    {
        return $this->password1;
    }


}