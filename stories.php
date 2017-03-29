<?php
require_once 'classes/DB.php';
require_once 'classes/User.php';
?>
<a href="?logout=true">LogOut</a>
<br />
<br />
<br />
<?php
//require_once 'Story.php';
if (isset($_GET['logout']) && $_GET['logout'] == 'true')
    User::logout();
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