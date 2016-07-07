  
<!DOCTYPE html>
<html>
<body>

<?php
class Car
{
    var $color;
    function Car($color="green") {
      $this->color = $color;
    }
    function what_color() {
      return $this->color;
    }
}

function print_vars($obj) {
   foreach (get_object_vars($obj) as $prop => $val) {
     echo "\t$prop = $val\n";
   }
}

// instantiate one object
// 实例化对象，由于car类中存在类的同名方法，即为构造方法。
// 在实例化时，将white 传递给类的成员color。
// var_dump($herbie);die;
 // object(Car)#1 (1) { ["color"]=> string(5) "white" } 
 // 上面两行是对象的打印结果
 // 可以看到color的属性值为white
$herbie = new Car("white");


// show herbie properties
echo "\herbie: Properties\n";
// 调用print_vars函数时，将￥herbie转化为关联数组，数组的下标是color,值为white.
// 所以遍历数组时，第一次循环$prop为color,$val为white
// 由于只有一个元素，所以只会循环一次。
// 最后两次输出连以来就是那个结果。
// 还有类中的var已经被废弃了，现在基本上用public
print_vars($herbie);

?>  

</body>
</html>