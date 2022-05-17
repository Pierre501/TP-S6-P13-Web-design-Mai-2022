<?php 
require_once("connexion.php");

class Administrateur
{
    private $username;
    private $mdp;

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setMotDePasse($mdp)
    {
        $this->mdp = $mdp;
    }

    public function getMotDePasse()
    {
        return $this->mdp;
    }

    public function getInstanceConnexion()
    {
        $connexion = new Connexion();
        return $connexion;
    }

    public function verifierConnexion($username, $mdp)
    {
        $condition = false;
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $temp = 0;
        $formatSha1 = sha1($mdp);
        $sql = "select count(*) verification from administrateur where username = '%s' and mot_de_passe = '%s'";
        $sql = sprintf($sql, $username, $formatSha1);
        $query = pg_query($connexion, $sql);
        while($rows = pg_fetch_array($query))
        {
            $temp = $rows['verification'];
        }
        pg_close($connexion);
        if($temp == 1)
        {
            $condition = true;
        }
        return $condition;
    }
}
?>