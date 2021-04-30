<?php

/*
 * Código copiado em partes a partir da solução apresentada no link:
 * https://codereview.stackexchange.com/questions/169345/building-a-simple-orm-in-php
 */

interface MapperInterface{

    function findById($id);

    function save($data = null);

    function loadClassProperties();
}