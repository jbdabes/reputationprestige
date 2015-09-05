<?php

// render link
$templater = vB_Template::create('reputation_prestige_link');
$templater->register('selectedcell', $selectedcell);
$template_hook['usercp_navbar_myaccount'] .= $templater->render();