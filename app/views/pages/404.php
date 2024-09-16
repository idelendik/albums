<?php

require PATH_PARTIALS.'/header.php';

requireComponentWithParams(PATH_COMPONENTS.'/page-header.php',
    ['text' => '404 - Page not found']
);

require PATH_PARTIALS.'/footer.php';
