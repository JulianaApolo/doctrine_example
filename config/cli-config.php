<?php
require_once(realpath(sprintf("%s/../src/scripts/init.inc.php", __DIR__)));

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
