<?php
	 define( 'HOST', 'localhost' );
	 define( 'USER', 'root' );
	 define('PASS', '' );
	 define('DB', 'catalogo_livros' );

     $charset = 'utf8';
	 $conn = mysqli_connect ( HOST, USER, PASS, DB )
	 				or die ('Erro de conexão' );

?>
