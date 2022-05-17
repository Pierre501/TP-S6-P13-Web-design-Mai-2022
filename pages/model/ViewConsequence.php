<?php 
require_once("connexion.php");

class ViewConsequence
{
    private $idConsequence;
    private $typeConsequence;
    private $idDetailsConsequence;
    private $detailsConsequence;

    public function setIdConsequence($idConsequence)
    {
        $this->idConsequence = $idConsequence;
    }

    public function getIdConsequence()
    {
        return $this->idConsequence;
    }

    public function setTypeConsequence($consequence)
    {
        $this->typeConsequence = $consequence;
    }

    public function getTypeConsequence()
    {
        return $this->typeConsequence;
    }

    public function setIdDetailsConsequence($idDetailsConsequence)
    {
        $this->idDetailsConsequence = $idDetailsConsequence;
    }

    public function getIdDetailsConsequence()
    {
        return $this->idDetailsConsequence;
    }

    public function setDetaisConsequence($detailsConsequence)
    {
        $this->detailsConsequence = $detailsConsequence;
    }

    public function getDetailsConsequence()
    {
        return $this->detailsConsequence;
    }

    public function getInstanceConnexion()
    {
        $connexion = new Connexion();
        return $connexion;
    }

    public function getSimpleViewConsequence($id)
    {
        $tabViewConsequence = array();
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $sql = "select * from view_consequence where id_consequence = %d";
        $sql = sprintf($sql, $id);
        $query = pg_query($connexion, $sql);
        while($rows = pg_fetch_array($query))
        {
            $consequence = new ViewConsequence();
            $consequence->setIdConsequence($rows['id_consequence']);
            $consequence->setTypeConsequence($rows['type_consequence']);
            $consequence->setIdDetailsConsequence($rows['id_details_consequence']);
            $consequence->setDetaisConsequence($rows['details_consequence']);
            $tabViewConsequence[] = $consequence;
        }
        pg_close($connexion);
        return $tabViewConsequence;
    }

    public function getAllViewConsequence()
    {
        $tabViewConsequence = array();
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $sql = "select * from view_consequence";
        $query = pg_query($connexion, $sql);
        while($rows = pg_fetch_array($query))
        {
            $consequence = new ViewConsequence();
            $consequence->setIdConsequence($rows['id_consequence']);
            $consequence->setTypeConsequence($rows['type_consequence']);
            $consequence->setIdDetailsConsequence($rows['id_details_consequence']);
            $consequence->setDetaisConsequence($rows['details_consequence']);
            $tabViewConsequence[] = $consequence;
        }
        pg_close($connexion);
        return $tabViewConsequence;
    }

    public function getAllDetailsConsequence($idConsequence)
    {
        $tabDetailsConsequence = array();
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $sql = "select * from details_consequence where id_consequence = %d";
        $sql = sprintf($sql, $idConsequence);
        $query = pg_query($connexion, $sql);
        while($rows = pg_fetch_array($query))
        {
            $consequence = new ViewConsequence();
            $consequence->setIdDetailsConsequence($rows['id_details_consequence']);
            $consequence->setIdConsequence($rows['id_consequence']);
            $consequence->setDetaisConsequence($rows['details_consequence']);
            $tabDetailsConsequence[] = $consequence;
        }
        pg_close($connexion);      
        return $tabDetailsConsequence;
    }

    public function getAllConsequence()
    {
        $tabConsequence = array();
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $sql = "select * from consequence";
        $query = pg_query($connexion, $sql);
        while($rows = pg_fetch_array($query))
        {
            $consequence = new ViewConsequence();
            $consequence->setIdConsequence($rows['id_consequence']);
            $consequence->setTypeConsequence($rows['type_consequence']);
            $tabConsequence[] = $consequence;
        }
        pg_close($connexion);
        return $tabConsequence;
    }

    public function getAllTypeConsequenceAvecFiltre($typeConsequence)
    {
        $data = array();
        $tabConsequence = $this->getAllConsequence();
        foreach($tabConsequence as $consequence)
        {
            if($consequence->getTypeConsequence() == $typeConsequence)
            {
                continue;
            }
            $view = new ViewConsequence();
            $view->setIdConsequence($consequence->getIdConsequence());
            $view->setTypeConsequence($consequence->getTypeConsequence());
            $data[] =  $view;
        }
        return $data;
    }

    public function insertionDetailsConsequences($idConsequence, $detailsConsequence)
    {
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $sql = "insert into details_consequence values(default, %d, E'%s')";
        $sql = sprintf($sql, $idConsequence, $detailsConsequence);
        pg_query($connexion, $sql);
        pg_close($connexion);

    }

    public function suppressionDetailsConsequence($id_details_consequence)
    {
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $sql = "delete from details_consequence where id_details_consequence = %d";
        $sql = sprintf($sql, $id_details_consequence);
        pg_query($connexion, $sql);
        pg_close($connexion);
    }

    public function modificationDetailsConsequence($id_details_consequence, $idConsequence, $detailsConsequence)
    {
        $connex = $this->getInstanceConnexion();
        $connexion = $connex->connexion();
        $sql = "update details_consequence set id_consequence  = %d, details_consequence = '%s' where id_details_consequence = %d";
        $sql = sprintf($sql, $idConsequence, $detailsConsequence, $id_details_consequence);
        pg_query($connexion, $sql);
        pg_close($connexion);
    }
}

?>