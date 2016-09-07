<?php

    namespace app\components\MapParser;

    class MapParser{

        private static $_mapParser;

        public static function getInstance(){
            if(is_null(self::$_mapParser)){
                self::$_mapParser = new self();
            }

            return self::$_mapParser;
        }

        public function getLatLng_kml($path){
            $dom = new \DOMDocument();
            $dom->load($path);
            $coordinates = $dom->getElementsByTagName('coordinates');
            for($i = 0; $i < $coordinates->length; $i++){
                if($coordinates->item($i)->parentNode->nodeName == 'LineString'){
                    $coordinates = $coordinates->item($i);
                    break;
                }
            }
            $pattern = '/(\d{1,}\.\d{1,})\,(\d{1,}\.\d{1,})\,(\d{1,}\.\d{1,})/';

            $str = '['.trim(preg_replace($pattern, '{"lat":$2,"lng":$1},', str_replace([
                                                                                           "\t",
                                                                                           "\n"
                                                                                       ], ' ', $coordinates->textContent)));
            $str = substr($str, 0, -1).']';

            return $str;
        }


    }