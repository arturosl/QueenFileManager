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
$qfm = new QFM(NULL,'demo/');
$qfm->newFile('demo'); /* 1º attr - name of file ,  2º attr - path of file */

/*
Result:

# Create a file .txt with 'demo' has name on demo directory
*/
?>
```  
 
URL: https://github.com/arturosl/QueenFileManager  
License: FREE  
(c) 2012, Arturo Salgado Lomeli <arturosl.1990@gmail.com>  