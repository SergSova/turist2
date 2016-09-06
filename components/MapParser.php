<?php

    namespace app\components;

    class MapParser{

        private static $_mapParser;

        public static function getInstance(){
            if(is_null(self::$_mapParser)){
                self::$_mapParser = new self();
            }

            return self::$_mapParser;
        }

        public function getLatLng_kml($path){
            $str = simplexml_load_file($path)->Folder->Folder->Placemark->MultiGeometry->LineString->coordinates;
            $pattern = '/(\d{1,}\.\d{1,})\,(\d{1,}\.\d{1,})\,(\d{1,}\.\d{1,})/';

            $str = '['.trim(preg_replace($pattern, '{"lat":$2,"lng":$1},', str_replace(["\t","\n"], '', $str)));
            $str = substr($str, 0, -1).']';

            return $str;
        }
    }