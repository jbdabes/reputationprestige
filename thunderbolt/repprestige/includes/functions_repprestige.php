<?php

// function fetch_repprestige($reputation, $prestigeid)
// ============================================================
// fetches a user's reputation based on their prestige id
// in order to update it in the userinfo array and in postinfo
// if it's to render the correct rep in the postbit
function fetch_repprestige($reputation, $prestigeid)
{
    // they're already at the top prestige
    if($prestigeid == '10')
    {
        return $reputation;
    }
    else
    {
        // get the lower rep bound for the next prestige
        global $vbulletin;
        $repboundary = $vbulletin->db->query_first("SELECT startingrep FROM " . TABLE_PREFIX . "reputationprestige WHERE prestigeid = '" . intval($prestigeid+1) . "'");
        // return the correct reputation
        if($reputation >= $repboundary['startingrep'])
        {
            return $repboundary['startingrep'];
        }
        else
        {
            if($prestigeid == 0)
            {
                return $reputation;
            }
            else
            {
                $repboundary = $vbulletin->db->query_first("SELECT startingrep FROM " . TABLE_PREFIX . "reputationprestige WHERE prestigeid = '" . intval($prestigeid) . "'");
                return $reputation - $repboundary['startingrep'];
            }
        }
    }
}

// function fetch_repprestigeicon($prestigeid, &$handle)
// ============================================================
// fetches a prestige icon from the database based on
// prestige id, and updates $handle accordingly - function
// works for the userinfo array and for postinfo array
function fetch_prestigeicon($prestigeid, &$handle)
{
    // this shouldn't even be needed but someone will accidentally update someone to prestige0 manually
    if($prestigeid < '0')
    {
        $prestigeid = '0';
    }
    // again, i shouldn't even need this but meh
    if($prestigeid > '10')
    {
        $prestigeid = '10';
    }
    // we only need to run this if they have a prestige id over 0
    if($prestigeid > 0)
    {
        global $vbulletin;
        $query = $vbulletin->db->query_first("SELECT image FROM " . TABLE_PREFIX . "reputationprestige WHERE prestigeid = '" . intval($prestigeid) . "'");
        
        $handle['repprestigeicon'] = $vbulletin->options['bburl'] . $query['image'];
    }
    // otherwise there's no icon anyway
    else
    {
        $handle['repprestigeicon'] = '';
    }
}

// function fetch_canprestige($currentprestige, $currentrep)
// ============================================================
// fetches a user's ability to prestige their reputation by
// checking their reputation against the next prestigeid's
// starting rep - it also won't allow prestiging above 10
// i'll probably add the ability to have infinite prestige
// levels in a later release
function fetch_canprestige($currentprestige, $currentrep)
{
    // already at the highest prestige level
    if($currentprestige == 10)
    {
        return false;
    }
    
    // calculate the next prestige level
    $nextprestige = intval($currentprestige) + 1;
    
    global $vbulletin;
    if($currentprestige > 0)
    {
        // we can't run this for non-prestiged users as there is no starting rep unless you count 0.. durr
        $currentbound = $vbulletin->db->query_first("SELECT startingrep FROM " . TABLE_PREFIX . "reputationprestige WHERE prestigeid = '" . intval($currentprestige) . "'");
    }
    // lower bound of the next prestige level
    $lowerbound = $vbulletin->db->query_first("SELECT startingrep FROM " . TABLE_PREFIX . "reputationprestige WHERE prestigeid = '" . $nextprestige . "'");
    
    // okay, some jibberypokery to get the real amount of rep from the database, i could use a query but queries are evil
    $rep = (($currentprestige > 0) ? $currentrep + $currentbound['startingrep'] : $currentrep);
    
    if($rep >= $lowerbound['startingrep'])
    {
        // prestige is allowed
        return true;
    }
    
    // for everything else, there's mastercard
    return false;
}