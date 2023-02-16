<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfbffe408aa48c09bbd5ecdddd83720a4
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfbffe408aa48c09bbd5ecdddd83720a4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfbffe408aa48c09bbd5ecdddd83720a4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfbffe408aa48c09bbd5ecdddd83720a4::$classMap;

        }, null, ClassLoader::class);
    }
}
