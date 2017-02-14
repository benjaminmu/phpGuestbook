<?php

/**
 * ModelUser
 *
 * @author Benjamin Munsch <benjamin.munsch@googlemail.com>
 */
class ModelUser
{
    protected $dbConnector;
    protected $id;
    protected $name;
    protected $passwordHash;

    public function __construct(DbConnector $dbConnector) {
        $this->dbConnector = $dbConnector;
    }

    /**
     * @return  int $id
     */
    public function getId()
    {
        return (int)$this->id;
    }

    /**
     * populates $this with user data
     *
     * @param   int $id
     * @return  array
     */
    public function loadById($id)
    {
        $statement = $this->dbConnector->prepare('SELECT * FROM users WHERE id = :id');
        $statement->execute([
            'id' => (int)$id,
        ]);

        if ($row = $statement->fetch()) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->passwordHash = $row['password_hash'];
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
        $statement = $this->dbConnector->prepare('SELECT * FROM users WHERE name = :name');
        $statement->execute([
            'name' => $name,
        ]);

        if ($row = $statement->fetch()) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->passwordHash = $row['password_hash'];
        }

        return $this;
    }

    /**
     * @param   string $name
     * @param   string $password
     * @return  void
     */
    public function register($name, $password)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $statement = $this->dbConnector->prepare('INSERT INTO users (name, password_hash) VALUES (:name, :password_hash)');
        $statement->execute([
            'name' => $name,
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
}