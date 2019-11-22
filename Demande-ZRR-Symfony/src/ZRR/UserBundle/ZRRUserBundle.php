<?php

namespace ZRR\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ZRRUserBundle extends Bundle
{
    public  function getParent(){
        return 'FOSUserBundle';
    }
}
