<?php
if(!file_exists('install/install.lock')){
    header("Location: /install");
}else{
    echo '狗凯之家源码网卡密系统 <a href="https://wxfaka.bygoukai.com/">访问</a>';
}