<?php

class Methods {

    private $token;
    private static $instance;
    private $datas;

    private function __construct(){
        $this->token = getenv()["SHORCUT_API_TOKEN"];
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    function request(String $endpoint, $datas=null, $query=null,$method=null){
        $url = (isset($query)) ? $endpoint.'/'.$query : $endpoint;
        $ch = curl_init($url);
        if($datas!=null){
            $datas_encoded = json_encode($datas);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $datas_encoded);
        }
        if($method!=null){
            switch($method){
                case 'GET':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                break;
                case 'POST':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                break;
                case 'PUT':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                break;
                case "DELETE":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
                case 'UPDATE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "UPDATE");
                break;
                default:
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            }
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Shortcut-Token: '.$this->token, 'Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($ch);
        curl_close($ch);
    }

    function getCategories(){
       $this->request(DefinitionEndpoints::URL_CATEGORIES);
    }

    function setCategories($url_categories){
        $this->request($url_categories);
     }


    function getStories(Int $idStory){
        $this->request(DefinitionEndpoints::URL_STORIES.'/'.$idStory);
     }

     function getStoryByQuery(String $query){
        $content = $this->request(DefinitionEndpoints::STORIE_SEARCH,null,$query);
        $content_decoded = json_decode($content);
        $story_id = $content_decoded['stories']['id'];
        return $story_id;
     }

     function deleteStory(Int $idStory){
        $content = $this->request(DefinitionEndpoints::URL_STORIES.'/'.$idStory, null, null, "DELETE");
        //$content_decoded = json_decode($content);
        //var_dump($content_decoded);
        //$story_id = $content_decoded['stories']['id'];
        //return $story_id;
     }

     function setStories($file){
        $row = 0;
        $datas = array();
        if(($handle = fopen($file,"r"))){
            while(($this->data = fgetcsv($handle,1000,",")) !== FALSE){
                $num = count($this->data);
                /*Fetch Epic*/
                switch($this->data[2]){
                    case 'Code':
                        $epic = '30';
                        break;
                    case 'Spike':
                        $epic = '31';
                        break;
                    case 'Setup':
                        $epic = '32';
                        break;
                    default:
                    $epic = null;
                }


                /*Fetch Workflow State*/
                switch($this->data[1]){
                    case 'to do':
                        $workflow_state = 500000024;
                        break;
                    case 'in progress':
                        $workflow_state = 500000025;
                        break;
                    case 'done':
                        $workflow_state = 500000026;
                        break;
                    default:
                        $workflow_state = null;
                };
                /* search Stories */
                if(isset($datas[4])){
                    $story_id_blocking = $this->getStoryByQuery($datas[4]);
                    $story_link = array(array('subject_id'=>$story_id_blocking,'verb'=>'blocks'));
                }   else{
                    $story_link = null;
                }

                $this->datas[] = array('name' => $this->data[0], 'description'=>$this->data[0], 'epic_id'=>$epic, 'workflow_state_id' =>$workflow_state, 'story_links' => $story_link);
                $row++;
            }
                    foreach($this->datas as $data){
                        $datas_encoded = json_encode($data, JSON_FORCE_OBJECT);
                        $this->request(DefinitionEndpoints::URL_STORIES, $data);

                    }
        }
     }
}