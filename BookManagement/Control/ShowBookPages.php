<?php
include ("/../Model/connectBookPage.php" );

class ShowBookPages{

    private $event = null;
    private $connectBookPage = null;
    private $conncetBookPageStmt = null;


    function __construct($event){
        $this->connectBookPage = new connectBookPage();
        $this->event = $event;
    }


    public function actionPerformed(){
        $post = $this->event->getPost();
        if(!empty($post['page'])){
                $this->connectBookPage->setWhichPage($post['page']);
        }

        $this->conncetBookPageStmt = $this->connectBookPage->actionPerformed();
        echo $this->conncetBookPageStmt;
    }

}
?>
