<?php

namespace App\Models;

class Users
{
    protected int $id;
    protected string $name;
    protected string $username;
    protected string $email;
    protected string $city;
    protected string $phone;
    protected string $website;
    protected string $companyName;
    protected string $password;

    public function __construct(
        int    $id, string $name, string $username, string $email, string $city,
        string $phone, string $website, string $companyName, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->city = $city;
        $this->phone = $phone;
        $this->website = $website;
        $this->companyName = $companyName;
        $this->password = $password;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getId(): int
    {
        return $this->id;
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
}

