<?php

namespace App\Admin\Actions\Poster;

use Encore\Admin\Actions\RowAction;
use App\Poster;

class Pass extends RowAction
{
    public $name = 'Pass';

    public function handle(Poster $poster)
    {
        $poster->flag = 2;
        $poster->save();
      
        // 保存之后返回新的html到前端显示
        $html = "<i class=\"fa fa-check-square\"></i> Pass";
      
        return $this->response()->html($html);

        // return $this->response()->success('Success message.')->refresh();
    }
    public function display($star)
    {
        if ($star == 1)
            return "<i class=\"fa fa-check-square-o\"></i> Submit" ;
        if ($star == 2)
            return "<i class=\"fa fa-check-square\"></i> Pass" ;
    }

}