<?php
//require_once 'Story.php';
$ficheros = scandir( 'stories' );
$files = array();
foreach ( $ficheros as $fichero ) {
    if ( !in_array( $fichero, array( '.', '..' ) ) )
        $files[] = $fichero;
}

foreach ( $files as $file ) {
    $json = file_get_contents( 'stories/' . $file );
    $json = json_decode( $json );
    print <<<HTML
   <a href="editStory.php?story= $file"> $file </a>&nbsp;&nbsp;&nbsp;&nbsp; ==>  likes:   $json->likes<br />
HTML;
}