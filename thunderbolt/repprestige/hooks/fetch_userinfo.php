<?php

require_once(DIR . '/thunderbolt/repprestige/includes/functions_repprestige.php');

switch($user['reputationprestige'])
{
    // no prestige
    case '0':
        $user['reputation'] = fetch_repprestige($user['reputation'], '0');
    break;
    // prestige 1
    case '1':
        $user['reputation'] = fetch_repprestige($user['reputation'], '1');
    break;
    case '2':
        $user['reputation'] = fetch_repprestige($user['reputation'], '2');
    break;
    case '3':
        $user['reputation'] = fetch_repprestige($user['reputation'], '3');
    break;
    case '4':
        $user['reputation'] = fetch_repprestige($user['reputation'], '4');
    break;
    case '5':
        $user['reputation'] = fetch_repprestige($user['reputation'], '5');
    break;
    case '6':
        $user['reputation'] = fetch_repprestige($user['reputation'], '6');
    break;
    case '7':
        $user['reputation'] = fetch_repprestige($user['reputation'], '7');
    break;
    case '8':
        $user['reputation'] = fetch_repprestige($user['reputation'], '8');
    break;
    case '9':
        $user['reputation'] = fetch_repprestige($user['reputation'], '9');
    break;
    case '10':
        $user['reputation'] = fetch_repprestige($user['reputation'], '10');
    break;
    default:
        if($user['reputationprestige'] < '0')
        {
            $user['reputationprestige'] = '0';
        }
        if($user['reputationprestige'] > '10')
        {
            $user['reputationprestige'] = '10';
        }
    break;
}

fetch_prestigeicon($user['reputationprestige'], $user);