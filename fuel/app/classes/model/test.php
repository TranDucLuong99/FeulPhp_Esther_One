<?php

class Model_Test extends \Orm\Model
{
    public static function get_results()
    {
        return DB::select('title','content')->from('articles')->execute()->get('title');
    }
}