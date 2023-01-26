<?php

namespace App\Service;

class ClassService
{

    /**
     * This function will take an instance of a PHP stdClass and attempt to cast it to
     * the type of the specified $className.
     *
     * For example, we may pass 'Acme\Model\Product' as the $className.
     *
     * @param object $instance  an instance of the stdClass to convert
     * @param string $className the name of the class type to which we want to cals
     *
     * @return mixed a version of the incoming $instance casted as the specified className
     */
    public function cast(object $instance, string $className): mixed
    {
        return unserialize(sprintf(
            'O:%d:"%s"%s',
            \strlen($className),
            $className,
            strstr(strstr(serialize($instance), '"'), ':')
        ));
    }

}