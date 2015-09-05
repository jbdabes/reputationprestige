<?php

require_once(DIR . '/thunderbolt/repprestige/includes/functions_repprestige.php');

switch($post['reputationprestige'])
{
    // no prestige
    case '0':
        $post['reputation'] = fetch_repprestige($post['reputation'], '0');
    break;
    // prestige 1
    case '1':
        $post['reputation'] = fetch_repprestige($post['reputation'], '1');
    break;
    case '2':
        $post['reputation'] = fetch_repprestige($post['reputation'], '2');
    break;
    case '3':
        $post['reputation'] = fetch_repprestige($post['reputation'], '3');
    break;
    case '4':
        $post['reputation'] = fetch_repprestige($post['reputation'], '4');
    break;
    case '5':
        $post['reputation'] = fetch_repprestige($post['reputation'], '5');
    break;
    case '6':
        $post['reputation'] = fetch_repprestige($post['reputation'], '6');
    break;
    case '7':
        $post['reputation'] = fetch_repprestige($post['reputation'], '7');
    break;
    case '8':
        $post['reputation'] = fetch_repprestige($post['reputation'], '8');
    break;
    case '9':
        $post['reputation'] = fetch_repprestige($post['reputation'], '9');
    break;
    case '10':
        $post['reputation'] = fetch_repprestige($post['reputation'], '10');
    break;
    default:
        if($post['reputationprestige'] < '0')
        {
            $post['reputationprestige'] = '0';
        }
        if($post['reputationprestige'] > '10')
        {
            $post['reputationprestige'] = '10';
        }
    break;
}

fetch_prestigeicon($post['reputationprestige'], $post);

if($post['reputationprestige'] > '0')
{
    $templater = vB_Template::create('reputation_prestige');
    $templater->register('post', $post);
    $templater->register('prestigeid', $post['reputationprestige']);
    $template_hook['postbit_userinfo_right_after_posts'] .= $templater->render();
}