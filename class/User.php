<?php
require_once 'DbConnection.php';
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

    public function isLoginInDb($email): bool
    {
        $sql = 'SELECT COUNT(id) FROM users WHERE email = :email';

        $select = DbConnection::getDb()->prepare($sql);

        $select->bindParam(':email', $email);

        $select->execute();

        $user = $select->fetch(PDO::FETCH_NUM);

        return $user[0];
    }

    public function register($login, $password, $email, $firstname, $lastname)
    {
        // Assign to $email false or $email filtered by filter_var, & throw error if false at the same time
        if (!$email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Format email invalide');
        } else {
            $search_logins = $this->verifyLogins($login, $email);

            if ($search_logins['found_login']) {
                throw new Exception('Le login existe est déjà utilisé');
            } elseif ($search_logins['found_email']) {
                throw new Exception('Adresse mail déjà utilisée');
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);

                $sql = 'INSERT INTO users (login, password, email, firstname, lastname) VALUES (:login, :password, :email, :firstname, :lastname)';

                $insert = DbConnection::getDb()->prepare($sql);

                $insert->bindParam(':login', $login);
                $insert->bindParam(':password', $hashed_password);
                $insert->bindParam(':email', $email);
                $insert->bindParam(':firstname', $firstname);
                $insert->bindParam(':lastname', $lastname);

                if ($insert->execute()) {
                    return true;
                } else {
                    throw new Exception('Échec lors de l\'inscription');
                }

            }
        }
    }


    // public function register($email, $password, $firstname, $lastname)
    // {
    //     $sql = 'INSERT INTO users (email, password, firstname)';
    // }


    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     */
    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     */
    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }
}

$user = new User();
$test = $user->isLoginInDb('admin@admin.com');

var_dump($test);