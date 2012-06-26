# Queen File Manager : A file manager library for PHP

Welcome to Queen File Manager version 0.1 a class written on php for create an easy way of open, write, delete and read file text.


## Download

The latest stable version can be downloaded from the downloads tab, or using the following link:   
https://github.com/arturosl/QueenFileManager/downloads

## Usage

### Example Usage
```php
<?php
require_once('QFM.php');
/* If the directory does not exist Then create the directory */
$qfm = new QFM(NULL,'demo/'); 
/* name of file &  nosotros no necesitamos usar la extension .txt */
$qfm->newFile('demo'); 

/*
Result:

# Create a file .txt with 'demo' has name on demo directory
*/
?>
```  
 
URL GITHUB: https://github.com/arturosl/QueenFileManager
License: FREE
(c) 2012, Arturo Salgado Lomeli <arturosl.1990@gmail.com>  