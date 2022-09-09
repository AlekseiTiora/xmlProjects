<?php
$xml=simplexml_load_file("Sugupuu.xml");
// väljastab massivist getChildrens
function getPeoples($xml){
    $array=getChildrens($xml);
    return $array;
}
// väljastab  laste andmed
function getChildrens($people){
    $result=array($people);
    $childs=$people -> lapsed -> inimene;

    if(empty($childs))
        return $result;

    foreach ($childs as $child){
        $array=getChildrens($child);
        $result=array_merge($result, $array);

    }
    return $result;
}
function getParent($peoples, $people){
    if ($people == null) return null;
    foreach ($peoples as $parent){
        if (!hasChilds($parent)) continue;
        foreach ($parent->lapsed->inimene as $child){
            if($child->nimi == $people->nimi){
                return $parent;
            }
        }
    }
    return null;
}
function hasChilds($people){
    return !empty($people -> lapsed -> inimene);
}

$peoples=getPeoples($xml);

?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Harjutused</title>
</head>
<body>
<h1>Maksim Tsõbirev harjutused</h1>

<h3>1.Отобразить только тех людей у которых имя А  начинается с одной и той же буквы</h3>
<?php

?>
<br>
<h3>2.Отобразить количество букв в именах всех людей</h3>

<?php
$count = 0;
foreach ($peoples as $people){
    $count += strlen($people->nimi);
}
echo $count;
?>
</body>
</html>