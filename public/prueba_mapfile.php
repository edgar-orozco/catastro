<?php
/**
 * Created by PhpStorm.
 * User: lbarragan
 * Date: 30/04/15
 * Time: 04:35 PM
 */

$PM_MAP_FILE = "/var/www/html/geografica/Tabasconst.map";
$map = ms_newMapObj($PM_MAP_FILE);

$map->setextent(458972.03221943,1971895.494418,459730.84599939,1972189.9087251);
$map->setextent(458080,1971773,460030,1973118);

/*        $conn = Config::get('database.connections.pgsql');
        $host = $conn['host'];
        $database = $conn['database'];
        $username = $conn['username'];
        $password = $conn['password'];
        $connectionString = "user='$username' password='$password' dbname='$database' host=$host port=5432";
            echo $connectionString;

		$numLayers = $map->numlayers;

		for ($iLayer = 0 ; $iLayer < $numLayers ; $iLayer++) {
            $msLayer = $map->getLayer($iLayer);
            $msLayer ->set('status', MS_OFF);
            if($msLayer->connectiontype == MS_POSTGIS){
                $msLayer->set("connection", $connectionString);
            }
        }
*/

$image=$map->draw();
$image_url=$image->saveWebImage()

?>
<HTML>
<HEAD>
    <TITLE>Map 2</TITLE>
</HEAD>
<BODY>
    <TABLE>
        <TR>
            <TD>
                <div style="border-style: solid; border-color: #000;"> <INPUT TYPE=IMAGE NAME="mapa" SRC="<?php echo $image_url?>" > </div>
            </TD>
        </TR
    </TABLE>
</BODY>
</HTML>



