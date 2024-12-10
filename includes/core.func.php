<?php
function setClassSort($_arg_0, $_arg_1 = 0)
{
    global $DB;
    $_var_3 = $DB->get_row("select * from kami_class where cid='" . $_arg_0 . "' limit 1");
    $_var_4 = $_var_3["sort"];
    if ($_arg_1 == 1) {
        if ($_var_5 = $DB->get_row("select cid,sort from kami_class where sort<'" . $_var_4 . "' order by sort desc limit 1")) {
            $DB->query("UPDATE kami_class SET sort=" . $_var_5["sort"] . " WHERE cid='" . $_arg_0 . "'");
            $DB->query("UPDATE kami_class SET sort=" . $_var_4 . " WHERE cid='" . $_var_5["cid"] . "'");
            return true;
        }
    }
    if ($_arg_1 == 2) {
        if ($_var_5 = $DB->get_row("select cid,sort from kami_class where sort>'" . $_var_4 . "' order by sort asc limit 1")) {
            $DB->query("UPDATE kami_class SET sort=" . $_var_5["sort"] . " WHERE cid='" . $_arg_0 . "'");
            $DB->query("UPDATE kami_class SET sort=" . $_var_4 . " WHERE cid='" . $_var_5["cid"] . "'");
            return true;
        }
    }
    if ($_arg_1 == 3) {
        $_var_5 = $DB->get_row("select cid,sort from kami_class order by sort desc limit 1");
        $DB->query("UPDATE kami_class SET sort=sort-1 WHERE sort>" . $_var_4 . '');
        $DB->query("UPDATE kami_class SET sort=" . $_var_5["sort"] . " WHERE cid='" . $_arg_0 . "'");
        return true;
    }
    $_var_5 = $DB->get_row("select cid,sort from kami_class order by sort asc limit 1");
    $DB->query("UPDATE kami_class SET sort=sort+1 WHERE sort<" . $_var_4 . '');
    $DB->query("UPDATE kami_class SET sort=" . $_var_5["sort"] . " WHERE cid='" . $_arg_0 . "'");
    return true;
}


//G_tk计算
function getGTK($skey)
{
    $hash = 5381;
    for ($i = 0; $i < strlen($skey); ++$i) {
        $hash += ($hash << 5) + utf8_unicode($skey[$i]);
    }
    return $hash & 0x7fffffff;
}

function utf8_unicode($c)
{
    switch (strlen($c)) {
        case 1:
            return ord($c);
        case 2:
            $n = (ord($c[0]) & 0x3f) << 6;
            $n += ord($c[1]) & 0x3f;
            return $n;
        case 3:
            $n = (ord($c[0]) & 0x1f) << 12;
            $n += (ord($c[1]) & 0x3f) << 6;
            $n += ord($c[2]) & 0x3f;
            return $n;
        case 4:
            $n = (ord($c[0]) & 0x0f) << 18;
            $n += (ord($c[1]) & 0x3f) << 12;
            $n += (ord($c[2]) & 0x3f) << 6;
            $n += ord($c[3]) & 0x3f;
            return $n;
    }
}

?>