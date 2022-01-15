<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/12
 * Time: 下午 04:57
 */
class ShowHotSales
{
    public function actionPerformed()
    {
        $this->ShowHotSales();
    }

    public function ShowHotSales()
    {
        header("Refresh: 0; url=../../2HandBookstore/HotSales/View/hotsale.html");
    }

}

?>