<?php 

function getMetaTags($site_html) {
    $snc=array();
    preg_match_all('/<meta(.*?)>/',$site_html,$matches); //getting all meta tags
    if (count($matches)>0) {
        foreach ($matches[1] as $a) {
            //getting open graph tags
            preg_match('/name="(.*?)"/',$a,$n); //getting properties seperate 
            preg_match('/property="(.*?)"/',$a,$b); //getting properties seperate because some sites sorting them differently
            preg_match('/content="(.*?)"/',$a,$c);        
            if (count($b)>0 && count($c)>0) $snc[$b[1]]=$c[1];
            if (count($n)>0 && count($c)>0) $snc[$n[1]]=$c[1];
        }
    }
    return $snc;
}


$url='http://www.github.com/';
$site_html=file_get_contents($url);
 
$tags=getMetaTags($site_html);

echo "<pre>";
var_dump($tags);
exit;

