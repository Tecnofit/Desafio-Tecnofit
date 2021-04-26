<?php

interface MapperInterface{

    function findById($id);

    function save($data = null);

    function loadClassProperties();
}