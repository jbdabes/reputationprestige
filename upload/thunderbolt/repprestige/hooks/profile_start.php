<?php

if (($_REQUEST['do'] == 'repprestige'))
{
	// draw cp nav bar
	construct_usercp_nav('repprestige');
    
    // check user is logged in
    if($vbulletin->userinfo['userid'] < 1)
    {
        print_no_permission();
    }
    
    // do you even prestige bro
    $canprestige = fetch_canprestige($vbulletin->userinfo['reputationprestige'], $vbulletin->userinfo['reputation']);
    
    if(isset($_REQUEST['prestige']) && $canprestige)
    {
        // update their prestige level
        $query = $vbulletin->db->query_write("UPDATE " . TABLE_PREFIX . "user SET reputationprestige = reputationprestige+1 WHERE userid = '" . intval($vbulletin->userinfo['userid']) . "'");
        // reset $vbulletin->userinfo, assuming it's fine to just use fetch_userinfo(), shouldn't cause any issues..
        $vbulletin->userinfo = fetch_userinfo($vbulletin->userinfo['userid']);
    }
    
    // no point in calculating this if they're at the top prestige level
    if($vbulletin->userinfo['reputationprestige'] < 10)
    {
        $nextprestige = intval($vbulletin->userinfo['reputationprestige']) + 1;
    }
    else
    {
        $nextprestige = 10;
    }
    
	// render template
	$navbits[''] = 'Reputation Prestige';
	$page_templater = vB_Template::create('reputation_prestige_usercp');
	$page_templater->register('checked', $checked);
	$page_templater->register('nextprestige', $nextprestige);
	$page_templater->register('canprestige', $canprestige);
}