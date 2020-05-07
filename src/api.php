<?php

function get_zerg()
{
    $response = Requests::get('https://allosaurus.delahayeyourself.info/api/starcraft/zerg/units/');
    if($response->status_code == 200)
    {
        return json_decode($response->body);
    }
    return array();
}

function get_terran()
{
    $response = Requests::get('https://allosaurus.delahayeyourself.info/api/starcraft/terran/units/');
    if($response->status_code == 200)
    {
        return json_decode($response->body);
    }
    return array();
}

function get_terranunits_by_slug($slug)
{
    $url = sprintf("https://allosaurus.delahayeyourself.info/api/starcraft/terran/%s", $slug);
    $response = Requests::get($url);
    if($response->status_code == 200)
    {
        return json_decode($response->body);
    }
    return null;
}
function get_zergunits_by_slug($slug)
{
    $url = sprintf("https://allosaurus.delahayeyourself.info/api/starcraft/zerg/%s", $slug);
    $response = Requests::get($url);
    if($response->status_code == 200)
    {
        return json_decode($response->body);
    }
    return null;
}


function get_top_rated_zerg()
{
    $zerg = get_zerg();
    $keys = array_rand($zerg, 3);
    $top = array();
    foreach($keys as $key)
    {
        $topzerg[] = $zerg[$key];
    }
    return $topzerg;
}
function get_top_rated_terran()
{
    $terran = get_terran();
    $keys = array_rand($terran, 3);
    $top = array();
    foreach($keys as $key)
    {
        $topterran[] = $terran[$key];
    }
    return $topterran;
}