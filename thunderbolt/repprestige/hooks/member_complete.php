<?php

require_once(DIR . '/thunderbolt/repprestige/includes/functions_repprestige.php');

$repprestige = $vbulletin->db->query_first("SELECT reputationprestige FROM " . TABLE_PREFIX . "user WHERE userid = '" . intval($prepared['userid']) . "'");
$prepared['reputationprestige'] = $repprestige['reputationprestige'];
switch($prepared['reputationprestige'])
{
    // no prestige
    case '0':
        $prepared['reputation'] = fetch_repprestige($prepared['reputation'], '0');
    break;
    // prestige 1
    case '1':
        $prepared['reputation'] = fetch_repprestige($prepared['reputation'], '1');
    break;
    case '2':
        $prepared['reputation'] = fetch_repprestige($prepared['reputation'], '2');
    break;
    case '3':
        $prepared['reputation'] = fetch_repprestige($prepared['reputation'], '3');
    break;
    case '4':
        $prepared['reputation'] = fetch_repprestige($prepared['reputation'], '4');
    break;
    case '5':
        $prepared['reputation'] = fetch_repprestige($prepared['reputation'], '5');
    break;
    case '6':
        $prepared['reputation'] = fetch_repprestige($prepared['reputation'], '6');
    break;
    case '7':
        $prepared['reputation'] = fetch_repprestige($prepared['reputation'], '7');
    break;
    case '8':
        $prepared['reputation'] = fetch_repprestige($prepared['reputation'], '8');
    break;
    case '9':
        $prepared['reputation'] = fetch_repprestige($prepared['reputation'], '9');
    break;
    case '10':
        $prepared['reputation'] = fetch_repprestige($prepared['reputation'], '10');
    break;
    default:
        if($prepared['reputationprestige'] < '0')
        {
            $prepared['reputationprestige'] = '0';
        }
        if($prepared['reputationprestige'] > '10')
        {
            $prepared['reputationprestige'] = '10';
        }
    break;
}

fetch_prestigeicon($prepared['reputationprestige'], $prepared);

if($prepared['reputationprestige'] > '0')
{
    $templater = vB_Template::create('memberinfo_reputation_prestige');
    $templater->register('prepared', $prepared);
    $templater->register('prestigeid', $prepared['reputationprestige']);
    $template_hook['profile_sidebar_first'] .= $templater->render();
}