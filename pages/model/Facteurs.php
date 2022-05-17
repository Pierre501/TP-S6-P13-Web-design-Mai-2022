<?php 
require_once("connexion.php");

class Facteurs
{
    private $idFacteurs;
    private $facteurs;
    private $url;
    private $image;
    private $consequence;

    public function setIdFacteurs($id)
    {
        $this->idFacteurs = $id;
    }

    public function getIdFacteurs()
    {
        return $this->idFacteurs;
    }

    public function setFacteurs($facteurs)
    {
        $this->facteurs = $facteurs;
    }

    public function getFacteurs()
    {
        return $this->facteurs;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setConsequence($consequence)
    {
        $this->consequence = $consequence;
    }

    public function getConsequence()
    {
        return $this->consequence;
    }

    public function getInstanceConnexion()
    {
        $connexion = new Connexion();
        return $connexion;
    }

    public function getSimpleFacteurs($id)
    {
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $facteurs = new Facteurs();
        $sql = "select * from facteurs where id_facteurs = %d";
        pg_set_client_encoding($connexion, "UNICODE");
        $sql = sprintf($sql, $id);
        $query = pg_query($connexion, $sql);
        while($rows = pg_fetch_array($query))
        {
            $facteurs->setIdFacteurs($rows['id_facteurs']);
            $facteurs->setFacteurs($rows['facteurs']);
            $facteurs->setUrl($rows['url']);
            $facteurs->setImage($rows['images']);
            $facteurs->setConsequence($rows['consequence']);
        }
        pg_close($connexion);
        return $facteurs;
    }

    public function getSimpleFacteursByName($typeFacteurs)
    {
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $facteurs = new Facteurs();
        $sql = "select * from facteurs where facteurs = '%s'";
        pg_set_client_encoding($connexion, "UNICODE");
        $sql = sprintf($sql, $typeFacteurs);
        $query = pg_query($connexion, $sql);
        while($rows = pg_fetch_array($query))
        {
            $facteurs->setIdFacteurs($rows['id_facteurs']);
            $facteurs->setFacteurs($rows['facteurs']);
            $facteurs->setUrl($rows['url']);
            $facteurs->setImage($rows['images']);
            $facteurs->setConsequence($rows['consequence']);   
        }
        pg_close($connexion);    
        return $facteurs;
    }

    public function getAllFacteurs()
    {
        $tabFacteurs = array();
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $sql = "select * from facteurs";
        pg_set_client_encoding($connexion, "UNICODE");
        $query = pg_query($connexion, $sql);
        while($rows = pg_fetch_array($query))
        {
            $facteurs = new Facteurs();
            $facteurs->setIdFacteurs($rows['id_facteurs']);
            $facteurs->setFacteurs($rows['facteurs']);
            $facteurs->setUrl($rows['url']);
            $facteurs->setImage($rows['images']);
            $facteurs->setConsequence($rows['consequence']);
            $tabFacteurs[] = $facteurs;
        }
        pg_close($connexion);
        return $tabFacteurs;
    }

    public function getIdMaxFacteurs()
    {
        $id = 0;
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $sql = "select max(id_facteurs) as id_max from facteurs";
        $query = pg_query($connexion, $sql);
        while($rows = pg_fetch_array($query))
        {
            $id = $rows['id_max'];
        }
        pg_close($connexion);
        return $id;
    }

    public function formatUrl($facteurs)
    {
        $url = "";
        $tabSplit = explode(" ", $facteurs);
        for($i = 0; $i < count($tabSplit); $i++)
        {
            $url .= $tabSplit[$i]."-";
        }
        $id = $this->getIdMaxFacteurs() + 1;
        $urlFinal = $url.$id.".html";
        return $urlFinal;
    }

    public function insertionFacteurs($facteurs, $url, $images, $consequence)
    {
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $sql = "insert into facteurs values(default, E'%s', '%s', '%s', %d)";
        $sql = sprintf($sql, $facteurs, $url, $images, $consequence);
        pg_query($connexion, $sql);
    }

    public function suppressionFacteurs($id)
    {
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $sql = "delete from facteurs where id_facteurs = %d";
        $sql = sprintf($sql, $id);
        pg_query($$connexion, $sql);
    }

    public function modificationFacteurs($idFacteurs, $facteurs, $url, $image, $consequence)
    {
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $sql = "update facteurs set facteurs = '%s', url = '%s', images = '%s', consequence = %d where id_facteurs = %d";
        $sql = sprintf($sql, $facteurs, $url, $image, $consequence, $idFacteurs);
        pg_query($connexion, $sql);
    }
}
?>