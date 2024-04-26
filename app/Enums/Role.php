<?php

namespace App\Enums;

enum Role: int
{
    /**
     * Role User
     */
    public const USER = 1;

    /**
     * Role Admin
     */
    public const ADMIN = 2;

    /**
     * Role root admin
     */
    public const STORE = 3;

    /**
     * Role Guest.
     */
    public const STAFF = 4;
}