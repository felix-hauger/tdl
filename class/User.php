<?php

class User
{
    /**
     * @var int identifier in database
     */
    private int $id;

    /**
     * @var string personal info, used for login
     */
    private string $email;
    
    /**
     * @var string personal info
     */
    private ?string $firstname;
    
    /**
     * @var string personal info
     */
    private ?string $lastname;

    public function __construct()
    {
        
    }    
}