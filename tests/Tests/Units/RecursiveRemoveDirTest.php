<?php

namespace Tests\Units;

use Tests\TestCase;

class RecursiveRemoveDirTest extends TestCase {
  
  public function testRemoveFile(){

    $tmp = tempnam(sys_get_temp_dir(),"tmp-".get_class($this).'-');
    file_put_contents($tmp, 'aaaaaaaaaaa');
    
    $ret = rrmdir($tmp);
    $this->assertFalse($ret);
    $this->assertTrue(is_file($tmp));
    
    is_file($tmp)&&unlink($tmp);
  }
  
  public function testRecursiveRemoveDirectory(){
    
    $tmpdir = $this->mktempdir();
    mkdir("${tmpdir}/a_dir");
    mkdir("${tmpdir}/a_dir/b_dir");
    mkdir("${tmpdir}/a_dir/b_dir/c_dir");
    touch("${tmpdir}/a_dir/b_dir/sample.txt");
    touch("${tmpdir}/d.txt");
  
    $this->assertContains('a_dir',scandir($tmpdir));
    $this->assertContains('d.txt',scandir($tmpdir));
    $this->assertContains('b_dir',scandir("$tmpdir/a_dir"));
    $this->assertContains('c_dir',scandir("$tmpdir/a_dir/b_dir"));
    $this->assertContains('sample.txt',scandir("$tmpdir/a_dir/b_dir"));
    
    $ret = rrmdir($tmpdir);
    
    $this->assertTrue($ret);
    $this->assertFalse(is_dir($tmpdir));
    
    
  }
  protected  function mktempdir($name=null, $keep_directory_after_finished=false):string{
    
    $name  = $name ?? 'php-tempdir';
    $temp_name = tempnam(sys_get_temp_dir(), $name.'-');
    unlink($temp_name);
    $dir = $temp_name;
    mkdir($dir);
    // 消さなくても自動的に削除されるように。
    if ( !$keep_directory_after_finished ){
      register_shutdown_function(function() use ($dir) {
        if ( is_dir($dir)){
          rrmdir($dir);
        }
      },);
    }
    return $dir;
  }
  
}