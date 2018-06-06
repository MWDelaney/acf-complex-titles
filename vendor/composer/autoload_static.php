<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit95b33e76e304fcc4e2c5483f76694bef
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MWD\\ComplexTitles\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MWD\\ComplexTitles\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Gamajo_Template_Loader' => __DIR__ . '/..' . '/gamajo/template-loader/class-gamajo-template-loader.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit95b33e76e304fcc4e2c5483f76694bef::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit95b33e76e304fcc4e2c5483f76694bef::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit95b33e76e304fcc4e2c5483f76694bef::$classMap;

        }, null, ClassLoader::class);
    }
}