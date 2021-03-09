<?php


/**
 * @return Array a limited list of indoor interests
 */
function getTypes()
{
    return array('shapes', 'animals', 'fruits');
}

/**
 * @return Array of accepatable type of pictures
 */
function getExtensions(){
    return array('png', 'jpeg', 'jpg');
}
