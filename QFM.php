<?php

/* 

Welcome to Queen File Manager version 0.1 a class written on php for create an easy way of open,write,delete and read file text 

github:    arturosl

twitter:   #DEVarturo

¡forkme!   It's free ^_^

*/

class QFM{
  private $masterfile = 'masterFile'; // name of file text master;
  private $path='QFMpath'; //folder content of file
  private $limitLines=80; //limit of lines per file text + linesCache
  private $linesCache=20; //lines copy of the last filetext
  private $folderBackup = 'backup'; // name of folder with backup file
  
  function __construct($masterfile=NULL,$path=NULL) {
	  date_default_timezone_set('UTC'); //Prevent error date;
	  $this->masterfile = $masterfile == NULL ? $this->masterfile : $masterfile;
	  $this->path = $path == NULL ? $this->path : $path;
   }
  
  /* FUNCTIONs CORE FILE */
  
/* ############################################################ */  
  
  /* basics operation */  
  
  
  /* open a file */
  public function openFile($attr=NULL,$file=NULL,$path=NULL){
	if($file==NULL)
	  return $attr == NULL ? FALSE : fopen($this->metaFile('path_file'), $attr.'b');
	else
	  return $attr == NULL ? FALSE : fopen("".($path==NULL ? $this->metaFile('path') : $path)."$file.txt", $attr.'b');
  }

  /* create a new file */
  public function newFile($name=NULL,$path=NULL){
	return $this->openFile("x",$name,$path);
  }
  
  /* move a file , source = where is masterfile and newS is == new source of masterfile*/
  public function moveFile($source,$newS){
	if(!is_dir($this->metaFile('path').$newS))
	  mkdir($this->metaFile('path').$newS);
    rename($source, $this->metaFile('path').$newS.'/'.$this->metaFile('masterfile').date("-d-F-Y __ G-i-s").'.txt');
  }
  
  /* rename a file */
  public function renameFile($masterF,$newName=NULL,$path=NULL){
    $path = $path == NULL ? $this->metaFile('path') : $path;
	$newName= $newName == NULL ? $this->metaFile('masterfile') : $newName;
	rename($path.$masterF.'.txt', $path.$newName.'.txt');
  }
  
    
  
/* ############################################################ */  
  
  
  /* complement operation */
  
  /* print the file line per line */
  public function showFile($html=false,$min=0,$max=9999) {
	  
	$jump = $html==false ? "\r\n": "<br />";	
    $f = $this->openFile('r');
	
	$i=1;
	
	if($f){
      $str='';
      while( !feof($f) ){
	  $line = fgets($f);
		if(!$min || ($i>=$min && $i<=$max))
		               // if no end of file return $jump else nothing == ''
	      $str.= $line.(!feof($f) ? $jump : ''); 
      ++$i;
	  }
	  
	} // end if $f
	
	fclose($f);
	return $str;
  }
  
  /* Write X content on masterfile, line per line */
  public function Write($content,$html=false,$line=NULL){
    $str = is_array($content) ? $this->array_str($content,$html): $content;
	$this->limitFile();
	if($line==NULL){
	  $f=$this->openFile('a');
	  if($f){
	    fwrite($f,($html==false ? "\r\n": "<br />").$str);
	  }else{
	    return NULL;
	  }
	fclose($f);
	return true;
	}else{
	  $i=1;
      $f=$this->openFile('r');
	  if($f){
		$data='';
	    while(!feof($f)){
		  if($i==$line)
		   $data.=$str.($html==false ? "\r\n": "<br />");
		$data.=fgets($f);
		++$i;
		}
		$fx=$this->newFile('temp');
		fwrite($fx,$data);
		fclose($fx);
		fclose($f);
		unlink($this->metaFile('path_file')); //delete
		$this->renameFile('temp'); // rename temp to masterfile
		return true;
	  }else{
	    return NULL;
	  }
	}
	
  }
  
   /* check if the file have the MAX lines */
  private function limitFile($lt=NULL,$lc=NULL){
    $limit = $lt == NULL ? $this->metaFile('limitLines') : $lt;
	$lCache = $lc == NULL ? $this->metaFile('LinesCache') : $lc;
	$lines =  $this->nLines(); // get total lines of file text
	if($lines >= $limit){
	  $f=$this->openFile('r');
	  if($f){
		$i=1;
		$str='';
	    while(!feof($f)){
	    $data=fgets($f);
		  if($i > ($limit-$lCache))
		    $str.=$data;
		++$i;
	    }
		fclose($f);
	    $this->moveFile($this->metaFile('path_file'),$this->metaFile('folderBackup'));
		$f=$this->newFile($this->metaFile('masterfile'));
		fwrite($f,$str);
		fclose($f);
		return true;
	  }else{
	    return false;
	  }
	}else{
	  return false;
	}
  }  
  
  
  /* Return the number of lines , 1 to X */
  public function nLines($file=NULL,$path=NULL){
    $i=0;
	$f=$this->openFile('r',$file,$path);
	if($f){
	  while(!feof($f)){
	    fgets($f);
	    ++$i;
	  }
	}else{
      return NULL;
	}
	fclose($f);
	return $i;	  
  }
  
  /* return a meta data of file */
  public function metaFile($attr=''){
    switch($attr){
      case 'path_file':
	    return $this->path.$this->masterfile.'.txt';
	  break;
	  case 'path':
	    return $this->path;
	  break;
	  case 'masterfile':
	    return $this->masterfile;
	  break;
	  case 'limitLines':
	    return $this->limitLines;
	  break;
	  case 'LinesCache':
	    return $this->linesCache;
	  break;
	  case 'folderBackup':
	    return $this->folderBackup;
	  break;
	  default:
	  return false;
	}
  }


}
?>