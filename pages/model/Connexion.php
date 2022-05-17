<?php 
class Connexion
{
    public function connexion()
    {
        $host = 'localhost';
    	$dbname = 'rechauffement_climatique';
   		$username = 'admin';
    	$password = 'admin';
        $dsn = "host=$host port=5432 dbname=$dbname user=$username password=$password";
        $connexion = pg_connect($dsn);
		return $connexion;
    }
}
?>