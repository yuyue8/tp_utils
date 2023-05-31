# TpUtils

## 安装
~~~
composer require yuyue8/tp_utils
~~~

## 使用方法

src/helpers文件中，设置了工具类的快捷调用方法，可自行查看

若工具类中缺少方法，可以自主创建工具类，继承本工具类，并在`tp_config`配置文件`util_register`中设置工具类

使用快捷调用方法时，自定义的工具类方法没有提示：
可以在 `common` 文件内重置快捷方法，只需要 `return` 自定义的工具类即可