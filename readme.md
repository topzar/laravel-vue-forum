### 学习过程中遇到的问题并解决方法总汇
 ### Laravel 5.5 migrate时报错: Specified key was too long error
  #### 问题根源

   MySql支持的utf8编码最大字符长度为3字节，如果遇到4字节的宽字符就会出现插入异常。三个字节UTF-8最大能编码的Unicode字符是0xffff，即Unicode中的基本多文种平面（BMP）。因而包括Emoji表情（Emoji是一种特殊的Unicode编码）在内的非基本多文种平面的Unicode字符都无法使用MySql的utf8字符集存储。
    这也应该就是Laravel 5.4改用4字节长度的utf8mb4字符编码的原因之一。不过要注意的是，只有MySql 5.5.3版本以后才开始支持utf8mb4字符编码（查看版本：selection version();）。如果MySql版本过低，需要进行版本更新。
    注：如果是从Laravel 5.3升级到Laravel 5.4，不需要对字符编码做切换。

#### 解决方法
- 1.升级MySql版本到5.5.3以上。
- 2， 手动配置迁移命令migrate生成的默认字符串长度，在AppServiceProvider中调用Schema::defaultStringLength方法来实现配置
```
use Illuminate\Support\Facades\Schema;

/**
* Bootstrap any application services.
*
* @return void
*/
public function boot()
{
   Schema::defaultStringLength(191);
}
```

    