<?php

class Page404Model implements iData
{
    function getData()
    {
        return [
            'Message'=>[ 'title'=> 'OOPS:( The page is under construction'],
        ];
    }

}