<?php

/**
 * ModelUser
 *
 * @author Benjamin Munsch <benjamin.munsch@googlemail.com>
 */
class ModelUser
{
    private $dbConnector;
    private $id;
    private $name;
    private $password;
    private $passwordHash;
    private $admin;
    private $validationError;

    public function __construct(DbConnector $dbConnector)
    {
        $this->dbConnector = $dbConnector;
    }

    /**
     * @param   int $aName
     * @return  ModelUser
     */
    public function setName($aName)
    {
        $this->name = (string)$aName;
        return $this;
    }

    /**
     * @param   int $aPassword
     * @return  ModelUser
     */
    public function setPassword($aPassword)
    {
        $this->password = (string)$aPassword;
        return $this;
    }

    /**
     * @return  int $id
     */
    public function getId()
    {
        return (int)$this->id;
    }

    /**
     * @return  string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return  bool
     */
    public function isAdmin()
    {
        return (bool)$this->admin;
    }

    /**
     * @return  bool
     */
    public function isLoggedIn()
    {
        return !is_null($this->id);
    }

    /**
     * @return  string $validationError
     */
    public function getValidationError()
    {
        return $this->validationError;
    }

    /**
     * populates $this with user data
     *
     * @param   int $id
     * @return  array
     */
    public function loadById($id)
    {
        $statement = $this->dbConnector->prepare(
            'SELECT id, name, password_hash, admin FROM users WHERE id = :id'
        );
        $statement->execute([
            'id' => (int)$id,
        ]);

        if ($row = $statement->fetch()) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->passwordHash = $row['password_hash'];
            $this->admin = $row['admin'];
        }

        return $this;
    }

    /**
     * populates $this with user data
     *
     * @param   string $name
     * @return  array
     */
    public function loadByName($name)
    {
        $statement = $this->dbConnector->prepare(
            'SELECT id, name, password_hash, admin FROM users WHERE name = :name'
        );
        $statement->execute([
            'name' => $name,
        ]);

        if ($row = $statement->fetch()) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->passwordHash = $row['password_hash'];
            $this->admin = $row['admin'];
        }

        return $this;
    }

    /**
     * @return  void
     */
    public function register()
    {
        $passwordHash = password_hash($this->password, PASSWORD_BCRYPT);
        $this->setPassword(null);

        $statement = $this->dbConnector->prepare('INSERT INTO users (name, password_hash) VALUES (:name, :password_hash)');
        $statement->execute([
            'name' => $this->name,
            'password_hash' => $passwordHash,
        ]);
    }

    /**
     * checks if given password is the same as user's
     *
     * @param   string $password
     * @return  bool
     */
    public function verifyPasswd($password)
    {
        if (is_null($this->name)) {
            return false;
        }

        return password_verify($password, $this->passwordHash);
    }

    /**
     * @return   array $validationResult
     */
    public function validate()
    {
        if ($this->name == '') {
            $this->validationError = 'Ungültiger Nutzername';
            return false;
        }

        if ($this->password == '') {
            $this->validationError = 'Ungültiges Password';
            return false;
        }

        if (!$this->validateUnusedName()) {
            $this->validationError = 'Der Nutzername ist bereits vergeben. Bitte wählen Sie einen anderen.';
            return false;
        }

        return true;
    }

    /**
     * @return   bool
     */
    public function validateUnusedName()
    {
        $statement = $this->dbConnector->prepare(
            'SELECT id FROM users WHERE name = :name'
        );
        $statement->execute([
            'name' => $this->name,
        ]);

        if ($row = $statement->fetch()) {
            return false;
        }

        return true;
    }
}