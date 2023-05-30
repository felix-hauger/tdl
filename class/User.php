<?php

require_once 'DbConnection.php';

class User
{
    /**
     * @var int identifier in database
     */
    private int $_id;

    /**
     * @var string personal info, used for login
     */
    private string $_email;

    /**
     * @var string personal info
     */
    private ?string $_firstname;

    /**
     * @var string personal info
     */
    private ?string $_lastname;

    public function __construct()
    {
    }

    /**
     * To test if email already exists in database
     * 
     * @param string $email The searched email
     * 
     * @return bool Depend if one result or more is found
     */
    private function isEmailInDb(string $email): bool
    {
        $sql = 'SELECT COUNT(id) FROM users WHERE email = :email';

        $select = DbConnection::getDb()->prepare($sql);

        $select->bindParam(':email', $email);

        $select->execute();

        $user = $select->fetchColumn(); //? use fetch column

        return $user > 0;
    }

    /**
     * To register user in database
     * 
     * @param string $email The user email, auth info
     * @param string $password The user password to auth
     * @param string $firstname Personal info
     * @param string $lastname Personal info
     * 
     * @return bool Depending if insertion request is successfully executed
     */
    public function register(string $email, string $password, string $firstname, string $lastname): bool
    {
        // Assign to $checked_email false or $email filtered by filter_var, & throw error if false at the same time
        if (!$checked_email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Format email invalide');
        } elseif ($this->isEmailInDb($checked_email)) {
            // var_dump($checked_email);
            throw new Exception('Adresse mail déjà utilisée');
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);

            $sql = 'INSERT INTO users (email, password, firstname, lastname) VALUES (:email, :password, :firstname, :lastname)';

            $insert = DbConnection::getDb()->prepare($sql);

            $insert->bindParam(':email', $checked_email);
            $insert->bindParam(':password', $hashed_password);
            $insert->bindParam(':firstname', $firstname);
            $insert->bindParam(':lastname', $lastname);

            return $insert->execute();
        }
    }

    /**
     * To log user in session
     * 
     * @param string $email The user email
     * @param string $password The user password
     * 
     * @return self $this filled with user infos to store in session
     */
    public function connect(string $email, string $password): self
    {
        $sql = 'SELECT id, email, password, firstname, lastname FROM users WHERE email = :email';

        $select = DbConnection::getDb()->prepare($sql);

        $select->bindParam(':email', $email);

        $select->execute();

        $user = $select->fetch(PDO::FETCH_ASSOC);

        // If user is found in database
        if ($user) {
            // Check if passwords match
            if (password_verify($password, $user['password'])) {
                $this->_id = $user['id'];
                $this->_email = $user['email'];
                $this->_firstname = $user['firstname'];
                $this->_lastname = $user['lastname'];

                return $this;
            }
        }
        // Exception if login or password is incorrect
        throw new Exception('identifiants incorrects.');
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->_id = $id;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail(): string
    {
        return $this->_email;
    }

    /**
     * Set the value of email
     */
    public function setEmail(string $email): self
    {
        $this->_email = $email;

        return $this;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname(): ?string
    {
        return $this->_firstname;
    }

    /**
     * Set the value of firstname
     */
    public function setFirstname(?string $firstname): self
    {
        $this->_firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname(): ?string
    {
        return $this->_lastname;
    }

    /**
     * Set the value of lastname
     */
    public function setLastname(?string $lastname): self
    {
        $this->_lastname = $lastname;

        return $this;
    }
}
