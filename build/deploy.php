<?php

if ( ! is_dir( "src" ) ) {
	echo "Execute assim: php ./build/deploy.php" ;
	exit ;
}

`bash ./build/deploy.sh` ;
