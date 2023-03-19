<?php

class TopController extends Controller
{
    public function index()
    {
        $results = [];

        if(isset($_POST['shuffle'])){
            $results[] = $this->databaseManager->get('Menu')->fetchAssocUdon();
            if($_POST['mode'] === '1'){
                $results[] = $this->databaseManager->get('Menu')->fetchAssocTempura();
            }
        }

        return $this->render([
            'results' => $results,
        ],'index');
    }
}
