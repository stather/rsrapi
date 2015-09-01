<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitcec96723d0319b2e97b4cd6f803b8648
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    public static function getLoader()
    {
        echo "m0";
        if (null !== self::$loader) {
            return self::$loader;
        }
echo "m1";
        spl_autoload_register(array('ComposerAutoloaderInitcec96723d0319b2e97b4cd6f803b8648', 'loadClassLoader'), true, true);
        echo "m2";
        self::$loader = $loader = new \Composer\Autoload\ClassLoader();
        echo "m3";
        spl_autoload_unregister(array('ComposerAutoloaderInitcec96723d0319b2e97b4cd6f803b8648', 'loadClassLoader'));
        echo "m4";

        $map = require __DIR__ . '/autoload_namespaces.php';
        foreach ($map as $namespace => $path) {
            $loader->set($namespace, $path);
        }
        echo "m5";

        $map = require __DIR__ . '/autoload_psr4.php';
        foreach ($map as $namespace => $path) {
            $loader->setPsr4($namespace, $path);
        }
        echo "m6";

        $classMap = require __DIR__ . '/autoload_classmap.php';
        if ($classMap) {
            $loader->addClassMap($classMap);
        }
        echo "m7";

        $loader->register(true);

        $includeFiles = require __DIR__ . '/autoload_files.php';
        foreach ($includeFiles as $file) {
            composerRequirecec96723d0319b2e97b4cd6f803b8648($file);
        }
        echo "m8";

        return $loader;
    }
}

function composerRequirecec96723d0319b2e97b4cd6f803b8648($file)
{
    require $file;
}
