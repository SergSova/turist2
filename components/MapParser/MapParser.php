<?php

    namespace app\components\MapParser;

    class MapParser{

        private static $_mapParser;

        /**
         * get simple object
         * @return MapParser
         */
        public static function getInstance(){
            if(is_null(self::$_mapParser)){
                self::$_mapParser = new self();
            }

            return self::$_mapParser;
        }

        public function getLatLng($path){
            $ext = substr($path, strripos($path, '.') + 1);
            $action = 'getLatLng_'.$ext;
            if(!method_exists($this,$action)) return false;
            return $this->$action($path);
        }

        private function getLatLng_gpx($path){
            $dom = new \DOMDocument();
            $dom->load($path);
            $coordinates = '[';
            foreach($dom->getElementsByTagName('trkpt') as $node){
                /** @var \DOMNode $node */
                $coordinates .= '{';
                foreach($node->attributes as $attribute){
                    $coordinates .= '"'.$attribute->name.'":'.$attribute->value.', ';
                }
                $coordinates .= '}, ';
            }
            $coordinates = str_replace(['lon',', }'], ['lng','}'], substr(trim($coordinates), 0, -1).']');
            return $coordinates;
        }

        private function getLatLng_kml($path){
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
        private function getLatLng_plt($path){
            $coordinates = file_get_contents($path);
            $coordinates = substr($coordinates, strpos($coordinates,"\n",9));
            $pattern = '/(\d{1,}\.\d{1,})\,(\d{1,}\.\d{1,})\,(\d{1,}\.\d{1,})/';

            $str = '['.trim(preg_replace($pattern, '{"lat":$2,"lng":$1},', str_replace([
                                                                                           "\t",
                                                                                           "\r",
                                                                                           "\n"
                                                                                       ], ' ', $coordinates)));
            $str = substr($str, 0, -1).']';

            return $str;
        }

    }