<?php 
class Connexion
{
    public function connexion()
    {
        $host = 'ec2-3-228-235-79.compute-1.amazonaws.com';
    	$dbname = 'deacl2fvao6jda';
   	$username = 'yhcvstnalxhowe';
    	$password = '1ed2168f01fb2d8a116f258ed4bfa9c87ae1f23b0f568b007eee0dd0e2084805';
        $dsn = "host=$host port=5432 dbname=$dbname user=$username password=$password";
        $connexion = pg_connect($dsn);
		return $connexion;
    }
}
?>
